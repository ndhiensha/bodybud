<?php

namespace App\Http\Controllers;

use App\Models\WorkoutPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class WorkoutPlanUpdateController extends Controller
{
    public function update(Request $request, $id)
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

        $validator = Validator::make($request->all(), [
            'workout_date' => 'required|date|after_or_equal:today',
            'workout_type' => 'required|string',
            'duration' => 'required|integer|min:1|max:300',
            'notes' => 'nullable|string|max:500'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $workout->update($validator->validated());

        return response()->json([
            'success' => true,
            'message' => 'Workout berhasil diupdate!',
            'data' => $workout
        ]);
    }
}
