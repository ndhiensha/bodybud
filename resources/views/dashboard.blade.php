<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - BodyBud</title>

    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
   
</head>

<body>

    <!-- NAVBAR -->
    <nav class="navbar">

        <div class="logo">
            <img src="/images/logo.png" class="logo-img">
            <a class="logo-text">BodyBud</a>
        </div>

        <ul class="nav-menu">
            <li><a class="active" href= "{{ route('dashboard') }}">Home</a></li>
            <li><a href="{{ route('myworkout') }}">My Workout</a></li>
            <li><a href="{{ route('progress') }}">Progress</a>

            <li><a href="{{ route('profile') }}">Profile</a></li>
        </ul>

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

            <!-- USER -->
            <div class="user-info">
                <div class="user-avatar">👤</div>
                <span class="user-name">{{ Auth::user()->name }}</span>
            </div>

            <!-- LOGOUT BUTTON (FIXED) -->
            <button class="icon-btn" id="btnLogout">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" width="22">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 16l4-4-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                </svg>
            </button>

        </div>

        <!-- NOTIFICATION PANEL -->
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

    </nav>

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

    <footer class="footer">
        <div class="footer-container">

            <div class="footer-left">
                <h2>BODYBUD</h2>
                <p>Your personal fitness buddy to track workouts, stay motivated, and grow stronger every day.</p>
            </div>

            <div class="footer-links">
                <h3>Menu</h3>
                <a href="/">Home</a>
                <a href="/dashboard">Dashboard</a>
                <a href="#">Workouts</a>
                <a href="#">Progress</a>
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

    <script src="{{ asset('js/dashboard.js') }}"></script>
    
    
</body>
</html>
