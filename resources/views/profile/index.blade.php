@extends('layouts.app')

@section('title', 'Profile')

@section('content')
<style>
    .profile-container {
        max-width: 600px;
        margin: 120px auto 60px;
        padding: 0 20px;
    }

    .profile-card {
        background: #FFFFFF;
        border-radius: 20px;
        padding: 50px 40px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        text-align: center;
        margin-bottom: 30px;
    }

    .profile-picture-wrapper {
        position: relative;
        width: 120px;
        height: 120px;
        margin: 0 auto 25px;
    }

    .profile-picture {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        background: linear-gradient(135deg, #D4D96F 0%, #C9CF5E 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        border: 4px solid #FFF8F0;
        box-shadow: 0 4px 15px rgba(212, 217, 111, 0.3);
    }

    .profile-picture img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .profile-picture svg {
        width: 60px;
        height: 60px;
        fill: #FFFFFF;
    }

    .profile-name {
        font-size: 28px;
        font-weight: 700;
        color: #2A2A2A;
        margin-bottom: 8px;
    }

    .profile-email {
        font-size: 15px;
        color: #8A8A8A;
        margin-bottom: 35px;
    }

    .profile-info {
        display: grid;
        grid-template-columns: 1fr auto 1fr;
        gap: 30px 40px;
        text-align: left;
        margin-bottom: 35px;
        padding: 0 20px;
    }

    .profile-info-item {
        display: flex;
        flex-direction: column;
    }

    .profile-info-label {
        font-size: 13px;
        font-weight: 600;
        color: #5A5A5A;
        margin-bottom: 5px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .profile-info-value {
        font-size: 15px;
        color: #2A2A2A;
        font-weight: 500;
    }

    .profile-divider {
        width: 1px;
        background: #E0E0E0;
        grid-row: span 2;
    }

    .btn-edit-profile {
        padding: 14px 60px;
        background: linear-gradient(90deg, #E8ED9F 0%, #D4D96F 100%);
        border: none;
        border-radius: 30px;
        font-size: 16px;
        font-weight: 600;
        color: #4A5D3F;
        cursor: pointer;
        transition: all 0.3s;
        box-shadow: 0 4px 15px rgba(212, 217, 111, 0.3);
        text-decoration: none;
        display: inline-block;
    }

    .btn-edit-profile:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(212, 217, 111, 0.5);
    }

    .achievement-card {
        background: #FFFFFF;
        border-radius: 20px;
        padding: 35px 40px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    }

    .achievement-title {
        font-size: 22px;
        font-weight: 700;
        color: #2A2A2A;
        text-align: center;
        margin-bottom: 30px;
    }

    .achievement-list {
        display: flex;
        justify-content: center;
        gap: 40px;
        flex-wrap: wrap;
    }

    .achievement-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 10px;
    }

    .achievement-badge {
        width: 90px;
        height: 90px;
        position: relative;
    }

    .achievement-badge svg {
        width: 100%;
        height: 100%;
        filter: drop-shadow(0 4px 10px rgba(0, 0, 0, 0.1));
    }

    .alert-success {
        background: linear-gradient(135deg, #D4D96F 0%, #C9CF5E 100%);
        color: #3A4A2F;
        padding: 15px 25px;
        border-radius: 12px;
        margin-bottom: 25px;
        font-weight: 600;
        box-shadow: 0 4px 15px rgba(212, 217, 111, 0.3);
    }

    @media (max-width: 768px) {
        .profile-info {
            grid-template-columns: 1fr;
            gap: 20px;
        }
        
        .profile-divider {
            display: none;
        }
    }
</style>

<div class="profile-container">
    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="profile-card">
        <div class="profile-picture-wrapper">
            <div class="profile-picture">
                @if($user->profile_picture)
                    <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Profile Picture">
                @else
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="12" cy="8" r="4" fill="white"/>
                        <path d="M20 21C20 16.5817 16.4183 13 12 13C7.58172 13 4 16.5817 4 21" stroke="white" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                @endif
            </div>
        </div>

        <h1 class="profile-name">{{ $user->name }}</h1>
        <p class="profile-email">{{ $user->email }}</p>

        <div class="profile-info">
            <div class="profile-info-item">
                <span class="profile-info-label">Gender</span>
                <span class="profile-info-value">{{ $user->gender ?? '—' }}</span>
            </div>

            <div class="profile-divider"></div>

            <div class="profile-info-item">
                <span class="profile-info-label">Date of Birth</span>
                <span class="profile-info-value">
                    {{ $user->date_of_birth ? date('d M, Y', strtotime($user->date_of_birth)) : '—' }}
                </span>
            </div>

            <div class="profile-info-item">
                <span class="profile-info-label">Weight</span>
                <span class="profile-info-value">{{ $user->weight ? $user->weight . ' KG' : '— KG' }}</span>
            </div>

            <div class="profile-divider"></div>

            <div class="profile-info-item">
                <span class="profile-info-label">Phone Number</span>
                <span class="profile-info-value">{{ $user->phone_number ?? '—' }}</span>
            </div>

            <div class="profile-info-item">
                <span class="profile-info-label">Height</span>
                <span class="profile-info-value">{{ $user->height ? $user->height . ' CM' : '— CM' }}</span>
            </div>

            <div class="profile-divider"></div>

            <div class="profile-info-item">
                <span class="profile-info-label">Address</span>
                <span class="profile-info-value">{{ $user->address ?? '—' }}</span>
            </div>
        </div>

        <a href="{{ route('profile.edit') }}" class="btn-edit-profile">Edit Profile</a>
    </div>

    <div class="achievement-card">
        <h2 class="achievement-title">Achievement</h2>
        <div class="achievement-list">
            <div class="achievement-item">
                <div class="achievement-badge">
                    <svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                        <polygon points="50,15 61,38 85,41 67,58 72,82 50,70 28,82 33,58 15,41 39,38" fill="#FFD700" stroke="#FFA500" stroke-width="2"/>
                        <circle cx="50" cy="50" r="12" fill="#FFA500"/>
                    </svg>
                </div>
            </div>
            
            <div class="achievement-item">
                <div class="achievement-badge">
                    <svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                        <polygon points="50,15 61,38 85,41 67,58 72,82 50,70 28,82 33,58 15,41 39,38" fill="#FFB6C1" stroke="#FF69B4" stroke-width="2"/>
                        <circle cx="50" cy="50" r="12" fill="#FF69B4"/>
                    </svg>
                </div>
            </div>
            
            <div class="achievement-item">
                <div class="achievement-badge">
                    <svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                        <polygon points="50,15 61,38 85,41 67,58 72,82 50,70 28,82 33,58 15,41 39,38" fill="#87CEEB" stroke="#4682B4" stroke-width="2"/>
                        <circle cx="50" cy="50" r="12" fill="#4682B4"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection