<?php

namespace App\Http\Controllers;
use App\Models\Notifications;
use App\Models\WorkoutPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WorkoutPlanController extends Controller
{
    public function index()
{
    $workouts = WorkoutPlan::where('user_id', Auth::id())
        ->orderBy('workout_date', 'asc')
        ->get();

    $unread = Notifications::where('user_id', Auth::id())
        ->where('status', 'ditunda')
        ->count();

    return view('myworkout', compact('workouts', 'unread'));
}
    /*
     * @param int 
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $workout = WorkoutPlan::where('id', $id)
            ->where('user_id', Auth::id())
            ->first();

        if (!$workout) {
            return response()->json([
                'success' => false,
                'message' => 'Workout not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $workout
        ]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getWorkouts()
    {
        $workouts = WorkoutPlan::where('user_id', Auth::id())
            ->orderBy('workout_date', 'asc')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $workouts
        ]);
    }
}