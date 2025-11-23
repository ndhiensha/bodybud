<?php

namespace App\Http\Controllers;

use App\Models\WorkoutPlan;
use Illuminate\Support\Facades\Auth;

class WorkoutPlanDeleteController extends Controller
{
    public function destroy($id)
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

        $workout->delete();

        return response()->json([
            'success' => true,
            'message' => 'Workout berhasil dihapus!'
        ]);
    }
}
