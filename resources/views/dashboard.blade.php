<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - BodyBud</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Arial, sans-serif;

            /* 🌈 Gradient sekarang MENUTUPI seluruh halaman */
            background: linear-gradient(
                to bottom,
                #FFF8F0 0%, 
                #FFF4EB 20%,   
                #F7D9CF 55%,    
                #F1B9A7 80%,
                #E7A693 100%
            );

            background-attachment: fixed; /* 🌟 KUNCI: scroll tetap rapih */
            background-repeat: no-repeat;
            background-size: cover;
        }

        /* === FIXED & CLEAN NAVBAR === */
        .navbar {
            width: 100%;
            height: 75px;
            background: linear-gradient(90deg, #D4D96F 0%, #C9CF5E 100%);
            display: flex;
            justify-content: space-between;   /* kiri - tengah - kanan */
            align-items: center;
            padding: 0 60px;
            box-shadow: 0 3px 8px rgba(0,0,0,0.08);
        }

        /* LEFT: LOGO */
        .logo {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .logo-img {
            width: 42px;
        }

        .logo-text {
            font-size: 22px;
            font-weight: 700;
            color: #4A5D3F;
            text-decoration: none;
        }

        /* CENTER: MENU */
        .nav-menu {
            display: flex;
            gap: 45px;
            list-style: none;
        }

        .nav-menu a {
            text-decoration: none;
            font-size: 16px;
            color: #4A5D3F;
            font-weight: 600;
        }

        .nav-menu a:hover,
        .nav-menu .active {
            color: #2F3C24;
        }

        /* RIGHT: ICONS & USER */
        .nav-icons {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .icon-btn {
            background: none;            /* remove white box */
            border: none;
            width: 40px;
            height: 40px;
            border-radius: 10px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: .2s;
        }

        .icon-btn:hover {
            transform: scale(1.1);
        }

        .notif-badge {
            position: absolute;
            top: -4px;
            right: -4px;
            background: #FF6B6B;
            padding: 2px 6px;
            border-radius: 50%;
            color: white;
            font-size: 10px;
            font-weight: bold;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 6px 14px;
            background: rgba(255, 255, 255, 0.35);
            border-radius: 14px;
        }

        .user-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .user-name {
            font-size: 15px;
            font-weight: 600;
            color: #3E4D37;
        }

        .icon-btn {
            background: rgba(255, 255, 255, 0.5);
            border: none;
            width: 40px;
            height: 40px;
            border-radius: 10px;
            cursor: pointer;
            color: #4A5D3F;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.25s;
            position: relative;
        }

        .icon-btn:hover {
            background: white;
            transform: scale(1.05);
        }

        .icon-btn svg {
            width: 22px;
            height: 22px;
        }

        .notif-badge {
            position: absolute;
            top: -4px;
            right: -4px;
            background: #FF6B6B;
            color: white;
            font-size: 10px;
            font-weight: 700;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* HERO SECTION */
        .hero {
            padding: 50px 120px 40px;
        }

        .hero-container {
            background: linear-gradient(135deg, #E8F5C8 0%, #FFE5D9 50%, #FFD4C3 100%);
            border-radius: 22px;
            padding: 60px 50px;
            text-align: center;
            box-shadow: 0 8px 30px rgba(0,0,0,0.08);
        }

        .hero-title {
            font-size: 48px;
            font-weight: 800;
            color: #1a1a1a;
            margin-bottom: 10px;
        }

        .hero-body {
            font-size: 48px;
            font-weight: 800;
            background: linear-gradient(90deg, #D4D96F 0%, #B8A860 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-subtitle {
            font-size: 48px;
            font-weight: 800;
            color: #1a1a1a;
            margin-top: 10px;
        }

        .hero-subtitle span {
            color: #7A8B6E;
        }

        /* WORKOUT SECTION */
        .workout-section {
            padding: 20px 120px 80px;
        }

        .workout-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 30px;
        }

        .workout-card {
            background: white;
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            transition: all 0.3s;
        }

        .workout-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 35px rgba(0,0,0,0.15);
        }

        .workout-image {
            background: linear-gradient(135deg, #E8E8E8 0%, #D0D0D0 100%);
            height: 200px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        .workout-icons {
            display: flex;
            gap: 15px;
            opacity: 0.25;
        }

        .workout-icons svg {
            width: 50px;
            height: 50px;
        }

        /* Icon styling for each workout type */
        .card-arm .workout-icons svg {
            stroke: #FF6B6B;
        }

        .card-leg .workout-icons svg {
            stroke: #4A90E2;
        }

        .card-back .workout-icons svg {
            stroke: #6B8E6B;
        }

        .workout-content {
            padding: 25px;
        }

        .workout-title {
            font-size: 18px;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 20px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .btn-details {
            background: #000;
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 25px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            width: 100%;
        }

        .btn-details:hover {
            background: #333;
            transform: scale(1.02);
        }

        /* Color variants for cards */
        .card-arm .workout-image {
            background: linear-gradient(135deg, #FFD4D4 0%, #FFC0C0 100%);
        }

        .card-leg .workout-image {
            background: linear-gradient(135deg, #D4E5FF 0%, #B8D4FF 100%);
        }

        .card-back .workout-image {
            background: linear-gradient(135deg, #E8F5C8 0%, #D4E5B8 100%);
        }

        @media (max-width: 768px) {
            .navbar {
                padding: 18px 20px;
                flex-wrap: wrap;
            }

            .nav-menu {
                gap: 20px;
            }

            .hero {
                padding: 30px 20px 20px;
            }

            .hero-container {
                padding: 40px 25px;
            }

            .hero-title,
            .hero-body,
            .hero-subtitle {
                font-size: 32px;
            }

            .workout-section {
                padding: 20px 20px 60px;
            }

            .workout-grid {
                grid-template-columns: 1fr;
            }
        }

        .notification-panel {
            position: absolute;
            top: 80px;
            right: 60px;
            width: 300px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
            padding: 15px;
            display: none; /* awalnya disembunyikan */
            z-index: 999;
        }

        .notification-panel h4 {
            margin-bottom: 10px;
            font-size: 16px;
            font-weight: 700;
            color: #3c4b37;
        }

        .notif-item {
            padding: 10px 12px;
            border-radius: 10px;
            background: #f7f7f7;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .notif-item .title {
            font-weight: 700;
        }

        .notif-item .time {
            font-size: 12px;
            color: gray;
        }

        .loading-text {
            font-size: 14px; 
            color: #777;
        }
    </style>
</head>
<body>
    <!-- NAVBAR -->
    <nav class="navbar">

        <!-- LEFT : LOGO -->
        <div class="logo">
            <img src="/images/logo.png" alt="BodyBud Logo" class="logo-img">
            <a href="#" class="logo-text">BodyBud</a>
        </div>

        <!-- CENTER : MENU -->
        <ul class="nav-menu">
            <li><a href="#" class="active">Home</a></li>
            <li><a href="{{ route('myworkout') }}">My Workout</a></li>
            <li><a href="#">Progress</a></li>
            <li><a href="#">Profile</a></li>
        </ul>

        <!-- RIGHT : ICONS & USER -->
        <div class="nav-icons">

            <!-- Notification -->
            <a href="{{ route('notifikasi') }}" class="icon-btn" style="position: relative;">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" width="23">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 17h5l-1.4-1.4A2 2 0 0118 14.2V11a6 6 0 00-4-5.7V5a2 2 0 10-4 0v.3A6 6 0 006 11v3.2c0 .5-.2 1-.6 1.4L4 17h5m6 0v1a3 3 0 11-6 0v-1"/>
                </svg>
                @if($unreadCount ?? false)
                    <span class="notif-badge">{{ $unreadCount }}</span>
                @endif
            </a>

            <!-- User -->
            <div class="user-info">
                <div class="user-avatar">👤</div>
                <span class="user-name">{{ Auth::user()->name }}</span>
            </div>

            <!-- Logout -->
            <button class="icon-btn">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" width="22">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 16l4-4-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                </svg>
            </button>

        </div>

        <div class="notification-panel" id="notifPanel">
            <h4>Notifikasi</h4>
            <div id="notifList">
                <p class="loading-text">Memuat notifikasi...</p>
            </div>
        </div>


    </nav>


    <!-- HERO SECTION -->
    <div class="hero">
        <div class="hero-container">
            <h1 class="hero-title">Achieve Your</h1>
            <h1 class="hero-body">BODY GOALS</h1>
            <h1 class="hero-subtitle">with <span>BodyBud</span></h1>
        </div>
    </div>

    <!-- WORKOUT CARDS -->
    <div class="workout-section">
        <div class="workout-grid">
            <!-- ARM WORKOUT -->
            <div class="workout-card card-arm">
                <div class="workout-image">
                    <div class="workout-icons">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/>
                        </svg>
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"/>
                        </svg>
                    </div>
                </div>
                <div class="workout-content">
                    <h3 class="workout-title">ARM WORKOUT</h3>
                    <button class="btn-details">Details</button>
                </div>
            </div>

            <!-- LEG WORKOUT -->
            <div class="workout-card card-leg">
                <div class="workout-image">
                    <div class="workout-icons">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                    </div>
                </div>
                <div class="workout-content">
                    <h3 class="workout-title">LEG WORKOUT</h3>
                    <button class="btn-details">Details</button>
                </div>
            </div>

            <!-- BACK WORKOUT -->
            <div class="workout-card card-back">
                <div class="workout-image">
                    <div class="workout-icons">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                        </svg>
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
                <div class="workout-content">
                    <h3 class="workout-title">BACK WORKOUT</h3>
                    <button class="btn-details">Details</button>
                </div>
            </div>
        </div>
    </div>
    
    <script>
    document.querySelector(".icon-btn").addEventListener("click", function () {
        const panel = document.getElementById("notifPanel");
        panel.style.display = panel.style.display === "block" ? "none" : "block";

        loadNotifications();
    });

    function loadNotifications() {
        fetch("{{ route('notifications.get') }}")
            .then(res => res.json())
            .then(data => {
                const list = document.getElementById("notifList");
                list.innerHTML = "";

                if (data.data.data.length === 0) {
                    list.innerHTML = "<p>Tidak ada notifikasi</p>";
                    return;
                }

                data.data.data.forEach(notif => {
                    list.innerHTML += `
                        <div class="notif-item">
                            <div class="title">${notif.judul}</div>
                            <div class="message">${notif.pesan}</div>
                            <div class="time">${new Date(notif.created_at).toLocaleString()}</div>
                        </div>
                    `;
                });
            });
    }

    // Klik di luar panel → Panel tertutup
    document.addEventListener("click", function (e) {
        const panel = document.getElementById("notifPanel");
        const btn = document.querySelector(".icon-btn");

        if (!panel.contains(e.target) && !btn.contains(e.target)) {
            panel.style.display = "none";
        }
    });
    </script>

</body>
</html>