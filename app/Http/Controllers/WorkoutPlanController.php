<?php

namespace App\Http\Controllers;
use App\Models\Notifikasi;
use App\Models\WorkoutPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WorkoutPlanController extends Controller
{
    /**
     * Display a listing of the user's workout plans
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Get all workout plans for authenticated user, sorted by date
        $workouts = WorkoutPlan::where('user_id', Auth::id())
            ->orderBy('workout_date', 'asc')
            ->get();

        // Get unread notifications count (if you have notification system)
        $unread = Notifikasi::where('user_id', Auth::id())
        ->where('status', 'ditunda')
        ->count();


        return view('myworkout', compact('workouts', 'unread'));
    }

    /**
     * Display a specific workout plan
     * 
     * @param int $id
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
     * Get workouts as JSON for AJAX requests
     * 
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