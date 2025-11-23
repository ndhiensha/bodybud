<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Progress - BodyBud</title>
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
            min-height: 100vh;
        }

        /* NAVBAR - sama seperti dashboard */
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

        /* PROGRESS CONTENT */
        .progress-container {
            padding: 50px 120px 80px;
            margin-top: 90px;
        }

        .page-title {
            font-size: 2.5rem;
            font-weight: 800;
            color: #333;
            margin-bottom: 40px;
        }

        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 25px;
            margin-bottom: 50px;
        }

        .stat-card {
            background: white;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            text-align: center;
            transition: transform 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .stat-icon {
            font-size: 3rem;
            margin-bottom: 15px;
        }

        .stat-value {
            font-size: 2.5rem;
            font-weight: 800;
            color: #4CAF50;
            margin-bottom: 10px;
        }

        .stat-label {
            font-size: 1rem;
            color: #666;
            font-weight: 600;
        }

        /* Workout History */
        .history-section {
            background: white;
            padding: 35px;
            border-radius: 20px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        }

        .history-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .history-title {
            font-size: 1.8rem;
            font-weight: 800;
            color: #333;
        }

        .btn-clear-history {
            background: #FF6B6B;
            color: white;
            padding: 10px 25px;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-clear-history:hover {
            background: #ff5252;
        }

        .history-list {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .history-item {
            background: #f8f9fa;
            padding: 25px;
            border-radius: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: all 0.3s ease;
            animation: fadeInUp 0.5s ease;
        }

        .history-item:hover {
            background: #f0f0f0;
            transform: translateX(5px);
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .history-item-left {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .history-icon {
            width: 60px;
            height: 60px;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
        }

        .history-icon.arm {
            background: #FFE5E5;
        }

        .history-icon.leg {
            background: #E3F2FD;
        }

        .history-icon.abs {
            background: #E8F5E9;
        }

        .history-details h3 {
            font-size: 1.3rem;
            font-weight: 700;
            color: #333;
            margin-bottom: 8px;
        }

        .history-meta {
            display: flex;
            gap: 20px;
            font-size: 0.9rem;
            color: #666;
        }

        .history-item-right {
            text-align: right;
        }

        .history-stats {
            display: flex;
            gap: 25px;
            margin-bottom: 8px;
        }

        .history-stat {
            text-align: center;
        }

        .history-stat-value {
            font-size: 1.3rem;
            font-weight: 700;
            color: #4CAF50;
        }

        .history-stat-label {
            font-size: 0.8rem;
            color: #999;
        }

        .history-date {
            font-size: 0.85rem;
            color: #999;
        }

        .empty-state {
            text-align: center;
            padding: 80px 20px;
        }

        .empty-icon {
            font-size: 5rem;
            margin-bottom: 20px;
            opacity: 0.5;
        }

        .empty-text {
            font-size: 1.3rem;
            color: #999;
            margin-bottom: 10px;
        }

        .empty-subtext {
            font-size: 1rem;
            color: #bbb;
        }

        @media (max-width: 768px) {
            .progress-container {
                padding: 30px 20px 60px;
                margin-top: 80px;
            }

            .page-title {
                font-size: 2rem;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .history-item {
                flex-direction: column;
                text-align: center;
                gap: 20px;
            }

            .history-item-left {
                flex-direction: column;
            }

            .history-item-right {
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <!-- NAVBAR -->
    <nav class="navbar">
        <div class="logo">
            <div class="logo-img"></div>
            <a class="logo-text" onclick="goToHome()">BodyBud</a>
        </div>

        <ul class="nav-menu">
           <li><a href="{{ route('dashboard') }}" class="active">Home</a></li>
            <li><a href="{{ route('myworkout') }}" >My Workout</a></li>
            <li><a href="{{ route('progress') }}">Progress</a></li>
            <li><a href="{{ route('profile') }}">Profile</a></li>
        </ul>

        <div class="nav-icons">
            <div class="user-info">
                <div class="user-avatar">👤</div>
                <span class="user-name">Diandra</span>
            </div>
        </div>
    </nav>

    <!-- PROGRESS CONTENT -->
    <div class="progress-container">
        <h1 class="page-title">📊 Progress Workout</h1>

        <!-- Stats Cards -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon">🏋️</div>
                <div class="stat-value" id="totalWorkouts">0</div>
                <div class="stat-label">Total Workout</div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">🔥</div>
                <div class="stat-value" id="totalCalories">0</div>
                <div class="stat-label">Total Kalori</div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">⏱️</div>
                <div class="stat-value" id="totalDuration">0</div>
                <div class="stat-label">Total Menit</div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">📅</div>
                <div class="stat-value" id="streakDays">0</div>
                <div class="stat-label">Hari Berturut-turut</div>
            </div>
        </div>

        <!-- Workout History -->
        <div class="history-section">
            <div class="history-header">
                <h2 class="history-title">Riwayat Latihan</h2>
                <button class="btn-clear-history" onclick="clearHistory()">Hapus Semua</button>
            </div>

            <div class="history-list" id="historyList">
                <!-- History items will be inserted here -->
            </div>
        </div>
    </div>

    <script>
        function goToHome() {
            window.location.href = 'dashboard.html';
        }

        function loadWorkoutHistory() {
            const history = JSON.parse(localStorage.getItem('workoutHistory') || '[]');
            const historyList = document.getElementById('historyList');

            if (history.length === 0) {
                historyList.innerHTML = `
                    <div class="empty-state">
                        <div class="empty-icon">💪</div>
                        <div class="empty-text">Belum ada workout yang diselesaikan</div>
                        <div class="empty-subtext">Mulai workout pertamamu sekarang!</div>
                    </div>
                `;
                return;
            }

            historyList.innerHTML = history.map((workout, index) => {
                const date = new Date(workout.date);
                const formattedDate = date.toLocaleDateString('id-ID', {
                    day: 'numeric',
                    month: 'long',
                    year: 'numeric',
                    hour: '2-digit',
                    minute: '2-digit'
                });

                const categoryIcons = {
                    arm: '💪',
                    leg: '🦵',
                    abs: '🔥'
                };

                return `
                    <div class="history-item" style="animation-delay: ${index * 0.05}s">
                        <div class="history-item-left">
                            <div class="history-icon ${workout.category}">
                                ${categoryIcons[workout.category] || '💪'}
                            </div>
                            <div class="history-details">
                                <h3>${workout.name}</h3>
                                <div class="history-meta">
                                    <span>📦 ${workout.sets} set × ${workout.reps} reps</span>
                                </div>
                            </div>
                        </div>
                        <div class="history-item-right">
                            <div class="history-stats">
                                <div class="history-stat">
                                    <div class="history-stat-value">${workout.calories}</div>
                                    <div class="history-stat-label">Kalori</div>
                                </div>
                                <div class="history-stat">
                                    <div class="history-stat-value">${workout.duration}</div>
                                    <div class="history-stat-label">Menit</div>
                                </div>
                            </div>
                            <div class="history-date">${formattedDate}</div>
                        </div>
                    </div>
                `;
            }).join('');

            updateStats(history);
        }

        function updateStats(history) {
            const totalWorkouts = history.length;
            const totalCalories = history.reduce((sum, w) => sum + w.calories, 0);
            const totalDuration = history.reduce((sum, w) => sum + w.duration, 0);
            const streakDays = calculateStreak(history);

            document.getElementById('totalWorkouts').textContent = totalWorkouts;
            document.getElementById('totalCalories').textContent = totalCalories;
            document.getElementById('totalDuration').textContent = totalDuration;
            document.getElementById('streakDays').textContent = streakDays;
        }

        function calculateStreak(history) {
            if (history.length === 0) return 0;

            const dates = history.map(w => {
                const date = new Date(w.date);
                return new Date(date.getFullYear(), date.getMonth(), date.getDate()).getTime();
            });

            const uniqueDates = [...new Set(dates)].sort((a, b) => b - a);
            
            let streak = 1;
            const today = new Date();
            const todayTime = new Date(today.getFullYear(), today.getMonth(), today.getDate()).getTime();

            if (uniqueDates[0] !== todayTime && uniqueDates[0] !== todayTime - 86400000) {
                return 0;
            }

            for (let i = 0; i < uniqueDates.length - 1; i++) {
                const diff = uniqueDates[i] - uniqueDates[i + 1];
                if (diff === 86400000) {
                    streak++;
                } else {
                    break;
                }
            }

            return streak;
        }

        function clearHistory() {
            if (confirm('Yakin ingin menghapus semua riwayat workout? Tindakan ini tidak bisa dibatalkan.')) {
                localStorage.removeItem('workoutHistory');
                loadWorkoutHistory();
            }
        }

        loadWorkoutHistory();
    </script>
</body>
</html>