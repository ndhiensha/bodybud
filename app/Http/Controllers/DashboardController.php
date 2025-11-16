<?php

namespace App\Http\Controllers;

use App\Models\Workout;
use App\Models\Progress;
use App\Models\UserActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * UC-001: Mengakses Dashboard Workout
     * Main Flow: Complete Implementation
     * 
     * Precondition: User sudah login (Step 1)
     * Postcondition: Dashboard ditampilkan dengan data workout dan progress
     */
    public function index()
    {
        // Main Flow Step 2: Sistem mengarahkan ke dashboard (sudah di route)
        
        // Main Flow Step 3: Mengambil data workout dari database
        $workouts = $this->getWorkoutList();

        // Alternative Flow: Jika data workout tidak tersedia
        if ($workouts->isEmpty()) {
            return view('dashboard.index', [
                'workouts' => collect([]),
                'progress' => null,
                'message' => 'Belum ada workout yang tersedia',
            ]);
        }

        // Main Flow Step 5: Mengambil data progress user
        $progress = $this->getUserProgress(Auth::id());

        // Main Flow Step 6: Log aktivitas akses dashboard
        $this->logDashboardAccess(Auth::id());

        // Main Flow Step 4 & 7: Menampilkan dashboard dengan navigasi
        return view('dashboard.index', [
            'workouts' => $workouts,
            'progress' => $progress,
            'user' => Auth::user(),
        ]);
    }

    /**
     * Sequence Diagram: Message 9-11
     * DashboardController -> WorkoutController -> Workout Entity
     */
    private function getWorkoutList()
    {
        // Fetch all workouts dengan informasi lengkap
        return Workout::select(
            'workout_id',
            'workout_name',
            'kategori',
            'deskripsi',
            'kalori',
            'durasi',
            'difficulty',
            'total_sets'
        )
        ->orderBy('kategori')
        ->orderBy('workout_name')
        ->get();
    }

    /**
     * Sequence Diagram: Message 13-16
     * DashboardController -> ProgressController -> Progress Entity
     */
    private function getUserProgress($userId)
    {
        // Ambil progress summary user
        $progressData = Progress::where('user_id', $userId)
            ->where('status', 'Completed')
            ->select(
                DB::raw('COUNT(*) as total_workout'),
                DB::raw('SUM(completed_sets) as total_sets'),
                DB::raw('AVG(progress_percentage) as avg_progress')
            )
            ->first();

        // Hitung hari aktif (streak)
        $hariAktif = $this->calculateActiveStreak($userId);

        return [
            'total_workout' => $progressData->total_workout ?? 0,
            'total_sets' => $progressData->total_sets ?? 0,
            'avg_progress' => round($progressData->avg_progress ?? 0, 2),
            'hari_aktif' => $hariAktif,
        ];
    }

    /**
     * Hitung consecutive active days
     */
    private function calculateActiveStreak($userId)
    {
        $logs = UserActivityLog::where('user_id', $userId)
            ->where('activity_type', 'workout_completed')
            ->orderBy('timestamp', 'desc')
            ->pluck('timestamp')
            ->map(function($timestamp) {
                return $timestamp->format('Y-m-d');
            })
            ->unique()
            ->values();

        if ($logs->isEmpty()) {
            return 0;
        }

        $streak = 1;
        $today = now()->format('Y-m-d');

        // Cek apakah hari ini ada aktivitas
        if ($logs->first() !== $today) {
            return 0;
        }

        for ($i = 0; $i < $logs->count() - 1; $i++) {
            $currentDate = \Carbon\Carbon::parse($logs[$i]);
            $nextDate = \Carbon\Carbon::parse($logs[$i + 1]);

            if ($currentDate->diffInDays($nextDate) === 1) {
                $streak++;
            } else {
                break;
            }
        }

        return $streak;
    }

    /**
     * Sequence Diagram: Message 19
     * Log aktivitas dashboard access
     */
    private function logDashboardAccess($userId)
    {
        UserActivityLog::create([
            'user_id' => $userId,
            'activity_type' => 'dashboard_access',
            'activity_details' => 'User accessed dashboard',
            'timestamp' => now(),
        ]);
    }

    /**
     * API endpoint untuk get workout detail (dipanggil via AJAX)
     * Sequence Diagram: Message 20
     */
    public function getWorkoutDetail($workoutId)
    {
        $workout = Workout::find($workoutId);

        if (!$workout) {
            return response()->json([
                'success' => false,
                'message' => 'Workout tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $workout,
        ]);
    }

    /**
     * Filter workout berdasarkan kategori
     */
    public function filterByCategory(Request $request)
    {
        $kategori = $request->input('kategori');

        $workouts = Workout::when($kategori, function($query) use ($kategori) {
            return $query->where('kategori', $kategori);
        })->get();

        return response()->json([
            'success' => true,
            'data' => $workouts,
        ]);
    }
}