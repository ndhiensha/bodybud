<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserActivityLog;
use App\Models\Notifikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class NotificationController extends Controller
{
    /**
     * UC-002: Notifikasi Pengingat Workout
     * Main Flow: Complete Implementation
     * 
     * Ini adalah method yang akan dipanggil oleh Laravel Scheduler
     * Precondition: Sistem scheduler aktif
     */
    public function checkInactiveUsers()
    {
        // Main Flow Step 1: Trigger otomatis setiap 24 jam
        Log::info('=== Starting Notification Check Process ===');

        // Main Flow Step 2: Mengambil data seluruh user terdaftar
        $users = User::all();

        $notificationsSent = 0;
        $notificationsSkipped = 0;
        $notificationsFailed = 0;

        foreach ($users as $user) {
            try {
                // Main Flow Step 3-5: Cek aktivitas dan hitung hari tidak aktif
                $inactiveDays = $this->calculateInactiveDays($user->id);

                // Main Flow Step 6: Cek apakah >= 5 hari
                if ($inactiveDays < 5) {
                    // Alternative Flow 1: User aktif, skip
                    Log::info("User {$user->id} is active (inactive days: {$inactiveDays})");
                    $notificationsSkipped++;
                    continue;
                }

                // Main Flow Step 7: Tandai sebagai inactive
                Log::info("User {$user->id} marked as inactive ({$inactiveDays} days)");

                // Main Flow Step 8: Cek riwayat notifikasi terakhir
                $lastNotification = $this->getLastNotification($user->id);

                // Alternative Flow 2: Notifikasi sudah dikirim dalam 24 jam
                if ($lastNotification && $this->isSentRecently($lastNotification)) {
                    Log::info("Notification already sent to user {$user->id} in last 24 hours");
                    $notificationsSkipped++;
                    continue;
                }

                // Main Flow Step 9: Tentukan tipe pesan
                $messageType = $this->determineMessageType($inactiveDays);

                // Main Flow Step 10: Generate notifikasi personal
                $notificationData = $this->generateNotification($user, $messageType, $inactiveDays);

                // Main Flow Step 11-12: Kirim dan simpan notifikasi
                $result = $this->sendAndSaveNotification($user, $notificationData);

                if ($result['success']) {
                    $notificationsSent++;
                    Log::info("Notification sent successfully to user {$user->id}");
                } else {
                    $notificationsFailed++;
                    Log::error("Failed to send notification to user {$user->id}: {$result['error']}");
                }

            } catch (\Exception $e) {
                $notificationsFailed++;
                Log::error("Error processing user {$user->id}: {$e->getMessage()}");
            }
        }

        // Main Flow Step 13: Log hasil proses
        Log::info("=== Notification Check Complete ===");
        Log::info("Sent: {$notificationsSent}, Skipped: {$notificationsSkipped}, Failed: {$notificationsFailed}");

        return [
            'sent' => $notificationsSent,
            'skipped' => $notificationsSkipped,
            'failed' => $notificationsFailed,
        ];
    }

    /**
     * Sequence Diagram: Message 4-7
     * Calculate inactive days from UserActivityLog
     */
    private function calculateInactiveDays($userId)
    {
        // Ambil aktivitas terakhir user
        $lastActivity = UserActivityLog::where('user_id', $userId)
            ->whereIn('activity_type', ['login', 'workout_completed', 'dashboard_access'])
            ->orderBy('timestamp', 'desc')
            ->first();

        if (!$lastActivity) {
            // User belum pernah aktif
            return 999; // Nilai besar agar dianggap sangat tidak aktif
        }

        // Hitung selisih hari
        $lastActivityDate = Carbon::parse($lastActivity->timestamp);
        $today = Carbon::now();
        $daysInactive = $lastActivityDate->diffInDays($today);

        return $daysInactive;
    }

    /**
     * Sequence Diagram: Message 9-11
     * Get last notification sent to user
     */
    private function getLastNotification($userId)
    {
        return Notifikasi::where('user_id', $userId)
            ->whereIn('status', ['terkirim', 'ditunda'])
            ->orderBy('sent_at', 'desc')
            ->first();
    }

    /**
     * Check if notification was sent in last 24 hours
     */
    private function isSentRecently($notification)
    {
        if (!$notification || !$notification->sent_at) {
            return false;
        }

        $sentTime = Carbon::parse($notification->sent_at);
        $hoursSince = $sentTime->diffInHours(Carbon::now());

        return $hoursSince < 24;
    }

    /**
     * Sequence Diagram: Message 12
     * Determine message type based on inactive days
     */
    private function determineMessageType($inactiveDays)
    {
        if ($inactiveDays >= 14) {
            return 'comeback_encouragement';
        } elseif ($inactiveDays >= 7) {
            return 'motivational_reminder';
        } else {
            return 'gentle_reminder';
        }
    }

    /**
     * Sequence Diagram: Message 13
     * Generate personalized notification message
     */
    private function generateNotification($user, $messageType, $inactiveDays)
    {
        $nama = $user->name ?? $user->username;

        $messages = [
            'gentle_reminder' => [
                'judul' => 'Ayo Kembali Workout! 💪',
                'pesan' => "Hai {$nama}! Sudah {$inactiveDays} hari nih kamu belum workout. Yuk, mulai lagi hari ini!",
            ],
            'motivational_reminder' => [
                'judul' => 'Jangan Berhenti Sekarang! 🔥',
                'pesan' => "Hey {$nama}, progress kamu menanti! {$inactiveDays} hari tanpa workout bisa membuatmu kehilangan momentum. Bangkit lagi!",
            ],
            'comeback_encouragement' => [
                'judul' => 'Kami Merindukanmu! 🌟',
                'pesan' => "Halo {$nama}, sudah {$inactiveDays} hari sejak workout terakhirmu. Tidak ada kata terlambat untuk comeback. Ayo mulai sekarang!",
            ],
        ];

        return $messages[$messageType];
    }

    /**
     * Sequence Diagram: Message 14-17
     * Send notification with retry mechanism
     */
    private function sendAndSaveNotification($user, $notificationData)
    {
        $maxRetries = 3;
        $retryCount = 0;
        $status = 'ditunda';
        $errorMessage = null;

        // Buat record notifikasi
        $notifikasi = new Notifikasi([
            'user_id' => $user->id,
            'judul' => $notificationData['judul'],
            'pesan' => $notificationData['pesan'],
            'tipe_pesan' => $this->determineMessageType(
                $this->calculateInactiveDays($user->id)
            ),
            'status' => $status,
            'retry_count' => 0,
        ]);

        // Attempt to send (dengan retry mechanism)
        while ($retryCount < $maxRetries) {
            try {
                // Simulasi pengiriman push notification
                $sent = $this->sendPushNotification($user, $notificationData);

                if ($sent) {
                    $status = 'terkirim';
                    $notifikasi->sent_at = now();
                    break;
                } else {
                    throw new \Exception('Push notification failed');
                }

            } catch (\Exception $e) {
                $retryCount++;
                $errorMessage = $e->getMessage();
                
                if ($retryCount < $maxRetries) {
                    // Alternative Flow 3: Retry jika gagal
                    Log::warning("Retry {$retryCount} for user {$user->id}");
                    sleep(60); // Tunggu 1 menit sebelum retry
                } else {
                    // Alternative Flow 3: Max retry reached
                    $status = 'gagal';
                    Log::error("Failed to send notification after {$maxRetries} retries");
                }
            }
        }

        // Simpan notifikasi ke database
        $notifikasi->status = $status;
        $notifikasi->error_message = $errorMessage;
        $notifikasi->retry_count = $retryCount;
        $notifikasi->save();

        // Log ke UserActivityLog
        UserActivityLog::create([
            'user_id' => $user->id,
            'activity_type' => 'notification_sent',
            'activity_details' => "Notification {$status}: {$notificationData['judul']}",
            'timestamp' => now(),
        ]);

        return [
            'success' => $status === 'terkirim',
            'status' => $status,
            'error' => $errorMessage,
            'notifikasi_id' => $notifikasi->notifikasi_id,
        ];
    }

    /**
     * Simulate push notification sending
     * Dalam implementasi real, gunakan Firebase Cloud Messaging atau service lain
     */
    private function sendPushNotification($user, $data)
    {
        // TODO: Implementasi real push notification
        // Contoh dengan Firebase Cloud Messaging:
        /*
        $firebaseToken = $user->device_token;
        
        $notification = [
            'title' => $data['judul'],
            'body' => $data['pesan'],
            'icon' => 'notification_icon',
            'click_action' => route('dashboard'),
        ];
        
        FCM::sendTo($firebaseToken, $notification);
        */

        // Simulasi berhasil (90% success rate untuk testing)
        return rand(1, 10) > 1;
    }

    /**
     * Get user notifications (untuk tampilan UI)
     */
    public function getUserNotifications(Request $request)
    {
        $userId = $request->user()->id;

        $notifications = Notifikasi::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('dashboard', compact('notifications'));
    }

    /**
     * Mark notification as read
     */
    public function markAsRead($notifikasiId)
    {
        $notifikasi = Notifikasi::find($notifikasiId);

        if (!$notifikasi) {
            return response()->json([
                'success' => false,
                'message' => 'Notifikasi tidak ditemukan',
            ], 404);
        }

        // Update status atau tambah field is_read jika perlu
        // $notifikasi->is_read = true;
        // $notifikasi->save();

        return response()->json([
            'success' => true,
            'message' => 'Notifikasi ditandai sebagai dibaca',
        ]);
    }

    /**
     * Manual trigger untuk testing (bisa dihapus di production)
     */
    public function triggerManual()
    {
        $result = $this->checkInactiveUsers();
        
        return response()->json([
            'success' => true,
            'message' => 'Notification check completed',
            'data' => $result,
        ]);
    }
}