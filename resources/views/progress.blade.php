@extends('layouts.app')

@section('title', 'My Progress')

@section('content')
<link rel="stylesheet" href="{{ asset('css/progress.css') }}">

<div class="container">
    <h1 class="page-title">My Progress</h1>

    <!-- Summary Cards -->
    <div class="summary-grid">
        <div class="summary-card">
            <div class="card-icon">🔥</div>
            <div class="card-content">
                <h3>Total Calories</h3>
                <p class="big-number" id="totalCalories">0</p>
                <span class="label">kcal burned</span>
            </div>
        </div>

        <div class="summary-card">
            <div class="card-icon">💪</div>
            <div class="card-content">
                <h3>Workouts Done</h3>
                <p class="big-number" id="totalWorkouts">0</p>
                <span class="label">sessions</span>
            </div>
        </div>

        <div class="summary-card">
            <div class="card-icon">⏱️</div>
            <div class="card-content">
                <h3>Total Time</h3>
                <p class="big-number" id="totalTime">0</p>
                <span class="label">minutes</span>
            </div>
        </div>

        <div class="summary-card">
            <div class="card-icon">🎯</div>
            <div class="card-content">
                <h3>Streak</h3>
                <p class="big-number" id="streak">0</p>
                <span class="label">days</span>
            </div>
        </div>
    </div>

    <!-- Weekly Chart -->
    <div class="chart-section">
        <h2>Weekly Activity</h2>
        <div class="chart-container">
            <canvas id="weeklyChart"></canvas>
        </div>
    </div>

    <!-- Categories -->
    <div class="categories-section">
        <h2>Workout Categories</h2>
        <div class="category-list">
            <div class="category-item">
                <div class="category-header">
                    <span class="category-name">💪 Arm Workout</span>
                    <span class="category-percentage" id="armPercentage">0%</span>
                </div>
                <div class="progress-bar">
                    <div class="progress-fill" id="armProgress"></div>
                </div>
                <span class="category-detail" id="armDetail"></span>
            </div>

            <div class="category-item">
                <div class="category-header">
                    <span class="category-name">🦵 Leg Workout</span>
                    <span class="category-percentage" id="legPercentage">0%</span>
                </div>
                <div class="progress-bar">
                    <div class="progress-fill" id="legProgress"></div>
                </div>
                <span class="category-detail" id="legDetail"></span>
            </div>

            <div class="category-item">
                <div class="category-header">
                    <span class="category-name">🎯 Core Workout</span>
                    <span class="category-percentage" id="corePercentage">0%</span>
                </div>
                <div class="progress-bar">
                    <div class="progress-fill" id="coreProgress"></div>
                </div>
                <span class="category-detail" id="coreDetail"></span>
            </div>
        </div>
    </div>

    <!-- Recent Activities -->
    <div class="activities-section">
        <h2>Recent Activities</h2>
        <div class="activity-list" id="activityList"></div>
    </div>

    <!-- Goals -->
    <div class="goals-section">
        <h2>Weekly Goals</h2>

        <div class="goal-item">
            <div class="goal-header">
                <span>Workout Days</span>
                <span id="goalDays"></span>
            </div>
            <div class="progress-bar">
                <div class="progress-fill goal-progress" id="goalDaysProgress"></div>
            </div>
        </div>

        <div class="goal-item">
            <div class="goal-header">
                <span>Calorie Target</span>
                <span id="goalCalories"></span>
            </div>
            <div class="progress-bar">
                <div class="progress-fill goal-progress" id="goalCaloriesProgress"></div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="{{ asset('js/progress.js') }}"></script>
<script>
    window.progressData = @json($progress);

</script>

@endsection
