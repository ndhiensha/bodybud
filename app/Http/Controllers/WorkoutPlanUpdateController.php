<?php

namespace App\Http\Controllers;

use App\Models\WorkoutPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class WorkoutPlanUpdateController extends Controller
{
    /**
     * Update the specified workout plan
     * 
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
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

        // Validate incoming data
        $validator = Validator::make($request->all(), [
            'workout_date' => 'required|date|after_or_equal:today',
            'workout_type' => 'required|string|in:Arm Workout,Leg Workout,Back Workout,Core Workout,Cardio,Full Body',
            'duration' => 'required|integer|min:1|max:300',
            'notes' => 'nullable|string|max:500'
        ], [
            'workout_date.required' => 'Tanggal workout harus diisi',
            'workout_date.after_or_equal' => 'Tanggal workout tidak boleh di masa lalu',
            'workout_type.required' => 'Jenis workout harus dipilih',
            'workout_type.in' => 'Jenis workout tidak valid',
            'duration.required' => 'Durasi workout harus diisi',
            'duration.min' => 'Durasi minimal 1 menit',
            'duration.max' => 'Durasi maksimal 300 menit (5 jam)',
            'notes.max' => 'Catatan maksimal 500 karakter'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        // Check for duplicate (excluding current workout)
        $duplicate = WorkoutPlan::where('user_id', Auth::id())
            ->where('workout_date', $request->workout_date)
            ->where('workout_type', $request->workout_type)
            ->where('id', '!=', $id)
            ->first();

        if ($duplicate) {
            return response()->json([
                'success' => false,
                'message' => 'Sudah ada workout ' . $request->workout_type . ' di tanggal tersebut!'
            ], 409);
        }

        // Update workout
        $workout->update([
            'workout_date' => $request->workout_date,
            'workout_type' => $request->workout_type,
            'duration' => $request->duration,
            'notes' => $request->notes
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Workout berhasil diupdate!',
            'data' => $workout
        ]);
    }

    /**
     * Mark workout as completed/uncompleted
     * 
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function toggleComplete(Request $request, $id)
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

        // Toggle completion status
        $workout->is_completed = !$workout->is_completed;
        $workout->completed_at = $workout->is_completed ? now() : null;
        $workout->save();

        return response()->json([
            'success' => true,
            'message' => $workout->is_completed ? 'Workout ditandai selesai!' : 'Workout ditandai belum selesai',
            'data' => $workout
        ]);
    }

    /**
     * Bulk update workout plans
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function bulkUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'workout_ids' => 'required|array',
            'workout_ids.*' => 'required|integer|exists:workout_plans,id',
            'action' => 'required|string|in:complete,incomplete,delete'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $workouts = WorkoutPlan::whereIn('id', $request->workout_ids)
            ->where('user_id', Auth::id())
            ->get();

        if ($workouts->count() !== count($request->workout_ids)) {
            return response()->json([
                'success' => false,
                'message' => 'Beberapa workout tidak ditemukan'
            ], 404);
        }

        switch ($request->action) {
            case 'complete':
                $workouts->each(function ($workout) {
                    $workout->update(['is_completed' => true, 'completed_at' => now()]);
                });
                $message = 'Workout berhasil ditandai selesai';
                break;

            case 'incomplete':
                $workouts->each(function ($workout) {
                    $workout->update(['is_completed' => false, 'completed_at' => null]);
                });
                $message = 'Workout berhasil ditandai belum selesai';
                break;

            case 'delete':
                $workouts->each->delete();
                $message = 'Workout berhasil dihapus';
                break;
        }

        return response()->json([
            'success' => true,
            'message' => $message
        ]);
    }
}