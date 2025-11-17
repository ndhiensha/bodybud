<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - BodyBud</title>

    <!-- STYLE DARI LANDING PAGE (100% SAMA) -->
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
                #FFF4EB 40%,   /* krem */
                #F7CFC4 70%,   /* mulai pink lembut */
                #EAB2A0 100%   /* pink lebih kuat */
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

        /* ===== FORM EXACT STYLE ===== */

        .login-card {
            width: 420px;
            background: #ffffff;
            padding: 40px 35px;
            border-radius: 22px;
            text-align: center;
            border: 1px solid #e9e9e9;
            box-shadow: 0 10px 25px rgba(0,0,0,0.08);
        }

        .login-card h2 {
            font-size: 28px;
            font-weight: 700;
            color: #2c2c2c;
            margin-bottom: 25px;
        }

        .login-wrapper {
            width: 100%;
            height: calc(100vh - 90px); /* supaya hitung space setelah navbar */
            display: flex;
            justify-content: center;   /* center horizontal */
            align-items: center;       /* center vertical */
            position: relative;
            z-index: 10;
            margin-top: 0; /* hilangkan dorongan dari atas */
        }


        /* FORM INPUT */
        .input-field {
            position: relative;
            margin-bottom: 18px;
        }

        .input-field input {
            width: 100%;
            padding: 14px 15px 14px 45px;
            border-radius: 12px;
            border: 2px solid #dede85;   /* kuning lembut */
            background: #ffffff;
            font-size: 15px;
            outline: none;
        }

        .input-field input:focus {
            border-color: #c4c45a;
        }

        /* ICON DALAM INPUT */
        .input-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
        }

        /* BUTTON */
        .btn-submit {
            width: 100%;
            padding: 14px;
            margin-top: 10px;
            background: #ecec93;     /* warna kuning muda */
            border: none;
            color: #3b3b3b;
            font-size: 17px;
            font-weight: 600;
            border-radius: 20px;
            cursor: pointer;
            transition: 0.25s;
        }

        .btn-submit:hover {
            background: #e1e178;
        }

        /* Bottom link */
        .bottom-text {
            margin-top: 15px;
            font-size: 14px;
            color: #444;
        }

        .bottom-text a {
            color: #e07ea8;   /* pink seperti gambar */
            text-decoration: none;
        }

        .bottom-text a:hover {
            text-decoration: underline;
        }

        

        .footer-links {
            margin-top: 20px;
            font-size: 14px;
            color: #666;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .footer-links a {
            color: #333;
            text-decoration: none;
            font-weight: 500;
        }

        .footer-links a:hover {
            color: #D4C878;
        }

               
        .decor {
            position: absolute;
            z-index: 1;
            opacity: 0.85;
            pointer-events: none;
            user-select: none;
        }

        /* === POSISI === */
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

        <!-- NAVBAR DARI LANDING PAGE -->
        <nav class="navbar">
            <div class="logo">
                <img src="/images/logo.png" alt="BodyBud Logo" class="logo-img">
                   <a href="#" class="logo-text">BodyBud</a>
            </div>
            <ul class="nav-menu">
                <li><a href="{{ route('dashboard') }}">Home</a></li>
                <li><a href="{{ route('myworkout') }}" >My Workout</a></li>
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

        <!-- LOGIN CARD -->
        <!-- LOGIN CARD (FIX 100% SAMA UI GAMBAR) -->
        <div class="login-wrapper">
            <div class="login-card">

                <h2>Welcome back!</h2>

                <form action="{{ route('login') }}" method="POST">
                    @csrf

                    <!-- Email Field -->
                    <div class="input-field">
                        <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#888">
                            <path d="M2 4l8 5 8-5v10H2z" stroke="#888" stroke-width="1.5" fill="none"/>
                        </svg>
                        <input type="email" name="email" placeholder="Email" required>
                    </div>

                    <!-- Password Field -->
                    <div class="input-field">
                        <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#888">
                            <path d="M6 10V7a4 4 0 018 0v3h1a1 1 0 011 1v5H4v-5a1 1 0 011-1h1zm3 3h2" stroke="#888" 
                            stroke-linecap="round" stroke-width="1.5" fill="none"/>
                        </svg>
                        <input type="password" name="password" placeholder="Password" required>
                    </div>

                    <!-- Button -->
                    <button class="btn-submit" type="submit">Login</button>

                    <!-- Bottom Link -->
                    <p class="bottom-text">
                        don’t have an account?
                        <a href="{{ route('register') }}">Sign Up</a>
                    </p>
                </form>
            </div>
        </div>


        <!-- WAVE COPY PERSIS -->
         <div class="wave-background">
            <svg viewBox="0 0 1920 450" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
                <path class="wave-back" d="M0 280 Q480 180 960 280 T1920 280 L1920 450 L0 450 Z" fill="#4A5D3F"/>
                <path class="wave-front" d="M0 330 Q480 230 960 330 T1920 330 L1920 450 L0 450 Z" fill="#6E825F"/>
            </svg>
        </div>

    </div>

</body>
</html>
