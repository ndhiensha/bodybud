<?php

namespace App\Http\Controllers;

use App\Models\Workout;
use Illuminate\Http\Request;

class WorkoutController extends Controller
{
    public function index()
    {
        $categories = [
            'arm' => [
                'title' => 'ARM WORKOUT',
                'color' => 'pink',
                'icon' => '💪',
                'count' => Workout::where('category', 'arm')->count()
            ],
            'leg' => [
                'title' => 'LEG WORKOUT',
                'color' => 'blue',
                'icon' => '⚡',
                'count' => Workout::where('category', 'leg')->count()
            ],
            'back' => [
                'title' => 'BACK WORKOUT',
                'color' => 'green',
                'icon' => '❤️',
                'count' => Workout::where('category', 'back')->count()
            ]
        ];

        return view('workouts.index', compact('categories'));
    }

    public function show($category)
    {
        $validCategories = ['arm', 'leg', 'back'];
        
        if (!in_array($category, $validCategories)) {
            abort(404);
        }

        $workouts = Workout::byCategory($category)->get();
        
        $categoryInfo = [
            'arm' => ['title' => 'ARM WORKOUT', 'color' => 'pink'],
            'leg' => ['title' => 'LEG WORKOUT', 'color' => 'blue'],
            'back' => ['title' => 'BACK WORKOUT', 'color' => 'green']
        ];

        $info = $categoryInfo[$category];
        
        return view('workouts.show', compact('workouts', 'category', 'info'));
    }
}