@extends('layouts.master')

@section('title', 'Edit Profile')

@section('content')
<div class="profile-container">
    <div class="profile-card">
        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" id="profileForm">
            @csrf
            
            <div class="profile-avatar-edit">
                <div class="avatar-preview">
                    @if($user->profile_picture)
                        <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Profile Picture" id="avatarPreview">
                    @else
                        <svg width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" id="avatarPreview">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                    @endif
                </div>
                <label for="profile_picture" class="avatar-edit-btn">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                    </svg>
                </label>
                <input type="file" id="profile_picture" name="profile_picture" accept="image/*" style="display: none;">
            </div>

            <h2 class="profile-name">{{ $user->name }}</h2>
            <p class="profile-email">{{ $user->email }}</p>

            <div class="profile-info">
                <div class="info-column">
                    <div class="info-item">
                        <label>Gender</label>
                        <div class="radio-group">
                            <label class="radio-label">
                                <input type="radio" name="gender" value="male" {{ $user->gender == 'male' ? 'checked' : '' }}>
                                <span>Male</span>
                            </label>
                            <label class="radio-label">
                                <input type="radio" name="gender" value="female" {{ $user->gender == 'female' ? 'checked' : '' }}>
                                <span>Female</span>
                            </label>
                        </div>
                        @error('gender')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="info-item">
                        <label>Weight</label>
                        <input type="number" step="0.01" name="weight" value="{{ old('weight', $user->weight) }}" placeholder="-- KG" class="input-field">
                        @error('weight')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="info-item">
                        <label>Height</label>
                        <input type="number" step="0.01" name="height" value="{{ old('height', $user->height) }}" placeholder="-- CM" class="input-field">
                        @error('height')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="info-divider"></div>

                <div class="info-column">
                    <div class="info-item">
                        <label>Date of Birth</label>
                        <input type="date" name="date_of_birth" value="{{ old('date_of_birth', $user->date_of_birth) }}" class="input-field">
                        @error('date_of_birth')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="info-item">
                        <label>Phone Number</label>
                        <input type="tel" name="phone_number" value="{{ old('phone_number', $user->phone_number) }}" placeholder="0812-1313-1414" class="input-field">
                        @error('phone_number')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="info-item">
                        <label>Address</label>
                        <input type="text" name="address" value="{{ old('address', $user->address) }}" placeholder="Bukit Cemara Tidor L3/No. 16" class="input-field">
                        @error('address')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <button type="submit" class="btn-primary">Save Changes</button>
        </form>
    </div>
</div>

@if($errors->any())
<div class="alert-error">
    <ul>
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
@endsection