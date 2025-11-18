<?php

namespace App\Http\Controllers;

use App\Models\WorkoutActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class WorkoutActivityLogController extends Controller
{
    // Ambil semua log user
    public function index()
    {
        $logs = WorkoutActivityLog::with('workout')
            ->where('user_id', Auth::id())
            ->orderBy('performed_at', 'desc')
            ->get();

        return response()->json([
            'status' => 'success',
            'data' => $logs
        ]);
    }

    // Simpan log baru (dipanggil saat user selesai workout)
    public function store(Request $request)
    {
        $request->validate([
            'workout_id' => 'required|exists:workouts,workout_id',
            'completed_sets' => 'required|integer|min:0',
            'duration' => 'required|integer|min:0',
            'calories' => 'required|integer|min:0',
        ]);

        $log = WorkoutActivityLog::create([
            'user_id' => Auth::id(),
            'workout_id' => $request->workout_id,
            'completed_sets' => $request->completed_sets,
            'duration' => $request->duration,
            'calories' => $request->calories,
            'performed_at' => now(),
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Workout log added',
            'data' => $log
        ]);
    }

    // Statistik dashboard
    public function stats()
    {
        $user = Auth::id();

        // Total duration (menit)
        $totalDuration = WorkoutActivityLog::where('user_id', $user)->sum('duration');

        // Total calories
        $totalCalories = WorkoutActivityLog::where('user_id', $user)->sum('calories');

        // Weekly bar chart (7 hari terakhir)
        $weekData = WorkoutActivityLog::where('user_id', $user)
            ->whereBetween('performed_at', [Carbon::now()->subDays(6), Carbon::now()])
            ->selectRaw('DATE(performed_at) as date, SUM(duration) as total_duration')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return response()->json([
            'status' => 'success',
            'total_duration' => $totalDuration,
            'total_calories' => $totalCalories,
            'week_chart' => $weekData,
        ]);
    }
}
