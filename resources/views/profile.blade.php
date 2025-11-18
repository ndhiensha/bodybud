<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Profile - BeeFit</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        /* Profile Page Specific Styles */
        .profile-container {
            padding-top: 100px;
            padding-bottom: 60px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            background-color: #FFF8F0;
        }

        .profile-card {
            background-color: #FFFFFF;
            border-radius: 20px;
            padding: 50px 60px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            max-width: 600px;
            width: 100%;
            margin-bottom: 30px;
            position: relative;
        }

        .profile-avatar {
            position: absolute;
            top: -50px;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background-color: #A8AAA4;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
            cursor: pointer;
            position: relative;
        }

        .profile-avatar svg {
            width: 50px;
            height: 50px;
            fill: #FFFFFF;
        }

        .avatar-edit {
            position: absolute;
            bottom: 0;
            right: 0;
            background-color: #5A6B4F;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            border: 3px solid #FFFFFF;
        }

        .avatar-edit svg {
            width: 15px;
            height: 15px;
            fill: #FFFFFF;
        }

        .profile-name {
            text-align: center;
            margin-top: 60px;
            margin-bottom: 10px;
        }

        .profile-name h2 {
            font-size: 26px;
            font-weight: 700;
            color: #333333;
            margin-bottom: 5px;
        }

        .profile-email {
            text-align: center;
            color: #999999;
            font-size: 14px;
            margin-bottom: 35px;
        }

        .profile-form {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 25px 40px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group label {
            font-size: 14px;
            font-weight: 600;
            color: #555555;
            margin-bottom: 8px;
        }

        .form-group input,
        .form-group select {
            padding: 10px 15px;
            border: none;
            border-bottom: 2px solid #E0E0E0;
            background-color: transparent;
            font-size: 14px;
            color: #333333;
            transition: all 0.3s;
            outline: none;
        }

        .form-group input:focus,
        .form-group select:focus {
            border-bottom-color: #D4D96F;
        }

        .form-group input::placeholder {
            color: #CCCCCC;
        }

        .form-divider {
            grid-column: 1 / -1;
            height: 1px;
            background-color: #E8E8E8;
            margin: 10px 0;
        }

        .btn-save,
        .btn-edit {
            grid-column: 1 / -1;
            padding: 14px 0;
            background: linear-gradient(90deg, #E8ED9F 0%, #D4D96F 100%);
            border: none;
            border-radius: 25px;
            font-size: 16px;
            font-weight: 600;
            color: #4A5D3F;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 15px;
        }

        .btn-save:hover,
        .btn-edit:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(212, 217, 111, 0.4);
        }

        .achievement-card {
            background-color: #FFFFFF;
            border-radius: 20px;
            padding: 40px 60px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            max-width: 600px;
            width: 100%;
        }

        .achievement-card h3 {
            text-align: center;
            font-size: 22px;
            font-weight: 700;
            color: #333333;
            margin-bottom: 30px;
        }

        .achievement-badges {
            display: flex;
            justify-content: space-around;
            align-items: center;
            gap: 30px;
        }

        .badge {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 45px;
            position: relative;
        }

        .badge-gold {
            background: linear-gradient(135deg, #FFD700 0%, #FFA500 100%);
            box-shadow: 0 4px 15px rgba(255, 215, 0, 0.4);
        }

        .badge-pink {
            background: linear-gradient(135deg, #FFB6C1 0%, #FFA0B4 100%);
            box-shadow: 0 4px 15px rgba(255, 182, 193, 0.4);
        }

        .badge-teal {
            background: linear-gradient(135deg, #87CEEB 0%, #5FA8D3 100%);
            box-shadow: 0 4px 15px rgba(135, 206, 235, 0.4);
        }

        .form-readonly input,
        .form-readonly select {
            background-color: #F9F9F9;
            color: #999999;
            cursor: not-allowed;
        }

        .alert {
            padding: 12px 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-size: 14px;
            text-align: center;
        }

        .alert-success {
            background-color: #D4EDDA;
            color: #155724;
            border: 1px solid #C3E6CB;
        }

        .alert-error {
            background-color: #F8D7DA;
            color: #721C24;
            border: 1px solid #F5C6CB;
        }

        @media (max-width: 768px) {
            .profile-card,
            .achievement-card {
                padding: 40px 30px;
                margin: 0 20px 30px;
            }

            .profile-form {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .achievement-badges {
                flex-wrap: wrap;
                gap: 20px;
            }

            .badge {
                width: 80px;
                height: 80px;
                font-size: 35px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Navigation Bar -->
        <nav class="navbar" id="navbar">
            <div class="logo">
                <img src="{{ asset('images/logo.png') }}" alt="BeeFit Logo" class="logo-img">
                <a href="{{ url('/') }}" class="logo-text">BeeFit</a>
            </div>
            <ul class="nav-menu">
                <li><a href="{{ url('/') }}">Home</a></li>
                <li><a href="{{ url('/workout') }}">My Workout</a></li>
                <li><a href="{{ url('/progress') }}">Progress</a></li>
                <li><a href="{{ url('/profile') }}" class="active">Profile</a></li>
            </ul>
            <div class="auth-buttons">
                <button class="btn-login">🔔</button>
                <a href="{{ url('/logout') }}" class="btn-signup">Logout</a>
            </div>
        </nav>

        <!-- Profile Section -->
        <div class="profile-container">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if($errors->any())
                <div class="alert alert-error">
                    @foreach($errors->all() as $error)
                        {{ $error }}<br>
                    @endforeach
                </div>
            @endif

            <!-- Profile Card -->
            <div class="profile-card">
                <div class="profile-avatar">
                    <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                    </svg>
                    <div class="avatar-edit">
                        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/>
                        </svg>
                    </div>
                </div>

                <div class="profile-name">
                    <h2>{{ $user->name ?? 'Najmah Khairunnisa' }}</h2>
                </div>
                <div class="profile-email">{{ $user->email ?? 'najmahkhairunnisa@gmail.com' }}</div>

                <form action="{{ route('profile.update') }}" method="POST" id="profileForm">
                    @csrf
                    @method('PUT')
                    <div class="profile-form" id="profileFormFields">
                        <div class="form-group form-readonly">
                            <label for="gender">Gender</label>
                            <select name="gender" id="gender" disabled>
                                <option value="Male" {{ (old('gender', $user->gender ?? '') == 'Male') ? 'selected' : '' }}>Male</option>
                                <option value="Female" {{ (old('gender', $user->gender ?? 'Female') == 'Female') ? 'selected' : '' }}>Female</option>
                            </select>
                        </div>

                        <div class="form-group form-readonly">
                            <label for="dob">Date of Birth</label>
                            <input type="date" name="dob" id="dob" value="{{ old('dob', $user->dob ?? '2005-05-18') }}" disabled>
                        </div>

                        <div class="form-group form-readonly">
                            <label for="weight">Weight</label>
                            <input type="text" name="weight" id="weight" placeholder="— KG" value="{{ old('weight', $user->weight ?? '') }}" disabled>
                        </div>

                        <div class="form-group form-readonly">
                            <label for="phone">Phone Number</label>
                            <input type="tel" name="phone" id="phone" placeholder="0812-3456-7414" value="{{ old('phone', $user->phone ?? '0812-3456-7414') }}" disabled>
                        </div>

                        <div class="form-group form-readonly">
                            <label for="height">Height</label>
                            <input type="text" name="height" id="height" placeholder="— CM" value="{{ old('height', $user->height ?? '') }}" disabled>
                        </div>

                        <div class="form-group form-readonly">
                            <label for="address">Address</label>
                            <input type="text" name="address" id="address" placeholder="Bukit Cemara Tidar 13/No. 18" value="{{ old('address', $user->address ?? 'Bukit Cemara Tidar 13/No. 18') }}" disabled>
                        </div>

                        <div class="form-divider"></div>

                        <button type="button" class="btn-edit" id="btnEdit" onclick="toggleEdit()">Edit Profile</button>
                        <button type="submit" class="btn-save" id="btnSave" style="display:none;">Save Changes</button>
                    </div>
                </form>
            </div>

            <!-- Achievement Card -->
            <div class="achievement-card">
                <h3>Achievement</h3>
                <div class="achievement-badges">
                    <div class="badge badge-gold">🏅</div>
                    <div class="badge badge-pink">🌸</div>
                    <div class="badge badge-teal">⭐</div>
                </div>
            </div>
        </div>
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

        // Toggle edit mode
        function toggleEdit() {
            const formFields = document.querySelectorAll('#profileFormFields input, #profileFormFields select');
            const btnEdit = document.getElementById('btnEdit');
            const btnSave = document.getElementById('btnSave');
            const formGroups = document.querySelectorAll('.form-group');

            formFields.forEach(field => {
                field.disabled = false;
            });

            formGroups.forEach(group => {
                group.classList.remove('form-readonly');
            });

            btnEdit.style.display = 'none';
            btnSave.style.display = 'block';
        }
    </script>
</body>
</html>