@extends('layouts.app')

@section('title', 'My Progress')

@section('content')
{{-- Memastikan Anda memiliki file CSS yang baru saja saya perbaiki --}}
<link rel="stylesheet" href="{{ asset('css/progress.css') }}">

<div class="container">
    <nav class="navbar" id="navbar">
        <div class="logo">
            <img src="/images/logo.png" alt="BodyBud Logo" class="logo-img">
            <a href="#" class="logo-text">BodyBud</a>
        </div>
        <ul class="nav-menu">
            <li><a href="{{ route('dashboard') }}">Home</a></li>
            <li><a href="{{ route('myworkout') }}">My Workout</a></li>
            <li><a href="{{ route('progress') }}" class="active" >Progress</a></li>
            <li><a href="{{ route('profile') }}">Profile</a></li> 
            
        </ul>
          <!-- RIGHT : ICONS & USER -->
        <div class="nav-icons">

            <!-- NOTIFICATION -->
            <a class="icon-btn" id="notifBtn">
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
                {{-- Icon Log Out Lucide --}}
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-log-out"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><path d="m16 17 5-5-5-5"/><path d="M21 12H9"/></svg>
            </button>

        </div>
    </nav>

    <h1 class="page-title">My Progress</h1>

    <!-- Summary Cards -->
    <div class="summary-grid">
        {{-- Card 1: Total Calories (Fire Icon) --}}
        <div class="summary-card">
            <div class="card-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-flame"><path d="M8.5 14.5A2.5 2.5 0 0 0 11 12c0-1.38-.85-2.5-2-2.5S7 8.12 7 9.5c0 .75.25 1.5.75 2.5h-1.5c.25-.5.75-1.5 1.75-2.5C9.5 8.12 10.35 7 11.5 7s2.5 1.12 2.5 2.5c0 1.38.85 2.5 2 2.5s2-1.12 2-2.5c0-.75-.25-1.5-.75-2.5h1.5c-.25.5-.75 1.5-1.75 2.5C14.5 12.88 13.65 14 12.5 14s-2.5-1.12-2.5-2.5c0-1.38-.85-2.5-2-2.5s-2 1.12-2 2.5c0 .75.25 1.5.75 2.5H6c-.25-.5-.75-1.5-1.75-2.5C4.5 8.12 3.65 7 2.5 7S0 8.12 0 9.5c0 1.38.85 2.5 2 2.5s2-1.12 2-2.5c0-.75-.25-1.5-.75-2.5h1.5c-.25.5-.75 1.5-1.75 2.5C9.5 12.88 10.35 14 11.5 14s2.5-1.12 2.5-2.5c0-1.38-.85-2.5-2-2.5S11 8.12 11 9.5c0 .75.25 1.5.75 2.5h-1.5c.25-.5.75-1.5 1.75-2.5C14.5 12.88 13.65 14 12.5 14s-2.5-1.12-2.5-2.5c0-1.38-.85-2.5-2-2.5s-2 1.12-2 2.5c0 .75.25 1.5.75 2.5H6z"/></svg>
            </div>
            <div class="card-content">
                <h3>Total Calories</h3>
                <p class="big-number" id="totalCalories">0</p>
                <span class="label">kcal burned</span>
            </div>
        </div>

        {{-- Card 2: Workouts Done (Dumbbell Icon) --}}
        <div class="summary-card">
            <div class="card-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-dumbbell"><path d="M14.4 14.4 9.6 9.6"/><path d="M18 6l-6 6"/><path d="M6 18l6-6"/><path d="M21 3l-3 3"/><path d="M3 21l3-3"/><path d="M17.5 17.5a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z"/><path d="M6.5 6.5a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z"/></svg>
            </div>
            <div class="card-content">
                <h3>Workouts Done</h3>
                <p class="big-number" id="totalWorkouts">0</p>
                <span class="label">sessions</span>
            </div>
        </div>

        {{-- Card 3: Total Time (Clock Icon) --}}
        <div class="summary-card">
            <div class="card-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-clock"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
            </div>
            <div class="card-content">
                <h3>Total Time</h3>
                <p class="big-number" id="totalTime">0</p>
                <span class="label">minutes</span>
            </div>
        </div>

        {{-- Card 4: Streak (Trophy Icon) --}}
        <div class="summary-card">
            <div class="card-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trophy"><path d="M6 9H4a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h2"/><path d="M18 9h2a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2h-2"/><path d="M12 15a4 4 0 0 0-4 4v2h8v-2a4 4 0 0 0-4-4z"/><path d="M8 11V7a4 4 0 0 1 8 0v4"/><path d="M10 11h4"/></svg>
            </div>
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
                    <span class="category-name">🎯 back Workout</span>
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
        <div class="activity-list" id="activityList">
            {{-- Example Activity Item (Akan diisi oleh JS, tapi baik untuk menampilkan satu sebagai placeholder) --}}
            <div class="activity-item">
                <div class="activity-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-run"><path d="M20.375 14.5a.375.375 0 0 1-.375.375c-.3 0-.543-.242-.543-.543V7.276a2.1 2.1 0 0 0-1.874-2.07l-3.23-.42c-1.39-.183-2.73 1.05-2.73 2.44v1.365a1.86 1.86 0 0 0 .584 1.487l4.08 3.52c.677.583 1.05 1.44 1.05 2.327V21a1.135 1.135 0 0 1-1.135 1.135H7.935a1.135 1.135 0 0 1-1.135-1.135v-1.637l2.45-.636"/><path d="M15 21v-3.79c0-.42-.164-.82-.46-1.12l-2.06-2.06a1.1 1.1 0 0 1-.32-1.28c.37-.87.9-1.55 1.34-2.12"/><path d="M17.5 7.5a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z"/></svg>
                </div>
                <div class="activity-info">
                    <h4>Leg Day Workout</h4>
                    <p class="activity-meta">25 Nov 2024 - 45 min - 320 kcal</p>
                </div>
            </div>
            {{-- End Example --}}
        </div>
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
    <!-- LOGOUT MODAL -->
    <div id="logoutModal" class="logout-modal">
        <div class="logout-content">
            <h2>Yakin Mau Keluar?</h2>
            <p>Kamu akan logout dari BodyBud.</p>

            <div class="logout-actions">
                <button class="btn-cancel-logout" id="btnCancelLogout">Batal</button>

                <!-- Laravel logout route -->
                <form id="logoutForm" method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="btn-confirm-logout" type="submit">Ya, Keluar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<footer class="footer">
    <div class="footer-container">

        <div class="footer-left">
            <h2>BODYBUD</h2>
            <p>Your personal fitness buddy to track workouts, stay motivated, and grow stronger every day.</p>
        </div>

        <div class="footer-links">
            <h3>Menu</h3>
            <a href="{{ route('dashboard') }}">Home</a>
            <a href="{{ route('myworkout') }}">My Workouts</a>
            <a href="{{ route('progress') }}">Progress</a>
            <a href="{{ route('profile') }}">Profile</a>
        </div>

        <div class="footer-links">
            <h3>Support</h3>
            <a href="#">FAQ</a>
            <a href="#">Contact</a>
            <a href="#">Feedback</a>
        </div>

        <div class="footer-social">
            <h3>Follow Us</h3>
            <div class="social-icons">
                {{-- Menggunakan path SVG asli, tidak diubah --}}
                <a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="#4A5D3F" viewBox="0 0 24 24"><path d="M22.23 0H1.77A1.77 1.77 0 000 1.77v20.46A1.77 1.77 0 001.77 24h11V14.7h-3V11h3V8.41c0-3 1.8-4.66 4.53-4.66 1.31 0 2.68.23 2.68.23v3h-1.51c-1.49 0-1.95.92-1.95 1.86V11h3.32l-.53 3.7H17.5V24h4.73A1.77 1.77 0 0024 22.23V1.77A1.77 1.77 0 0022.23 0z"/></svg></a>
                <a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="#4A5D3F" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775A4.958 4.958 0 0023.337 3a9.864 9.864 0 01-3.127 1.2A4.92 4.92 0 0016.616 3c-2.72 0-4.924 2.208-4.924 4.917 0 .39.045.765.127 1.124C7.728 8.89 4.1 6.89 1.67 3.9a4.822 4.822 0 00-.666 2.475c0 1.708.875 3.214 2.207 4.096a4.903 4.903 0 01-2.225-.616v.06c0 2.385 1.723 4.374 4.067 4.827a4.996 4.996 0 01-2.212.084c.623 1.934 2.445 3.342 4.6 3.383A9.868 9.868 0 010 19.54 13.94 13.94 0 007.548 22c9.142 0 14.307-7.72 13.995-14.646A9.936 9.936 0 0024 4.59z"/></svg></a>
                <a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="#4A5D3F" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 1.17.054 1.97.24 2.43.403a4.92 4.92 0 011.73 1.122 4.92 4.92 0 011.122 1.73c.163.46.349 1.26.403 2.43.058 1.266.07 1.646.07 4.85s-.012 3.584-.07 4.85c-.054 1.17-.24 1.97-.403 2.43a4.92 4.92 0 01-1.122 1.73 4.92 4.92 0 01-1.73 1.122c-.46.163-1.26.349-2.43.403-1.266.058-1.646.07-4.85.07s-3.584-.012-4.85-.07c-1.17-.054-1.97-.24-2.43-.403a4.92 4.92 0 01-1.73-1.122 4.92 4.92 0 01-1.122-1.73c-.163-.46-.349-1.26-.403-2.43C2.175 15.747 2.163 15.367 2.163 12s.012-3.584.07-4.85c.054-1.17.24-1.97.403-2.43a4.92 4.92 0 011.122-1.73A4.92 4.92 0 015.488 1.76c.46-.163 1.26-.349 2.43-.403C9.184 1.299 9.564 1.287 12 1.287m0-1.287C8.735 0 8.332.013 7.053.072 5.775.131 4.89.322 4.18.588a6.18 6.18 0 00-2.24 1.462A6.18 6.18 0 00.477 4.29c-.266.71-.457 1.595-.516 2.873C-.013 8.442 0 8.845 0 12c0 3.155-.013 3.558.072 4.837.059 1.278.25 2.163.516 2.873.33.88.82 1.64 1.462 2.24a6.18 6.18 0 002.24 1.462c.71.266 1.595.457 2.873.516C8.332 24.013 8.735 24 12 24s3.668.013 4.947-.072c1.278-.059 2.163-.25 2.873-.516a6.18 6.18 0 002.24-1.462 6.18 6.18 0 001.462-2.24c.266-.71.457-1.595.516-2.873.059-1.279.072-1.682.072-4.837 0-3.155-.013-3.558-.072-4.837-.059-1.278-.25-2.163-.516-2.873a6.18 6.18 0 00-1.462-2.24A6.18 6.18 0 0019.82.588c-.71-.266-1.595-.457-2.873-.516C15.668.013 15.265 0 12 0z"/></svg></a>
            </div>
        </div>

    </div>

    <div class="footer-bottom">
        <p>© 2025 BODYBUD — All Rights Reserved.</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="{{ asset('js/progress.js') }}"></script>
<script>
    // Ini adalah cara yang benar untuk meneruskan data JSON ke JavaScript
    window.progressData = @json($progress ?? []); // Default ke array kosong jika $progress belum ada

    // Penambahan script untuk efek navbar
    document.addEventListener('DOMContentLoaded', function () {
        const navbar = document.getElementById('navbar');
        const scrollThreshold = 50;

        function checkScroll() {
            if (window.scrollY > scrollThreshold) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        }

        window.addEventListener('scroll', checkScroll);
        checkScroll(); // Cek saat halaman dimuat
    });
</script>

@endsection