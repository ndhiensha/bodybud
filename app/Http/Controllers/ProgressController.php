<?php

namespace App\Http\Controllers;

use App\Models\Progress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProgressController extends Controller
{
    // Menampilkan progress sebagai JSON (kalau dipakai api)
    public function index()
    {
        $user = Auth::user();

        $progress = Progress::with('workout')
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'status' => 'success',
            'data' => $progress
        ]);
    }

    // Halaman view progress
    public function showPage()
    {
        $user = Auth::user();

        $progress = Progress::with('workout')
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('progress', compact('progress'));
    }


    // Mulai workout
    public function start(Request $request)
    {
        $request->validate([
            'workout_id' => 'required|exists:workouts,workout_id',
            'total_sets' => 'required|integer|min:1',
        ]);

        $progress = Progress::create([
            'user_id' => Auth::id(),
            'workout_id' => $request->workout_id,
            'total_sets' => $request->total_sets,
            'completed_sets' => 0,
            'progress_percentage' => 0,
            'status' => 'In Progress',
            'start_time' => now(),
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Workout started',
            'data' => $progress
        ]);
    }

    // Update sets
    public function updateSets(Request $request, $id)
    {
        $request->validate([
            'completed_sets' => 'required|integer|min:0',
        ]);

        $progress = Progress::findOrFail($id);

        $progress->completed_sets = $request->completed_sets;
        $progress->progress_percentage =
            ($progress->completed_sets / $progress->total_sets) * 100;

        if ($progress->progress_percentage >= 100) {
            $progress->status = 'Completed';
            $progress->end_time = now();
        }

        $progress->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Progress updated',
            'data' => $progress
        ]);
    }
}
