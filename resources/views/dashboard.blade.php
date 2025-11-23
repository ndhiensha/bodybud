<!DOCTYPE html>
<html lang="id">
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
            background: linear-gradient(
                to bottom,
                #FFF8F0 0%, 
                #FFF4EB 20%,   
                #F7D9CF 55%,    
                #F1B9A7 80%,
                #E7A693 100%
            );
            background-attachment: fixed;
            background-repeat: no-repeat;
            background-size: cover;
            min-height: 100vh;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 50px; 
            background: linear-gradient(90deg, #D4D96F 0%, #C9CF5E 100%);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .navbar.scrolled {
            padding: 12px 50px;
            background: linear-gradient(90deg, #C9CF5E 0%, #BEC555 100%);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .logo-img {
            width: 42px;
            height: 42px;
            background: #4A5D3F;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 800;
            font-size: 20px;
        }

        .logo-text {
            font-size: 22px;
            font-weight: 700;
            color: #4A5D3F;
            text-decoration: none;
            cursor: pointer;
        }

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
            transition: color 0.3s;
            cursor: pointer;
        }

        .nav-menu a:hover,
        .nav-menu .active {
            color: #2F3C24;
        }

        .nav-icons {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .icon-btn {
            background: rgba(255,255,255,0.5);
            border: none;
            width: 40px;
            height: 40px;
            border-radius: 10px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: .25s;
            position: relative;
        }

        .icon-btn:hover { 
            background: #fff; 
            transform: scale(1.05); 
        }

        .notif-badge {
            position: absolute;
            top: -4px;
            right: -4px;
            background: #FF6B6B;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            color: #fff;
            font-size: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight: 700;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 6px 14px;
            background: rgba(255,255,255,0.35);
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
            font-size: 18px;
        }

        .user-name { 
            font-weight: 600; 
            color: #3E4D37; 
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
            display: none;
            z-index: 999;
        }

        .notification-panel h4 {
            margin-bottom: 15px;
            color: #333;
        }

        .notif-item {
            padding: 12px;
            background: #f7f7f7;
            border-radius: 10px;
            margin-bottom: 8px;
            font-size: 14px;
            color: #666;
        }

        .logout-modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.45);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 99999;
        }

        .logout-modal.active { 
            display: flex; 
        }

        .logout-content {
            background: #fff;
            padding: 30px;
            width: 340px;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 8px 25px rgba(0,0,0,0.25);
        }

        .logout-content h2 {
            margin-bottom: 10px;
            color: #333;
        }

        .logout-content p {
            color: #666;
            margin-bottom: 25px;
        }

        .logout-actions {
            display: flex;
            gap: 12px;
        }

        .btn-cancel-logout,
        .btn-confirm-logout {
            flex: 1;
            padding: 12px;
            border-radius: 10px;
            border: none;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }

        .btn-cancel-logout { 
            background: #eaeaea;
            color: #333;
        }

        .btn-cancel-logout:hover {
            background: #d5d5d5;
        }

        .btn-confirm-logout { 
            background: #FF6B6B; 
            color: white; 
        }

        .btn-confirm-logout:hover {
            background: #ff5252;
        }

        .hero {
            padding: 50px 120px 40px;
            margin-top: 90px;
        }

        .hero-container {
            background: linear-gradient(135deg, #E8F5C8 0%, #FFE5D9 50%, #FFD4C3 100%);
            border-radius: 22px;
            padding: 60px 50px;
            text-align: center;
            box-shadow: 0 8px 30px rgba(0,0,0,0.08);
        }

        .hero-title, .hero-body, .hero-subtitle {
            font-size: 48px;
            font-weight: 800;
            margin: 5px 0;
        }

        .hero-title {
            color: #1a1a1a;
        }

        .hero-body {
            background: linear-gradient(90deg, #D4D96F 0%, #B8A860 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-subtitle {
            color: #1a1a1a;
        }

        .hero-subtitle span {
            color: #7A8B6E;
        }

        .workout-list-section {
            padding: 40px 120px 80px;
        }

        .section-header {
            margin-bottom: 30px;
        }

        .section-title {
            font-size: 2rem;
            font-weight: 800;
            color: #333;
            margin-bottom: 25px;
        }

        .filter-container {
            background: white;
            padding: 25px;
            border-radius: 18px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            margin-bottom: 30px;
        }

        .filter-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: #333;
            margin-bottom: 15px;
        }

        .filter-buttons {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .filter-btn {
            padding: 10px 24px;
            border: none;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            background: #e8e8e8;
            color: #555;
        }

        .filter-btn:hover {
            background: #d5d5d5;
        }

        .filter-btn.active {
            background: #4CAF50;
            color: white;
        }

        .workout-cards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 25px;
        }

        .workout-item-card {
            background: white;
            border-radius: 18px;
            padding: 25px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
            cursor: pointer;
            animation: fadeIn 0.5s ease both;
        }

        .workout-item-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 30px rgba(0,0,0,0.12);
        }

        .workout-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 12px;
        }

        .workout-name {
            font-size: 1.4rem;
            font-weight: 700;
            color: #333;
            margin-bottom: 8px;
        }

        .category-badge {
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
            color: white;
            display: inline-block;
        }

        .category-badge.arm {
            background: #FF6B6B;
        }

        .category-badge.leg {
            background: #4A90E2;
        }

        .category-badge.abs {
            background: #6B8E6B;
        }

        .workout-description {
            color: #666;
            font-size: 14px;
            line-height: 1.6;
            margin-bottom: 18px;
        }

        .workout-stats {
            display: flex;
            gap: 15px;
            margin-bottom: 18px;
            flex-wrap: wrap;
        }

        .stat-item {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 14px;
            color: #555;
            font-weight: 600;
        }

        .btn-view-detail {
            width: 100%;
            background: #4CAF50;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 10px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-view-detail:hover {
            background: #45a049;
            transform: scale(1.02);
        }

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            z-index: 10000;
            align-items: center;
            justify-content: center;
            padding: 20px;
            overflow-y: auto;
        }

        .modal.active {
            display: flex;
        }

        .modal-content {
            background: white;
            border-radius: 20px;
            max-width: 800px;
            width: 100%;
            max-height: 90vh;
            overflow-y: auto;
            animation: slideUp 0.3s ease;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .modal-header {
            padding: 30px;
            border-bottom: 2px solid #f0f0f0;
            position: sticky;
            top: 0;
            background: white;
            z-index: 10;
        }

        .modal-close {
            float: right;
            background: #f0f0f0;
            border: none;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            font-size: 1.5rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .modal-close:hover {
            background: #e0e0e0;
            transform: rotate(90deg);
        }

        .modal-title {
            font-size: 2rem;
            font-weight: 700;
            color: #333;
            margin-top: 10px;
        }

        .modal-body {
            padding: 30px;
        }

        .video-container {
            position: relative;
            padding-bottom: 56.25%;
            height: 0;
            overflow: hidden;
            border-radius: 15px;
            margin-bottom: 30px;
            background: #000;
        }

        .video-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        .detail-section {
            margin-bottom: 30px;
        }

        .detail-section h3 {
            font-size: 1.3rem;
            font-weight: 700;
            color: #333;
            margin-bottom: 15px;
        }

        .detail-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .detail-item {
            text-align: center;
            padding: 20px;
            background: #f8f9fa;
            border-radius: 15px;
        }

        .detail-value {
            font-size: 2rem;
            font-weight: 800;
            color: #333;
            margin-bottom: 8px;
        }

        .detail-label {
            font-size: 0.9rem;
            color: #666;
            font-weight: 500;
        }

        .instructions-list {
            list-style: none;
            padding: 0;
        }

        .instructions-list li {
            padding: 15px;
            padding-left: 50px;
            background: #f8f9fa;
            border-radius: 10px;
            margin-bottom: 10px;
            position: relative;
        }

        .instructions-list li:before {
            content: attr(data-step);
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            background: #000;
            color: white;
            width: 28px;
            height: 28px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.85rem;
            font-weight: 700;
        }

        .btn-start-workout {
            width: 100%;
            background: #4CAF50;
            color: white;
            padding: 20px;
            border: none;
            border-radius: 50px;
            font-size: 1.2rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 20px;
        }

        .btn-start-workout:hover {
            background: #45a049;
            transform: scale(1.02);
        }

        .workout-timer-modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.9);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 99999;
            padding: 20px;
        }

        .workout-timer-modal.active {
            display: flex;
        }

        .timer-content {
            background: white;
            border-radius: 25px;
            max-width: 500px;
            width: 100%;
            padding: 40px;
            text-align: center;
        }

        .timer-header {
            margin-bottom: 30px;
        }

        .timer-exercise-name {
            font-size: 2rem;
            font-weight: 800;
            color: #333;
            margin-bottom: 10px;
        }

        .timer-stats {
            display: flex;
            justify-content: center;
            gap: 30px;
            margin-bottom: 40px;
        }

        .timer-stat {
            text-align: center;
        }

        .timer-stat-value {
            font-size: 1.5rem;
            font-weight: 700;
            color: #4CAF50;
        }

        .timer-stat-label {
            font-size: 0.9rem;
            color: #666;
            margin-top: 5px;
        }

        .set-progress {
            background: #f0f0f0;
            padding: 30px;
            border-radius: 20px;
            margin-bottom: 30px;
        }

        .set-info {
            font-size: 1.1rem;
            color: #666;
            margin-bottom: 20px;
        }

        .rep-counter {
            font-size: 4rem;
            font-weight: 800;
            color: #4CAF50;
            margin: 20px 0;
        }

        .reps-info {
            font-size: 1.2rem;
            color: #666;
            margin-bottom: 20px;
        }

        .exercise-timer {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px;
            border-radius: 15px;
            margin-bottom: 20px;
        }

        .timer-label {
            font-size: 0.9rem;
            opacity: 0.9;
            margin-bottom: 5px;
        }

        .timer-display {
            font-size: 3rem;
            font-weight: 800;
        }

        .rest-period {
            display: none;
            background: linear-gradient(135deg, #FFB84D 0%, #FF8C42 100%);
            padding: 40px;
            border-radius: 20px;
            margin-bottom: 30px;
            color: white;
        }

        .rest-title {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .rest-timer {
            font-size: 5rem;
            font-weight: 800;
            margin: 20px 0;
        }

        .rest-message {
            font-size: 1.1rem;
            opacity: 0.9;
        }

        .workout-controls {
            display: flex;
            gap: 15px;
            margin-bottom: 15px;
        }

        .btn-rep-complete {
            flex: 2;
            background: #4CAF50;
            color: white;
            padding: 20px;
            border: none;
            border-radius: 15px;
            font-size: 1.2rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-rep-complete:hover {
            background: #45a049;
            transform: scale(1.02);
        }

        .btn-stop-workout {
            flex: 1;
            background: #FF6B6B;
            color: white;
            padding: 20px;
            border: none;
            border-radius: 15px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-stop-workout:hover {
            background: #ff5252;
        }

        .btn-finish-workout {
            width: 100%;
            background: #2196F3;
            color: white;
            padding: 18px;
            border: none;
            border-radius: 15px;
            font-size: 1.1rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-finish-workout:hover {
            background: #1976D2;
            transform: scale(1.02);
        }

        .btn-skip-rest {
            background: white;
            color: #FF8C42;
            padding: 15px 40px;
            border: 2px solid white;
            border-radius: 12px;
            font-size: 1rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-skip-rest:hover {
            background: rgba(255, 255, 255, 0.9);
        }

        .workout-complete-modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 99999;
            padding: 20px;
        }

        .workout-complete-modal.active {
            display: flex;
        }

        .complete-content {
            background: linear-gradient(135deg, #4CAF50 0%, #45a049 100%);
            border-radius: 25px;
            max-width: 500px;
            width: 100%;
            padding: 50px 40px;
            text-align: center;
            color: white;
            animation: celebrationBounce 0.6s ease;
        }

        @keyframes celebrationBounce {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        .complete-icon {
            font-size: 5rem;
            margin-bottom: 20px;
            animation: rotate 0.8s ease;
        }

        @keyframes rotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        .complete-title {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 15px;
        }

        .complete-message {
            font-size: 1.2rem;
            margin-bottom: 30px;
            opacity: 0.95;
        }

        .complete-stats {
            background: rgba(255, 255, 255, 0.2);
            padding: 30px;
            border-radius: 20px;
            margin-bottom: 30px;
            backdrop-filter: blur(10px);
        }

        .complete-stat-row {
            display: flex;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }

        .complete-stat-row:last-child {
            border-bottom: none;
        }

        .complete-stat-label {
            font-weight: 600;
            opacity: 0.9;
        }

        .complete-stat-value {
            font-weight: 800;
            font-size: 1.2rem;
        }

        .complete-actions {
            display: flex;
            gap: 15px;
            justify-content: center;
        }

        .btn-close-complete {
            background: white;
            color: #4CAF50;
            padding: 18px 40px;
            border: none;
            border-radius: 15px;
            font-size: 1.1rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-close-complete:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        .btn-view-progress {
            background: #2196F3;
            color: white;
            padding: 18px 40px;
            border: none;
            border-radius: 15px;
            font-size: 1.1rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-view-progress:hover {
            background: #1976D2;
            transform: scale(1.05);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        @media (max-width: 768px) {
            .navbar {
                padding: 15px 20px;
                flex-wrap: wrap;
            }

            .nav-menu {
                gap: 20px;
                font-size: 14px;
            }

            .hero {
                padding: 30px 20px 20px;
                margin-top: 80px;
            }

            .hero-container {
                padding: 40px 25px;
            }

            .hero-title, .hero-body, .hero-subtitle {
                font-size: 32px;
            }

            .workout-list-section {
                padding: 30px 20px 60px;
            }

            .workout-cards-grid {
                grid-template-columns: 1fr;
            }

            .section-title {
                font-size: 1.5rem;
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .no-results {
            text-align: center;
            padding: 60px 20px;
            color: #999;
            font-size: 1.1rem;
        }
    </style>
</head>
<body>
    <nav class="navbar" id="navbar">
        <div class="logo">
            <img src="/images/logo.png"div class="logo-img"></div>
            <a class="logo-text">BodyBud</a>
        </div>

        <ul class="nav-menu">
            <li><a href="{{ route('dashboard') }}" class="active">Home</a></li>
                <li><a href="{{ route('myworkout') }}" >My Workout</a></li>
                <li><a href="{{ route('progress') }}">Progress</a></li>
                <li><a href="{{ route('profile') }}">Profile</a></li>
        </ul>

        <div class="nav-icons">
            <button class="icon-btn" id="notifBtn">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" width="23">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 17h5l-1.4-1.4A2 2 0 0118 14.2V11a6 6 0 00-4-5.7V5a2 2 0 10-4 0v.3A6 6 0 006 11v3.2c0 .5-.2 1-.6 1.4L4 17h5m6 0v1a3 3 0 11-6 0v-1"/>
                </svg>
                <span class="notif-badge">3</span>
            </button>

            <div class="user-info">
                <div class="user-avatar">👤</div>
                <span class="user-name">Diandra</span>
            </div>

            <button class="icon-btn" id="btnLogout">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" width="22">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 16l4-4-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                </svg>
            </button>
        </div>

        <div class="notification-panel" id="notifPanel">
            <h4>Notifikasi</h4>
            <div id="notifList">
                <div class="notif-item">🎉 Selamat! Kamu sudah workout 3 hari berturut-turut!</div>
                <div class="notif-item">💪 Jangan lupa leg workout hari ini!</div>
                <div class="notif-item">🔥 Kamu sudah bakar 500 kalori minggu ini!</div>
            </div>
        </div>
    </nav>

    <div class="hero">
        <div class="hero-container">
            <h1 class="hero-title">Achieve Your</h1>
            <h1 class="hero-body">BODY GOALS</h1>
            <h1 class="hero-subtitle">with <span>BodyBud</span></h1>
        </div>
    </div>

    <div class="workout-list-section">
        <div class="section-header">
            <h2 class="section-title">Daftar Workout</h2>
            
            <div class="filter-container">
                <h3 class="filter-title">Filter Kategori</h3>
                <div class="filter-buttons">
                    <button class="filter-btn active" data-category="all">Semua</button>
                    <button class="filter-btn" data-category="arm">Arm</button>
                    <button class="filter-btn" data-category="leg">Leg</button>
                    <button class="filter-btn" data-category="abs">Abs</button>
                </div>
            </div>
        </div>

        <div class="workout-cards-grid" id="workoutGrid"></div>
    </div>

    <div class="modal" id="exerciseModal">
        <div class="modal-content">
            <div class="modal-header">
                <button class="modal-close" onclick="closeModal()">×</button>
                <h2 class="modal-title" id="modalTitle"></h2>
            </div>
            <div class="modal-body">
                <div class="video-container" id="videoContainer"></div>
                
                <div class="detail-grid">
                    <div class="detail-item">
                        <div class="detail-value" id="modalCalories">0</div>
                        <div class="detail-label">Kalori</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-value" id="modalDuration">0</div>
                        <div class="detail-label">Menit</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-value" id="modalReps">0</div>
                        <div class="detail-label">Repetisi</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-value" id="modalSets">0</div>
                        <div class="detail-label">Set</div>
                    </div>
                </div>

                <div class="detail-section">
                    <h3>📝 Cara Melakukan</h3>
                    <ul class="instructions-list" id="modalInstructions"></ul>
                </div>

                <div class="detail-section">
                    <h3>⚠️ Tips & Perhatian</h3>
                    <p id="modalTips" style="color: #666; line-height: 1.8;"></p>
                </div>

                <button class="btn-start-workout" id="btnStartWorkout">
                    🏋️ Mulai Latihan Sekarang
                </button>
            </div>
        </div>
    </div>

    <div id="logoutModal" class="logout-modal">
        <div class="logout-content">
            <h2>Yakin Mau Keluar?</h2>
            <p>Kamu akan logout dari BodyBud.</p>
            <div class="logout-actions">
                <button class="btn-cancel-logout" id="btnCancelLogout">Batal</button>
                <button class="btn-confirm-logout" onclick="logout()">Ya, Keluar</button>
            </div>
        </div>
    </div>

    <div id="workoutTimerModal" class="workout-timer-modal">
        <div class="timer-content">
            <div class="timer-header">
                <h2 class="timer-exercise-name" id="timerExerciseName">Push Up</h2>
                <div class="timer-stats">
                    <div class="timer-stat">
                        <div class="timer-stat-value" id="timerTotalSets">3</div>
                        <div class="timer-stat-label">Total Set</div>
                    </div>
                    <div class="timer-stat">
                        <div class="timer-stat-value" id="timerTotalReps">15</div>
                        <div class="timer-stat-label">Reps/Set</div>
                    </div>
                    <div class="timer-stat">
                        <div class="timer-stat-value" id="timerCalories">50</div>
                        <div class="timer-stat-label">Kalori</div>
                    </div>
                </div>
            </div>

            <div class="set-progress">
                <div class="set-info">Set <span id="currentSetNumber">1</span> dari <span id="totalSetsDisplay">3</span></div>
                
                <div class="exercise-timer">
                    <div class="timer-label">Waktu Latihan</div>
                    <div class="timer-display" id="exerciseTimer">00:00</div>
                </div>

                <div class="rep-counter" id="currentRepNumber">0</div>
                <div class="reps-info">
                    <span id="repsRemaining">15</span> reps tersisa
                </div>
            </div>

            <div class="rest-period" id="restPeriod">
                <div class="rest-title">⏸️ Istirahat</div>
                <div class="rest-timer" id="restTimeLeft">60</div>
                <div class="rest-message">detik</div>
                <button class="btn-skip-rest" id="btnSkipRest">Lewati Istirahat</button>
            </div>

            <div class="workout-controls" id="workoutControls">
                <button class="btn-rep-complete" id="btnCompleteRep">
                    ✓ Selesai 1 Rep
                </button>
                <button class="btn-stop-workout" id="btnStopWorkout">
                    ✕ Stop
                </button>
            </div>
            
            <button class="btn-finish-workout" id="btnFinishWorkout">
                ✅ Selesai Workout
            </button>
        </div>
    </div>

    <div id="workoutCompleteModal" class="workout-complete-modal">
        <div class="complete-content">
            <div class="complete-icon">🎉</div>
            <h2 class="complete-title">Workout Selesai!</h2>
            <p class="complete-message">Kamu hebat! Terus pertahankan konsistensimu!</p>
            
            <div class="complete-stats">
                <div class="complete-stat-row">
                    <span class="complete-stat-label">Latihan</span>
                    <span class="complete-stat-value" id="completedExerciseName">Push Up</span>
                </div>
                <div class="complete-stat-row">
                    <span class="complete-stat-label">Set Selesai</span>
                    <span class="complete-stat-value"><span id="completedSets">3</span> set</span>
                </div>
                <div class="complete-stat-row">
                    <span class="complete-stat-label">Total Reps</span>
                    <span class="complete-stat-value"><span id="completedReps">45</span> reps</span>
                </div>
                <div class="complete-stat-row">
                    <span class="complete-stat-label">Kalori Terbakar</span>
                    <span class="complete-stat-value"><span id="completedCalories">50</span> kal</span>
                </div>
                <div class="complete-stat-row">
                    <span class="complete-stat-label">Durasi</span>
                    <span class="complete-stat-value"><span id="completedDuration">5</span> menit</span>
                </div>
            </div>

            <div class="complete-actions">
                <button class="btn-close-complete" id="btnCloseComplete">
                    Kembali ke Dashboard
                </button>
                <button class="btn-view-progress" id="btnViewProgress">
                    Lihat Progress
                </button>
            </div>
        </div>
    </div>

    <script>
        const workoutData = {
            arm: [
                {
                    name: "Push Up",
                    description: "Latihan klasik untuk dada, trisep, dan bahu. Cocok untuk pemula hingga advanced.",
                    calories: 50,
                    duration: 5,
                    reps: 15,
                    sets: 3,
                    videoId: "IODxDxX7oi4",
                    instructions: [
                        "Mulai dengan posisi plank, tangan selebar bahu",
                        "Turunkan tubuh hingga dada hampir menyentuh lantai",
                        "Jaga tubuh tetap lurus dari kepala hingga kaki",
                        "Dorong tubuh kembali ke posisi awal",
                        "Ulangi gerakan dengan kontrol penuh"
                    ],
                    tips: "Jaga core tetap kencang. Jangan biarkan pinggul turun. Nafas keluar saat naik, masuk saat turun."
                },
                {
                    name: "Bicep Curls",
                    description: "Dumbbell bicep curls untuk kekuatan lengan atas.",
                    calories: 40,
                    duration: 8,
                    reps: 12,
                    sets: 4,
                    videoId: "ykJmrZ5v0Oo",
                    instructions: [
                        "Berdiri tegak dengan dumbbell di kedua tangan",
                        "Siku tetap dekat dengan tubuh",
                        "Angkat beban ke arah bahu dengan memutar pergelangan tangan",
                        "Tahan sebentar di posisi atas",
                        "Turunkan perlahan ke posisi awal"
                    ],
                    tips: "Jangan ayun tubuh. Fokus pada kontraksi biceps. Gunakan beban yang sesuai kemampuan."
                },
                {
                    name: "Tricep Dips",
                    description: "Bodyweight exercise untuk tricep yang kuat.",
                    calories: 45,
                    duration: 6,
                    reps: 12,
                    sets: 3,
                    videoId: "6kALZikXxLc",
                    instructions: [
                        "Duduk di tepi kursi/bench, tangan di samping pinggul",
                        "Geser tubuh ke depan hingga pantat melayang",
                        "Turunkan tubuh dengan menekuk siku 90 derajat",
                        "Dorong kembali ke atas dengan tricep",
                        "Jaga punggung dekat dengan kursi"
                    ],
                    tips: "Jangan turun terlalu dalam jika baru mulai. Fokus pada tricep, bukan bahu."
                }
            ],
            leg: [
                {
                    name: "Squats",
                    description: "Raja dari semua latihan kaki. Melatih paha, glutes, dan core.",
                    calories: 70,
                    duration: 10,
                    reps: 15,
                    sets: 4,
                    videoId: "aclHkVaku9U",
                    instructions: [
                        "Berdiri dengan kaki selebar bahu",
                        "Turunkan pinggul seperti duduk di kursi",
                        "Jaga lutut tidak melewati jari kaki",
                        "Turun hingga paha sejajar lantai",
                        "Dorong tumit untuk kembali berdiri"
                    ],
                    tips: "Jaga dada tetap tegak. Berat badan di tumit, bukan jari kaki."
                },
                {
                    name: "Lunges",
                    description: "Latihan satu kaki yang efektif untuk quadriceps dan glutes.",
                    calories: 65,
                    duration: 8,
                    reps: 12,
                    sets: 3,
                    videoId: "QOVaHwm-Q6U",
                    instructions: [
                        "Berdiri tegak, melangkah maju dengan satu kaki",
                        "Turunkan pinggul hingga kedua lutut 90 derajat",
                        "Lutut belakang hampir menyentuh lantai",
                        "Dorong kaki depan untuk kembali berdiri",
                        "Ganti kaki dan ulangi"
                    ],
                    tips: "Jaga tubuh tegak. Lutut depan tidak boleh melewati jari kaki."
                }
            ],
            abs: [
                {
                    name: "Crunches",
                    description: "Latihan abs klasik yang efektif untuk upper abs.",
                    calories: 40,
                    duration: 5,
                    reps: 20,
                    sets: 3,
                    videoId: "Xyd_fa5zoEU",
                    instructions: [
                        "Berbaring telentang, lutut ditekuk",
                        "Tangan di belakang kepala (jangan tarik leher)",
                        "Angkat bahu dari lantai menggunakan abs",
                        "Exhale saat naik, inhale saat turun",
                        "Jangan angkat punggung bawah dari lantai"
                    ],
                    tips: "Fokus pada abs, bukan leher. Gerakan tidak perlu naik tinggi."
                },
                {
                    name: "Plank",
                    description: "Latihan core terbaik untuk stabilitas dan kekuatan inti.",
                    calories: 45,
                    duration: 5,
                    reps: 60,
                    sets: 3,
                    videoId: "pSHjTRCQxIw",
                    instructions: [
                        "Posisi forearm plank, siku di bawah bahu",
                        "Tubuh lurus dari kepala hingga tumit",
                        "Aktifkan abs dan glutes",
                        "Jangan biarkan pinggul turun atau naik",
                        "Tahan posisi sesuai waktu yang ditentukan"
                    ],
                    tips: "Bernafas normal. Jika terlalu berat, turunkan lutut ke lantai."
                }
            ]
        };

        let currentFilter = 'all';
        let selectedExercise = null;
        let allWorkouts = [];
        let currentSet = 1;
        let currentRep = 0;
        let isResting = false;
        let restTimer = null;
        let restTimeLeft = 60;
        let workoutStartTime = null;
        let exerciseTimer = null;
        let exerciseTimeElapsed = 0;

        function prepareWorkouts() {
            allWorkouts = [];
            Object.keys(workoutData).forEach(category => {
                workoutData[category].forEach(workout => {
                    allWorkouts.push({
                        ...workout,
                        category: category
                    });
                });
            });
            renderWorkouts();
        }

        function renderWorkouts() {
            const grid = document.getElementById('workoutGrid');
            
            let filteredWorkouts = currentFilter === 'all' 
                ? allWorkouts 
                : allWorkouts.filter(w => w.category === currentFilter);

            if (filteredWorkouts.length === 0) {
                grid.innerHTML = '<div class="no-results">Tidak ada workout untuk kategori ini.</div>';
                return;
            }

            grid.innerHTML = filteredWorkouts.map((workout, index) => `
                <div class="workout-item-card" onclick="showExerciseDetail('${workout.category}', '${workout.name}')" style="animation-delay: ${index * 0.05}s">
                    <div class="workout-header">
                        <div>
                            <h3 class="workout-name">${workout.name}</h3>
                            <span class="category-badge ${workout.category}">${workout.category.charAt(0).toUpperCase() + workout.category.slice(1)}</span>
                        </div>
                    </div>
                    
                    <p class="workout-description">${workout.description}</p>
                    
                    <div class="workout-stats">
                        <div class="stat-item">
                            <strong>Repetisi:</strong> ${workout.reps}x
                        </div>
                        <div class="stat-item">
                            <strong>Durasi:</strong> ${workout.duration} mnt
                        </div>
                        <div class="stat-item">
                            <strong>Kalori:</strong> ${workout.calories} kal
                        </div>
                    </div>
                    
                    <button class="btn-view-detail">Lihat Detail</button>
                </div>
            `).join('');
        }

        document.querySelectorAll('.filter-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                currentFilter = this.getAttribute('data-category');
                renderWorkouts();
            });
        });

        function showExerciseDetail(category, name) {
            selectedExercise = workoutData[category].find(w => w.name === name);
            if (!selectedExercise) return;

            selectedExercise.category = category;

            const modal = document.getElementById('exerciseModal');
            
            document.getElementById('modalTitle').textContent = selectedExercise.name;
            document.getElementById('modalCalories').textContent = selectedExercise.calories;
            document.getElementById('modalDuration').textContent = selectedExercise.duration;
            document.getElementById('modalReps').textContent = selectedExercise.reps;
            document.getElementById('modalSets').textContent = selectedExercise.sets;
            document.getElementById('modalTips').textContent = selectedExercise.tips;
            
            document.getElementById('videoContainer').innerHTML = `
                <iframe 
                    src="https://www.youtube.com/embed/${selectedExercise.videoId}" 
                    frameborder="0" 
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                    allowfullscreen>
                </iframe>
            `;
            
            const instructionsList = document.getElementById('modalInstructions');
            instructionsList.innerHTML = selectedExercise.instructions.map((instruction, i) => `
                <li data-step="${i + 1}">${instruction}</li>
            `).join('');
            
            modal.classList.add('active');
            document.body.style.overflow = 'hidden';

            const startBtn = document.getElementById('btnStartWorkout');
            if (startBtn) {
                startBtn.onclick = startWorkout;
            }
        }

        function closeModal() {
            const modal = document.getElementById('exerciseModal');
            modal.classList.remove('active');
            document.body.style.overflow = 'auto';
        }

        function startWorkout() {
            if (!selectedExercise) {
                alert('Terjadi kesalahan. Silakan pilih latihan lagi.');
                return;
            }
            
            closeModal();
            setTimeout(() => {
                showWorkoutTimer();
            }, 300);
        }

        function showWorkoutTimer() {
            if (!selectedExercise) return;

            const timerModal = document.getElementById('workoutTimerModal');
            timerModal.classList.add('active');
            document.body.style.overflow = 'hidden';
            
            document.getElementById('timerExerciseName').textContent = selectedExercise.name;
            document.getElementById('timerTotalSets').textContent = selectedExercise.sets;
            document.getElementById('timerTotalReps').textContent = selectedExercise.reps;
            document.getElementById('timerCalories').textContent = selectedExercise.calories;
            document.getElementById('totalSetsDisplay').textContent = selectedExercise.sets;
            
            currentSet = 1;
            currentRep = 0;
            isResting = false;
            workoutStartTime = new Date();
            exerciseTimeElapsed = 0;
            
            document.getElementById('restPeriod').style.display = 'none';
            document.getElementById('workoutControls').style.display = 'block';
            
            updateTimerDisplay();
            startExerciseTimer();
            
            document.getElementById('btnCompleteRep').onclick = completeRep;
            document.getElementById('btnStopWorkout').onclick = stopWorkout;
            document.getElementById('btnSkipRest').onclick = skipRest;
            document.getElementById('btnFinishWorkout').onclick = finishWorkout;
        }

        function updateTimerDisplay() {
            if (!selectedExercise) return;
            
            document.getElementById('currentSetNumber').textContent = currentSet;
            document.getElementById('currentRepNumber').textContent = currentRep;
            document.getElementById('repsRemaining').textContent = selectedExercise.reps - currentRep;
        }

        function startExerciseTimer() {
            clearInterval(exerciseTimer);
            exerciseTimer = setInterval(() => {
                exerciseTimeElapsed++;
                updateExerciseTimerDisplay();
            }, 1000);
        }

        function updateExerciseTimerDisplay() {
            const minutes = Math.floor(exerciseTimeElapsed / 60);
            const seconds = exerciseTimeElapsed % 60;
            document.getElementById('exerciseTimer').textContent = 
                `${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
        }

        function completeRep() {
            if (isResting || !selectedExercise) return;
            
            currentRep++;
            updateTimerDisplay();
            
            if (currentRep >= selectedExercise.reps) {
                if (currentSet >= selectedExercise.sets) {
                    completeWorkout();
                } else {
                    startRestPeriod();
                }
            }
        }

        function startRestPeriod() {
            if (!selectedExercise) return;
            
            isResting = true;
            restTimeLeft = 60;
            
            clearInterval(exerciseTimer);
            
            document.getElementById('restPeriod').style.display = 'block';
            document.getElementById('workoutControls').style.display = 'none';
            
            updateRestTimer();
            restTimer = setInterval(() => {
                restTimeLeft--;
                updateRestTimer();
                
                if (restTimeLeft <= 0) {
                    endRestPeriod();
                }
            }, 1000);
        }

        function updateRestTimer() {
            document.getElementById('restTimeLeft').textContent = restTimeLeft;
        }

        function skipRest() {
            clearInterval(restTimer);
            endRestPeriod();
        }

        function endRestPeriod() {
            isResting = false;
            currentSet++;
            currentRep = 0;
            
            document.getElementById('restPeriod').style.display = 'none';
            document.getElementById('workoutControls').style.display = 'block';
            
            updateTimerDisplay();
            startExerciseTimer();
        }

        function stopWorkout() {
            if (confirm('Yakin mau berhenti? Progress workout tidak akan tersimpan.')) {
                clearInterval(restTimer);
                clearInterval(exerciseTimer);
                document.getElementById('workoutTimerModal').classList.remove('active');
                document.body.style.overflow = 'auto';
            }
        }

        function finishWorkout() {
            if (confirm('Selesaikan workout sekarang? Progress akan disimpan.')) {
                saveAndCompleteWorkout();
            }
        }

        function saveAndCompleteWorkout() {
            if (!selectedExercise) return;
            
            clearInterval(restTimer);
            clearInterval(exerciseTimer);
            
            const workoutEndTime = new Date();
            const duration = Math.round((workoutEndTime - workoutStartTime) / 1000 / 60) || 1;
            
            const actualSetsCompleted = currentRep > 0 ? currentSet : currentSet - 1;
            const totalRepsCompleted = (actualSetsCompleted - 1) * selectedExercise.reps + currentRep;
            
            const workoutRecord = {
                id: Date.now(),
                name: selectedExercise.name,
                category: selectedExercise.category || 'general',
                date: workoutEndTime.toISOString(),
                sets: actualSetsCompleted,
                reps: selectedExercise.reps,
                totalReps: totalRepsCompleted,
                calories: selectedExercise.calories,
                duration: duration,
                completed: true
            };
            
            saveWorkoutToHistory(workoutRecord);
            
            document.getElementById('workoutTimerModal').classList.remove('active');
            
            setTimeout(() => {
                window.location.href = 'dashboard.html';
            }, 500);
        }

        function completeWorkout() {
            if (!selectedExercise) return;
            
            clearInterval(restTimer);
            clearInterval(exerciseTimer);
            
            const workoutEndTime = new Date();
            const duration = Math.round((workoutEndTime - workoutStartTime) / 1000 / 60) || 1;
            
            const workoutRecord = {
                id: Date.now(),
                name: selectedExercise.name,
                category: selectedExercise.category || 'general',
                date: workoutEndTime.toISOString(),
                sets: selectedExercise.sets,
                reps: selectedExercise.reps,
                totalReps: selectedExercise.sets * selectedExercise.reps,
                calories: selectedExercise.calories,
                duration: duration,
                completed: true
            };
            
            saveWorkoutToHistory(workoutRecord);
            
            document.getElementById('workoutTimerModal').classList.remove('active');
            
            const completeModal = document.getElementById('workoutCompleteModal');
            completeModal.classList.add('active');
            
            document.getElementById('completedExerciseName').textContent = selectedExercise.name;
            document.getElementById('completedSets').textContent = selectedExercise.sets;
            document.getElementById('completedReps').textContent = selectedExercise.sets * selectedExercise.reps;
            document.getElementById('completedCalories').textContent = selectedExercise.calories;
            document.getElementById('completedDuration').textContent = duration;
        }

        function saveWorkoutToHistory(workout) {
            try {
                let history = JSON.parse(localStorage.getItem('workoutHistory') || '[]');
                history.unshift(workout);
                localStorage.setItem('workoutHistory', JSON.stringify(history));
                console.log('Workout saved:', workout);
            } catch (e) {
                console.error('Error saving workout:', e);
            }
        }

        function closeCompleteModal() {
            document.getElementById('workoutCompleteModal').classList.remove('active');
            document.body.style.overflow = 'auto';
        }

        function goToProgress() {
            window.location.href = 'progress.html';
        }

        const notifBtn = document.getElementById("notifBtn");
        const notifPanel = document.getElementById("notifPanel");
        const btnLogout = document.getElementById("btnLogout");
        const logoutModal = document.getElementById("logoutModal");
        const btnCancelLogout = document.getElementById("btnCancelLogout");

        notifBtn.addEventListener("click", () => {
            notifPanel.style.display = notifPanel.style.display === "block" ? "none" : "block";
        });

        btnLogout.addEventListener("click", () => {
            logoutModal.classList.add("active");
        });

        btnCancelLogout.addEventListener("click", () => {
            logoutModal.classList.remove("active");
        });

        logoutModal.addEventListener("click", (e) => {
            if (e.target === logoutModal) {
                logoutModal.classList.remove("active");
            }
        });

        function logout() {
            alert("Logout berhasil! Sampai jumpa lagi di BodyBud 👋");
            logoutModal.classList.remove("active");
        }

        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        document.getElementById('exerciseModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeModal();
            }
        });

        document.addEventListener('click', function(e) {
            if (!notifBtn.contains(e.target) && !notifPanel.contains(e.target)) {
                notifPanel.style.display = 'none';
            }
        });

        document.getElementById('btnCloseComplete').onclick = closeCompleteModal;
        document.getElementById('btnViewProgress').onclick = goToProgress;

        prepareWorkouts();
    </script>
</body>
</html>