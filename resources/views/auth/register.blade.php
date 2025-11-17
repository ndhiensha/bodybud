<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - BodyBud</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Arial, sans-serif;
            background: linear-gradient(
                to bottom,
                #FFF8F0 0%, 
                #FFF4EB 40%,   
                #F7CFC4 70%,   
                #EAB2A0 100%   
            );
        }

        .container {
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

        .logo-icon {
            width: 32px;
            height: 32px;
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

        .logo-img {
            width: 38px;
            height: auto;
            object-fit: contain;
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

        /* FORM WRAPPER */
        .wrapper {
            width: 100%;
            display: flex;
            justify-content: center;
            margin-top: 50px;
            position: relative;
            z-index: 10;
        }

        .card {
            width: 450px;
            background: white;
            padding: 40px;
            border-radius: 22px;
            box-shadow: 0px 10px 40px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h2 {
            font-size: 32px;
            margin-bottom: 20px;
            font-weight: 700;
        }

        /* Alert Messages */
        .alert {
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
            text-align: left;
        }

        .alert-danger {
            background-color: #fee;
            color: #c33;
            border: 1px solid #fcc;
        }

        .alert ul {
            margin: 0;
            padding-left: 20px;
        }

        .alert li {
            margin: 4px 0;
        }

        /* INPUT FIELD */
        .input-group {
            position: relative;
            width: 100%;
            margin-bottom: 15px;
        }

        .input-group input {
            width: 100%;
            padding: 16px 16px 16px 50px;
            border-radius: 12px;
            border: 1px solid #e5e5e5;
            background: #F8F8F8;
            font-size: 15px;
        }

        .input-group input:focus {
            background: #fff;
            border-color: #D4C878;
            outline: none;
        }

        .input-group svg {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            width: 20px;
            stroke: #777;
        }

        /* BUTTON */
        button {
            width: 100%;
            padding: 16px;
            background: #E7E48A;
            border: none;
            border-radius: 12px;
            font-size: 17px;
            font-weight: 600;
            cursor: pointer;
            margin-top: 10px;
        }

        button:hover {
            background: #D8D57A;
            transform: translateY(-2px);
        }

        .small-link {
            margin-top: 20px;
            font-size: 14px;
        }

        .small-link a {
            color: #C95B7B;
            font-weight: 600;
            text-decoration: none;
        }

        .decor {
            position: absolute;
            z-index: 1;
            opacity: 0.85;
            pointer-events: none;
            user-select: none;
        }

        .dumbbell-left {
            width: 90px;
            top: 150px;
            left: 90px;
            transform: rotate(-20deg);
        }

        .shoe-left {
            width: 110px;
            top: 360px;
            left: 120px;
            transform: rotate(10deg);
        }

        .dumbbell-right {
            width: 90px;
            top: 350px;
            right: 160px;
            transform: rotate(20deg);
        }

        .shoe-right {
            width: 115px;
            top: 150px;
            right: 130px;
            transform: rotate(-15deg);
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

        .wave-back {
            animation: wave1 4s ease-in-out infinite;
        }

        .wave-front {
            animation: wave2 3s ease-in-out infinite;
        }

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

        @media (max-width: 480px) {
            .nav-menu {
                display: none;
            }
            
            .navbar {
                padding: 15px 20px;
            }
        }
    </style>

</head>
<body>

    <!-- NAVBAR -->
    <nav class="navbar">
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

    <!-- DECORATION ELEMENTS -->
    <img src="/images/dumbbell.png" class="decor dumbbell-left">
    <img src="/images/shoe.png" class="decor shoe-left">
    <img src="/images/dumbbell.png" class="decor dumbbell-right">
    <img src="/images/shoe.png" class="decor shoe-right">

    <!-- SIGN UP FORM -->
    <div class="wrapper">
        <div class="card">
            <h2>Create Account</h2>

            <!-- TAMPILKAN ERROR VALIDASI -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- NAME -->
                <div class="input-group">
                    <svg fill="none" stroke-width="2" viewBox="0 0 24 24">
                        <circle cx="12" cy="8" r="4"></circle>
                        <path d="M4 20c0-4 4-6 8-6s8 2 8 6"></path>
                    </svg>
                    <input type="text" name="name" placeholder="Full Name" value="{{ old('name') }}" required>
                </div>

                <!-- EMAIL -->
                <div class="input-group">
                    <svg fill="none" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M4 4h16v16H4z"/>
                        <path d="M4 4l8 8 8-8"/>
                    </svg>
                    <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
                </div>

                <!-- PASSWORD -->
                <div class="input-group">
                    <svg fill="none" stroke-width="2" viewBox="0 0 24 24">
                        <rect x="3" y="11" width="18" height="11" rx="2"/>
                        <path d="M7 11V7a5 5 0 0110 0v4"/>
                    </svg>
                    <input type="password" name="password" placeholder="Password" required>
                </div>

                <!-- CONFIRM PASSWORD -->
                <div class="input-group">
                    <svg fill="none" stroke-width="2" viewBox="0 0 24 24">
                        <rect x="3" y="11" width="18" height="11" rx="2"/>
                        <path d="M7 11V7a5 5 0 0110 0v4"/>
                    </svg>
                    <input type="password" name="password_confirmation" placeholder="Confirm Password" required>
                </div>

                <button type="submit">Sign Up</button>

                <p class="small-link">
                    Already have an account?
                    <a href="{{ route('login') }}">Login</a>
                </p>
            </form>
        </div>
    </div>

    <!-- WAVE -->
    <div class="wave-background">
        <svg viewBox="0 0 1920 450" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
            <path class="wave-back" d="M0 280 Q480 180 960 280 T1920 280 L1920 450 L0 450 Z" fill="#4A5D3F"/>
            <path class="wave-front" d="M0 330 Q480 230 960 330 T1920 330 L1920 450 L0 450 Z" fill="#6E825F"/>
        </svg>
    </div>
</body>
</html>