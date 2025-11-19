<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $info['title'] }}</title>
    <link rel="stylesheet" href="{{ asset('css/workout.css') }}">
</head>
<body>
    <div class="container">
        <div class="header-detail">
            <a href="{{ route('workouts.index') }}" class="btn-back">← Kembali</a>
            <h1 class="detail-title">{{ $info['title'] }}</h1>
            <p class="detail-subtitle">{{ count($workouts) }} latihan • Total {{ $workouts->sum('calories') }} kalori</p>
        </div>

        <div class="steps-container">
            @foreach($workouts as $workout)
            <div class="step-card {{ $info['color'] }}" data-step="{{ $workout->step_order }}">
                <div class="step-header">
                    <div class="step-number">STEP {{ $workout->step_order }}</div>
                    <div class="step-stats">
                        <span class="stat">🔥 {{ $workout->calories }} kal</span>
                        <span class="stat">⏱️ {{ $workout->duration_in_minutes }} min</span>
                        <span class="stat">🔄 {{ $workout->repetitions }}x</span>
                    </div>
                </div>
                
                <div class="step-body">
                    <h3 class="exercise-name">{{ $workout->name }}</h3>
                    <p class="exercise-description">{{ $workout->description }}</p>
                </div>

                <div class="step-footer">
                    <button class="btn-start" onclick="startExercise({{ $workout->step_order }}, '{{ $workout->name }}')">
                        Mulai Latihan
                    </button>
                </div>
            </div>
            @endforeach
        </div>

        <div class="total-summary {{ $info['color'] }}">
            <h3>Total Workout</h3>
            <div class="summary-grid">
                <div class="summary-item">
                    <div class="summary-value">{{ $workouts->sum('calories') }}</div>
                    <div class="summary-label">Total Kalori</div>
                </div>
                <div class="summary-item">
                    <div class="summary-value">{{ ceil($workouts->sum('duration') / 60) }}</div>
                    <div class="summary-label">Menit</div>
                </div>
                <div class="summary-item">
                    <div class="summary-value">{{ $workouts->sum('repetitions') }}</div>
                    <div class="summary-label">Total Repetisi</div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/workout.js') }}"></script>
</body>
</html>