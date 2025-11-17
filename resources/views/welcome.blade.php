<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BodyBud - Your Gym Friend</title>
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
    
</head>
<body>
    <div class="container">
        <nav class="navbar" id="navbar">
            <div class="logo">
                <img src="/images/logo.png" alt="BodyBud Logo" class="logo-img">
                <a href="#" class="logo-text">BodyBud</a>
            </div>
            <ul class="nav-menu">
                <li><a href="{{ route('dashboard') }}">Home</a></li>
                <li><a href="{{ route('myworkout') }}">My Workout</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        
            <div class="auth-buttons">
                <a href="{{ route('login') }}" class="btn-login">Login</a>
                <a href="{{ route('register') }}" class="btn-signup">Sign Up</a>
            </div>
        </nav>

        <section class="hero">
            <div class="hero-content">
                <h1 class="hero-title">BODYBUD</h1>
                <h2 class="hero-subtitle">your gym friend</h2>
                <p class="hero-description">
                    Find your workout buddy, track your progress, and<br>
                    stay motivated every day.
                </p>
                <a href="#" class="btn-start">Start Now</a>
            </div>
            
            <img class="runner-silhouette" src="/images/runner-silhouette.png" alt="Runner">
        </section>
        
        <div class="wave-background">
            <svg viewBox="0 0 1920 450" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
                <path class="wave-back" d="M0 280 Q480 180 960 280 T1920 280 L1920 450 L0 450 Z" fill="#4A5D3F"/>
                <path class="wave-front" d="M0 330 Q480 230 960 330 T1920 330 L1920 450 L0 450 Z" fill="#6E825F"/>
            </svg>
        </div>
    </div>

     <script src="{{ asset('js/header.js') }}"></script>
</body>
</html>