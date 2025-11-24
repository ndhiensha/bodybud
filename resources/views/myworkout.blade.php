<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>My Workout - BodyBud</title>

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/myworkout.css') }}">

</head>

<body>
    <div class="container">

        <nav class="navbar">
             <div class="logo">
                <img src="/images/logo.png" alt="BodyBud Logo" class="logo-img">
                <a href="#" class="logo-text">BodyBud</a>
            </div>

            <!-- CENTER : MENU -->
            <ul class="nav-menu">
                <li><a href="{{ route('dashboard') }}">Home</a></li>
                <li><a href="{{ route('myworkout') }}" class="active">My Workout</a></li>
                <li><a href="{{ route('progress') }}">Progress</a></li>
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
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" width="22">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 16l4-4-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                </button>

            </div>
        </nav>

       <!-- HEADER (WITH FRAME) -->
        <div class="header">
            <div class="header-container">

                <div class="header-left">
                    <h1>
                        <svg width="55" height="55" fill="none" stroke="#3E4D37" stroke-width="3" viewBox="0 0 24 24">
                            <path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        Plan Your Workout
                    </h1>
                    <p>Atur jadwal workout kamu biar lebih terorganisir</p>
                </div>

                <button class="btn-add" onclick="openModal()">
                    <svg width="20" height="20" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M12 4v16m8-8H4"/>
                    </svg>
                    Buat Workout Baru
                </button>

            </div>
        </div>


        <!-- GRID -->
        <div class="content-wrapper">
            <div id="workoutGrid" class="workout-grid"></div>

                <!-- EMPTY STATE -->
                <div id="emptyState" class="empty-state" style="display:none;">
                    <svg class="icon-lg" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                    </svg>
                    <h3>Belum ada workout yang dijadwalkan</h3>
                    <p>Klik "Buat Workout Baru" untuk mulai planning!</p>
                </div>
            </div>


        <!-- MODAL OVERLAY -->
    <div id="workoutModal" class="modal">

        <!-- MODAL BOX -->
        <div class="modal-content">

            <div class="modal-header">
                <h2 class="modal-title" id="modalTitle">Buat Workout Baru</h2>
                <button class="btn-close" onclick="closeModal()">×</button>
            </div>

            <div class="form-group">
                <label for="workoutDate">Tanggal</label>
                <input type="date" id="workoutDate">
            </div>

            <div class="form-group">
                <label for="workoutType">Jenis Workout</label>
                <select id="workoutType">
                    <option value="Arm Workout">Arm Workout</option>
                    <option value="Leg Workout">Leg Workout</option>
                    <option value="Abs Workout">Abs Workout</option>
                </select>
            </div>

            <div class="form-group">
                <label for="workoutDuration">Durasi (menit)</label>
                <input type="number" id="workoutDuration">
            </div>

            <div class="form-group">
                <label for="workoutNotes">Catatan (opsional)</label>
                <textarea id="workoutNotes"></textarea>
            </div>

            <div class="modal-actions">
                <button class="btn-cancel" onclick="closeModal()">Batal</button>
                <button class="btn-submit" onclick="saveWorkout()">Simpan</button>
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

    <!-- SCRIPT -->
    <script src="{{ asset('js/myworkout.js') }}"></script>
    
    <script src="{{ asset('js/footer.js') }}"></script>

</body>
</html>
