<?php

namespace App\Http\Controllers;

use App\Models\WorkoutPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class WorkoutPlanCreateController extends Controller
{
    /**
     * Workout types allowed
     */
    private const ALLOWED_WORKOUT_TYPES = [
        'Arm Workout',
        'Leg Workout',
        'Back Workout',
        'Core Workout',
        'Cardio',
        'Full Body',
    ];

    /**
     * Store a newly created workout plan
     */
    public function store(Request $request)
    {
        // Validate input
        $validator = Validator::make($request->all(), [
            'workout_date' => 'required|date|after_or_equal:today',
            'workout_type' => ['required', 'string', Rule::in(self::ALLOWED_WORKOUT_TYPES)],
            'duration'     => 'required|integer|min:1|max:300',
            'notes'        => 'nullable|string|max:500',
        ], [
            'workout_date.required' => 'Tanggal workout harus diisi',
            'workout_date.after_or_equal' => 'Tanggal workout tidak boleh di masa lalu',
            'workout_type.required' => 'Jenis workout harus dipilih',
            'workout_type.in' => 'Jenis workout tidak valid',
            'duration.required' => 'Durasi workout harus diisi',
            'duration.min' => 'Durasi minimal 1 menit',
            'duration.max' => 'Durasi maksimal 300 menit (5 jam)',
            'notes.max' => 'Catatan maksimal 500 karakter',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors'  => $validator->errors(),
            ], 422);
        }

        // Hanya data tervalidasi yang dipakai
        $data = $validator->validated();
        $userId = Auth::id();

        // Check duplicate workout (type + date)
        $existingWorkout = WorkoutPlan::where('user_id', $userId)
            ->where('workout_date', $data['workout_date'])
            ->where('workout_type', $data['workout_type'])
            ->first();

        if ($existingWorkout) {
            return response()->json([
                'success' => false,
                'message' => 'Kamu sudah punya workout ' . $data['workout_type'] . ' di tanggal ini!'
            ], 409);
        }

        // Create workout
        $workout = WorkoutPlan::create([
            'user_id'       => $userId,
            'workout_date'  => $data['workout_date'],
            'workout_type'  => $data['workout_type'],
            'duration'      => $data['duration'],
            'notes'         => $data['notes'] ?? null,
            'is_completed'  => false,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Workout berhasil ditambahkan!',
            'data'    => $workout,
        ], 201);
    }

    /**
     * Validate data only (optional)
     */
    public function validateWorkout(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'workout_date' => 'required|date|after_or_equal:today',
            'workout_type' => 'required|string',
            'duration'     => 'required|integer|min:1|max:300'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors'  => $validator->errors(),
            ], 422);
        }

        return response()->json([
            'success' => true,
            'message' => 'Validation passed'
        ]);
    }
}
