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
            <li><a href="#">Progress</a></li>
            <li><a href="#">Profile</a></li>
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

    <script src="{{ asset('js/dashboard.js') }}"></script>
    
    
</body>
</html>
