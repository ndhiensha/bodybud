<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - RunRun</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
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

        /* Navigation Bar - STICKY */
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
            align-items: center;
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

        .user-menu {
            position: relative;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #D4D96F 0%, #C9CF5E 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            border: 2px solid #4A5D3F;
            overflow: hidden;
        }

        .user-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .user-avatar svg {
            width: 22px;
            height: 22px;
            fill: #4A5D3F;
        }

        .dropdown-menu {
            position: absolute;
            top: 55px;
            right: 0;
            background: #FFFFFF;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
            min-width: 180px;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.3s;
        }

        .dropdown-menu.active {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .dropdown-menu a,
        .dropdown-menu button {
            display: block;
            padding: 12px 20px;
            color: #5A5A5A;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.2s;
            border: none;
            background: none;
            width: 100%;
            text-align: left;
            cursor: pointer;
        }

        .dropdown-menu a:hover,
        .dropdown-menu button:hover {
            background: #F8F8F8;
            color: #4A5D3F;
        }

        .dropdown-menu a:first-child {
            border-radius: 12px 12px 0 0;
        }

        .dropdown-menu button:last-child {
            border-radius: 0 0 12px 12px;
            border-top: 1px solid #F0F0F0;
            color: #DC3545;
        }

        .dropdown-menu button:last-child:hover {
            background: #FFF5F5;
        }

        @media (max-width: 768px) {
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
    <div class="container">
        <!-- Navigation Bar -->
        <nav class="navbar" id="navbar">
            <div class="logo">
                <img src="{{ asset('images/logo.png') }}" alt="RunRun Logo" class="logo-img">
                <a href="{{ route('home') }}" class="logo-text">RunRun</a>
            </div>
            
            <ul class="nav-menu">
                <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a></li>
                <li><a href="{{ route('workout') }}" class="{{ request()->routeIs('workout') ? 'active' : '' }}">My Workout</a></li>
                <li><a href="{{ route('progress') }}" class="{{ request()->routeIs('progress') ? 'active' : '' }}">Progress</a></li>
                <li><a href="{{ route('profile.index') }}" class="{{ request()->routeIs('profile.*') ? 'active' : '' }}">Profile</a></li>
            </ul>
            
            <div class="auth-buttons">
                @auth
                    <div class="user-menu">
                        <div class="user-avatar" onclick="toggleDropdown()">
                            @if(Auth::user()->profile_picture)
                                <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" alt="Profile">
                            @else
                                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="12" cy="8" r="4"/>
                                    <path d="M20 21C20 16.5817 16.4183 13 12 13C7.58172 13 4 16.5817 4 21" stroke-width="2"/>
                                </svg>
                            @endif
                        </div>
                        <div class="dropdown-menu" id="dropdownMenu">
                            <a href="{{ route('profile.index') }}">My Profile</a>
                            <a href="{{ route('profile.settings') }}">Settings</a>
                            <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                                @csrf
                                <button type="submit">Logout</button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="btn-login">Login</a>
                    <a href="{{ route('register') }}" class="btn-signup">Sign Up</a>
                @endauth
            </div>
        </nav>

        <!-- Main Content -->
        @yield('content')
    </div>

    <script>
        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Dropdown menu toggle
        function toggleDropdown() {
            const dropdown = document.getElementById('dropdownMenu');
            dropdown.classList.toggle('active');
        }

        // Close dropdown when clicking outside
        window.addEventListener('click', function(e) {
            if (!e.target.closest('.user-menu')) {
                const dropdown = document.getElementById('dropdownMenu');
                dropdown.classList.remove('active');
            }
        });
    </script>
</body>
</html>