<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BodyBud - Your Gym Friend</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Arial, sans-serif;
            background-color: #FFF8F0;
            overflow-x: hidden;
        }

        .container {
            background-color: #FFF8F0;
            min-height: 100vh;
            position: relative;
        }

        /* Navigation Bar */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 50px; 
            background: linear-gradient(90deg, #D4D96F 0%, #C9CF5E 100%);
            position: relative;
            z-index: 10;
        }

        .logo {
            display: flex;
            align-items: center;      
            gap: 10px;
        }

        .logo-img {
            width: 38px;
            height: auto;
            object-fit: contain;
        }

        .logo-text {
            font-size: 22px;
            font-weight: 700;
            color: #4A5D3F;
            letter-spacing: 0.5px;
            text-decoration: none;
        }

        .nav-menu {
            display: flex;
            list-style: none;
            gap: 45px;
            margin-left: auto;
            margin-right: 50px;
        }

        .nav-menu li a {
            text-decoration: none;
            color: #5A6B4F;
            font-size: 16px;
            font-weight: 500;
            transition: all 0.3s;
            position: relative;
        }

        .nav-menu li a:hover,
        .nav-menu li a.active {
            color: #3A4A2F;
            font-weight: 600;
        }

        .auth-buttons {
            display: flex;
            gap: 12px;
        }

        .btn-login,
        .btn-signup {
            padding: 8px 20px; 
            border-radius: 8px;
            font-size: 14px; 
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            border: none;
            text-decoration: none; 
            display: inline-block;
        }

        .btn-login {
            background-color: #D4D96F;
            color: #4A5D3F;
        }

        .btn-login:hover {
            background-color: #C9CF5E;
        }

        .btn-signup {
            background-color: #FFF8F0;
            color: #4A5D3F;
            border: 2px solid #4A5D3F;
        }

        .btn-signup:hover {
            background-color: rgba(74, 93, 63, 0.1);
        }

        /* Hero Section */
        .hero {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 60px; 
            background-color: transparent;
            position: relative;
            min-height: calc(100vh - 70px); 
            overflow: visible;
        }

        .hero-content {
            flex: 1;
            max-width: 400px; 
            z-index: 10; 
            padding-top: 0px; 
            margin-left: 100px; 
            margin-top: -30px; /* DINAikKAN SEDIKIT LAGI */
        }

        .hero-title {
            font-size: 85px;
            font-weight: 900;
            color: #5A5A5A;
            letter-spacing: 5px; 
            margin-bottom: 8px;
            line-height: 1;
        }

        .hero-subtitle {
            font-size: 46px;
            font-weight: 400;
            color: #8A8A8A;
            margin-bottom: 35px;
            letter-spacing: normal;
        }

        .hero-description {
            font-size: 18px;
            line-height: 1.75;
            color: #6A6A6A;
            margin-bottom: 45px;
        }

        .btn-start {
            padding: 16px 65px;
            background: linear-gradient(90deg, #E8ED9F 0%, #D4D96F 100%);
            border: none;
            border-radius: 35px;
            font-size: 18px;
            font-weight: 600;
            color: #4A5D3F;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 4px 15px rgba(212, 217, 111, 0.3);
            text-decoration: none;
        }

        .btn-start:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(212, 217, 111, 0.5);
        }

        /* Wave Background */
        .wave-background {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%; 
            height: 450px; 
            z-index: 2; 
            pointer-events: none;
        }

        .wave-background svg {
            width: 100%;
            height: 100%;
        }

        /* Runner Silhouette */
        .runner-silhouette {
            position: absolute;
            right: 150px; 
            bottom: 80px; /* DITURUNKAN SEDIKIT LAGI */
            width: 320px; 
            height: 450px; 
            z-index: 5; 
            animation: running 1.5s ease-in-out infinite;
        }

        /* Runner animation */
        @keyframes running {
            0%, 100% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-15px);
            }
        }

        /* Wave animation */
        .wave-back {
            animation: wave1 4s ease-in-out infinite;
        }

        .wave-front {
            animation: wave2 3s ease-in-out infinite;
        }

        /* PATH SVG GELOMBANG DITINGGIKAN (tetap sama dari sebelumnya) */
        @keyframes wave1 {
            0%, 100% {
                d: path("M0 280 Q480 180 960 280 T1920 280 L1920 450 L0 450 Z"); 
            }
            50% {
                d: path("M0 260 Q480 160 960 260 T1920 260 L1920 450 L0 450 Z"); 
            }
        }

        @keyframes wave2 {
            0%, 100% {
                d: path("M0 330 Q480 230 960 330 T1920 330 L1920 450 L0 450 Z"); 
            }
            50% {
                d: path("M0 315 Q480 215 960 315 T1920 315 L1920 450 L0 450 Z"); 
            }
        }

        /* Responsive Design */
        @media (max-width: 1200px) {
            .hero-content {
                max-width: 350px; 
                margin-left: 50px; 
                padding-top: 50px; /* Disesuaikan */
                margin-top: 0;
            }
            .runner-silhouette {
                width: 250px; 
                height: 350px; 
                right: 100px; 
                bottom: 70px; /* DITURUNKAN */
            }
            .wave-background {
                height: 400px; 
            }
            @keyframes wave1 { 
                0%, 100% { d: path("M0 230 Q480 130 960 230 T1920 230 L1920 400 L0 400 Z"); }
                50% { d: path("M0 210 Q480 110 960 210 T1920 210 L1920 400 L0 400 Z"); }
            }
            @keyframes wave2 { 
                0%, 100% { d: path("M0 280 Q480 180 960 280 T1920 280 L1920 400 L0 400 Z"); }
                50% { d: path("M0 265 Q480 165 960 265 T1920 265 L1920 400 L0 400 Z"); }
            }
        }

        @media (max-width: 1024px) {
            .hero {
                flex-direction: column;
                padding: 60px 40px 320px;
                align-items: flex-start;
                min-height: auto;
            }
            
            .hero-content {
                max-width: 100%; 
                padding-top: 20px; /* Disesuaikan */
                margin-left: 0; 
                margin-top: 0;
            }
            
            .runner-silhouette {
                right: 50%;
                transform: translateX(50%);
                bottom: 60px; /* DITURUNKAN */
                width: 200px; 
                height: 280px; 
            }

            .runner-silhouette:hover {
                animation: running 1.5s ease-in-out infinite;
            }
            .wave-background {
                height: 350px; 
            }
            @keyframes wave1 { 
                0%, 100% { d: path("M0 200 Q480 100 960 200 T1920 200 L1920 350 L0 350 Z"); }
                50% { d: path("M0 180 Q480 80 960 180 T1920 180 L1920 350 L0 350 Z"); }
            }
            @keyframes wave2 { 
                0%, 100% { d: path("M0 250 Q480 150 960 250 T1920 250 L1920 350 L0 350 Z"); }
                50% { d: path("M0 235 Q480 135 960 235 T1920 235 L1920 350 L0 350 Z"); }
            }
        }

        @media (max-width: 768px) {
            .hero {
                padding-bottom: 280px;
            }
            
            .runner-silhouette {
                width: 180px; 
                height: 250px; 
                bottom: 40px; /* DITURUNKAN */
            }
            
            .hero-title {
                font-size: 52px;
            }
            
            .hero-subtitle {
                font-size: 30px;
            }
            
            .wave-background {
                height: 300px; 
            }
            @keyframes wave1 { 
                0%, 100% { d: path("M0 170 Q480 90 960 170 T1920 170 L1920 300 L0 300 Z"); }
                50% { d: path("M0 150 Q480 70 960 150 T1920 150 L1920 300 L0 300 Z"); }
            }
            @keyframes wave2 { 
                0%, 100% { d: path("M0 220 Q480 140 960 220 T1920 220 L1920 300 L0 300 Z"); }
                50% { d: path("M0 205 Q480 125 960 205 T1920 205 L1920 300 L0 300 Z"); }
            }
        }

        @media (max-width: 480px) {
            .nav-menu {
                display: none;
            }
            
            .navbar {
                padding: 15px 20px;
            }
            
            .hero {
                padding: 40px 20px 240px;
            }
            
            .hero-title {
                font-size: 40px;
                letter-spacing: 3px;
            }
            
            .hero-subtitle {
                font-size: 24px;
            }
            
            .hero-description {
                font-size: 16px;
            }
            
            .runner-silhouette {
                width: 150px; 
                height: 220px; 
                bottom: 10px; /* DITURUNKAN */
            }
            
            .wave-background {
                height: 250px; 
            }
            @keyframes wave1 { 
                0%, 100% { d: path("M0 140 Q480 70 960 140 T1920 140 L1920 250 L0 250 Z"); }
                50% { d: path("M0 120 Q480 50 960 120 T1920 120 L1920 250 L0 250 Z"); }
            }
            @keyframes wave2 { 
                0%, 100% { d: path("M0 190 Q480 110 960 190 T1920 190 L1920 250 L0 250 Z"); }
                50% { d: path("M0 175 Q480 95 960 175 T1920 175 L1920 250 L0 250 Z"); }
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <nav class="navbar">
            <div class="logo">
                <img src="/images/logo.png" alt="BodyBud Logo" class="logo-img">
                <a href="#" class="logo-text">BodyBud</a>
            </div>
            <ul class="nav-menu">
                <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li><a href="{{ route('myworkout') }}" >My Workout</a></li>
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
                <a href="{{ route('register') }}" class="btn-start">Start Now</a>
            </div>
            
            <img class="runner-silhouette" src="{{ asset('images/runner-silhouette.png') }}">
        </section>
        
        <div class="wave-background">
            <svg viewBox="0 0 1920 450" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
                <path class="wave-back" d="M0 280 Q480 180 960 280 T1920 280 L1920 450 L0 450 Z" fill="#4A5D3F"/>
                <path class="wave-front" d="M0 330 Q480 230 960 330 T1920 330 L1920 450 L0 450 Z" fill="#6E825F"/>
            </svg>
        </div>
    </div>
</body>
</html>