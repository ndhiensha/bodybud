<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Workout Categories</title>
    <link rel="stylesheet" href="{{ asset('css/workout.css') }}">
</head>
<body>
    <div class="container">
        <h1 class="main-title">PILIH KATEGORI WORKOUT</h1>
        
        <div class="cards-container">
            @foreach($categories as $key => $category)
            <div class="workout-card {{ $category['color'] }}">
                <div class="card-header">
                    <div class="icon-group">
                        <span class="icon">{{ $category['icon'] }}</span>
                        <span class="icon secondary">📊</span>
                    </div>
                </div>
                <div class="card-body">
                    <h2 class="workout-title">{{ $category['title'] }}</h2>
                    <p class="workout-count">{{ $category['count'] }} Latihan</p>
                    <a href="{{ route('workouts.show', $key) }}" class="btn-details">Details</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <script src="{{ asset('js/workout.js') }}"></script>
</body>
</html>