@extends('layouts.master')

@section('title', 'Profile')

@section('content')
<div class="profile-container">
    <!-- Profile Card -->
    <div class="profile-card">
        <div class="profile-avatar">
            @if($user->profile_picture)
                <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Profile Picture">
            @else
                <svg width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                    <circle cx="12" cy="7" r="4"></circle>
                </svg>
            @endif
        </div>

        <h2 class="profile-name">{{ $user->name }}</h2>
        <p class="profile-email">{{ $user->email }}</p>

        <div class="profile-info">
            <div class="info-column">
                <div class="info-item">
                    <label>Gender</label>
                    <p>{{ ucfirst($user->gender ?? '--') }}</p>
                </div>
                <div class="info-item">
                    <label>Weight</label>
                    <p>{{ $user->weight ? $user->weight . ' KG' : '-- KG' }}</p>
                </div>
                <div class="info-item">
                    <label>Height</label>
                    <p>{{ $user->height ? $user->height . ' CM' : '-- CM' }}</p>
                </div>
            </div>

            <div class="info-divider"></div>

            <div class="info-column">
                <div class="info-item">
                    <label>Date of Birth</label>
                    <p>{{ $user->date_of_birth ? date('d F, Y', strtotime($user->date_of_birth)) : '-- --, ----' }}</p>
                </div>
                <div class="info-item">
                    <label>Phone Number</label>
                    <p>{{ $user->phone_number ?? '----' }}</p>
                </div>
                <div class="info-item">
                    <label>Address</label>
                    <p>{{ $user->address ?? 'No address provided' }}</p>
                </div>
            </div>
        </div>

        <a href="{{ route('profile.edit') }}" class="btn-primary">Edit Profile</a>
    </div>

    <!-- Achievement Section -->
    <div class="achievement-card">
        <h3 class="achievement-title">Achievement</h3>
        <div class="achievement-badges">
            <div class="badge badge-gold">
                <svg width="100" height="100" viewBox="0 0 100 100">
                    <circle cx="50" cy="50" r="40" fill="#F4A460"/>
                    <circle cx="50" cy="50" r="35" fill="#DAA520"/>
                    <path d="M50 20 L55 35 L70 37 L60 47 L62 62 L50 55 L38 62 L40 47 L30 37 L45 35 Z" fill="#FFD700"/>
                    <circle cx="50" cy="30" r="3" fill="#FFF"/>
                    <circle cx="38" cy="40" r="2" fill="#FFF"/>
                    <circle cx="62" cy="40" r="2" fill="#FFF"/>
                </svg>
                <p>7 Days</p>
            </div>
            <div class="badge badge-pink">
                <svg width="100" height="100" viewBox="0 0 100 100">
                    <circle cx="50" cy="50" r="40" fill="#F5C7C7"/>
                    <circle cx="50" cy="50" r="35" fill="#FFB6C1"/>
                    <path d="M50 20 L55 35 L70 37 L60 47 L62 62 L50 55 L38 62 L40 47 L30 37 L45 35 Z" fill="#FFC0CB"/>
                    <circle cx="50" cy="30" r="3" fill="#FFF"/>
                    <circle cx="38" cy="40" r="2" fill="#FFF"/>
                    <circle cx="62" cy="40" r="2" fill="#FFF"/>
                </svg>
                <p>14 Days</p>
            </div>
            <div class="badge badge-blue">
                <svg width="100" height="100" viewBox="0 0 100 100">
                    <circle cx="50" cy="50" r="40" fill="#87CEEB"/>
                    <circle cx="50" cy="50" r="35" fill="#5F9EA0"/>
                    <path d="M50 20 L55 35 L70 37 L60 47 L62 62 L50 55 L38 62 L40 47 L30 37 L45 35 Z" fill="#00CED1"/>
                    <circle cx="50" cy="30" r="3" fill="#FFF"/>
                    <circle cx="38" cy="40" r="2" fill="#FFF"/>
                    <circle cx="62" cy="40" r="2" fill="#FFF"/>
                </svg>
                <p>30 Days</p>
            </div>
        </div>
    </div>
</div>

@if(session('success'))
<div class="alert-success">
    {{ session('success') }}
</div>
@endif
@endsection