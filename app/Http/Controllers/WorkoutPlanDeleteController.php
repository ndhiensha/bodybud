<?php

namespace App\Http\Controllers;

use App\Models\WorkoutPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class WorkoutPlanDeleteController extends Controller
{
    /**
     * Delete a specific workout plan
     * 
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        // Find workout and check ownership
        $workout = WorkoutPlan::where('id', $id)
            ->where('user_id', Auth::id())
            ->first();

        if (!$workout) {
            return response()->json([
                'success' => false,
                'message' => 'Workout tidak ditemukan atau bukan milik kamu'
            ], 404);
        }

        // Store workout info before deletion (for response)
        $workoutInfo = [
            'type' => $workout->workout_type,
            'date' => $workout->workout_date
        ];

        // Delete the workout
        $workout->delete();

        return response()->json([
            'success' => true,
            'message' => 'Workout berhasil dihapus!',
            'deleted' => $workoutInfo
        ]);
    }

    /**
     * Delete all completed workouts for user
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteCompleted()
    {
        $deletedCount = WorkoutPlan::where('user_id', Auth::id())
            ->where('is_completed', true)
            ->delete();

        return response()->json([
            'success' => true,
            'message' => "Berhasil menghapus {$deletedCount} workout yang sudah selesai",
            'deleted_count' => $deletedCount
        ]);
    }

    /**
     * Delete past workouts (older than specific date)
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deletePast(Request $request)
    {
        $beforeDate = $request->input('before_date', Carbon::now()->subMonths(1));

        $deletedCount = WorkoutPlan::where('user_id', Auth::id())
            ->where('workout_date', '<', $beforeDate)
            ->delete();

        return response()->json([
            'success' => true,
            'message' => "Berhasil menghapus {$deletedCount} workout lama",
            'deleted_count' => $deletedCount
        ]);
    }

    /**
     * Delete workouts by type
     * 
     * @param string $type
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteByType($type)
    {
        $validTypes = ['Arm Workout', 'Leg Workout', 'Back Workout', 'Core Workout', 'Cardio', 'Full Body'];

        if (!in_array($type, $validTypes)) {
            return response()->json([
                'success' => false,
                'message' => 'Tipe workout tidak valid'
            ], 400);
        }

        $deletedCount = WorkoutPlan::where('user_id', Auth::id())
            ->where('workout_type', $type)
            ->delete();

        return response()->json([
            'success' => true,
            'message' => "Berhasil menghapus {$deletedCount} workout tipe {$type}",
            'deleted_count' => $deletedCount
        ]);
    }

    /**
     * Delete all workouts for current user
     * (with confirmation required)
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteAll(Request $request)
    {
        // Require confirmation
        if ($request->input('confirm') !== 'DELETE_ALL') {
            return response()->json([
                'success' => false,
                'message' => 'Konfirmasi diperlukan. Kirim {"confirm": "DELETE_ALL"} untuk menghapus semua workout'
            ], 400);
        }

        $deletedCount = WorkoutPlan::where('user_id', Auth::id())->delete();

        return response()->json([
            'success' => true,
            'message' => "Semua workout berhasil dihapus ({$deletedCount} workout)",
            'deleted_count' => $deletedCount
        ]);
    }

    /**
     * Soft delete workout (if using soft deletes)
     * 
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function softDelete($id)
    {
        $workout = WorkoutPlan::where('id', $id)
            ->where('user_id', Auth::id())
            ->first();

        if (!$workout) {
            return response()->json([
                'success' => false,
                'message' => 'Workout tidak ditemukan'
            ], 404);
        }

        // If using soft deletes in model
        $workout->delete();

        return response()->json([
            'success' => true,
            'message' => 'Workout berhasil diarsipkan',
            'data' => $workout
        ]);
    }

    /**
     * Restore soft deleted workout
     * 
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function restore($id)
    {
        $workout = WorkoutPlan::withTrashed()
            ->where('id', $id)
            ->where('user_id', Auth::id())
            ->first();

        if (!$workout) {
            return response()->json([
                'success' => false,
                'message' => 'Workout tidak ditemukan'
            ], 404);
        }

        if (!$workout->trashed()) {
            return response()->json([
                'success' => false,
                'message' => 'Workout tidak dalam status terhapus'
            ], 400);
        }

        $workout->restore();

        return response()->json([
            'success' => true,
            'message' => 'Workout berhasil dipulihkan',
            'data' => $workout
        ]);
    }

    /**
     * Permanently delete soft-deleted workout
     * 
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function forceDelete($id)
    {
        $workout = WorkoutPlan::withTrashed()
            ->where('id', $id)
            ->where('user_id', Auth::id())
            ->first();

        if (!$workout) {
            return response()->json([
                'success' => false,
                'message' => 'Workout tidak ditemukan'
            ], 404);
        }

        $workout->forceDelete();

        return response()->json([
            'success' => true,
            'message' => 'Workout berhasil dihapus permanen'
        ]);
    }
}