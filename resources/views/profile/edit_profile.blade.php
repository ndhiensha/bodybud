@extends('layouts.app')

@section('title', 'Edit Profile')

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
        cursor: pointer;
        position: relative;
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

    .profile-picture-edit {
        position: absolute;
        bottom: 5px;
        right: 5px;
        width: 32px;
        height: 32px;
        background: #4A5D3F;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
    }

    .profile-picture-edit svg {
        width: 16px;
        height: 16px;
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

    .profile-form {
        display: grid;
        grid-template-columns: 1fr auto 1fr;
        gap: 25px 40px;
        text-align: left;
        margin-bottom: 35px;
        padding: 0 20px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
    }

    .form-label {
        font-size: 13px;
        font-weight: 600;
        color: #5A5A5A;
        margin-bottom: 8px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .form-input, .form-select {
        padding: 10px 15px;
        border: 1px solid #E0E0E0;
        border-radius: 8px;
        font-size: 15px;
        color: #2A2A2A;
        transition: all 0.3s;
        font-family: 'Inter', sans-serif;
    }

    .form-input:focus, .form-select:focus {
        outline: none;
        border-color: #D4D96F;
        box-shadow: 0 0 0 3px rgba(212, 217, 111, 0.1);
    }

    .profile-divider {
        width: 1px;
        background: #E0E0E0;
        grid-row: span 3;
    }

    .btn-save-changes {
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
    }

    .btn-save-changes:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(212, 217, 111, 0.5);
    }

    .error-message {
        color: #DC3545;
        font-size: 13px;
        margin-top: 5px;
    }

    #profile-picture-input {
        display: none;
    }

    @media (max-width: 768px) {
        .profile-form {
            grid-template-columns: 1fr;
            gap: 20px;
        }
        
        .profile-divider {
            display: none;
        }
    }
</style>

<div class="profile-container">
    <div class="profile-card">
        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="profile-picture-wrapper">
                <label for="profile-picture-input" style="cursor: pointer;">
                    <div class="profile-picture">
                        @if($user->profile_picture)
                            <img id="profile-preview" src="{{ asset('storage/' . $user->profile_picture) }}" alt="Profile Picture">
                        @else
                            <svg id="profile-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="12" cy="8" r="4" fill="white"/>
                                <path d="M20 21C20 16.5817 16.4183 13 12 13C7.58172 13 4 16.5817 4 21" stroke="white" stroke-width="2" stroke-linecap="round"/>
                            </svg>
                            <img id="profile-preview" style="display: none;" src="" alt="Profile Preview">
                        @endif
                        <div class="profile-picture-edit">
                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 20H21" stroke="white" stroke-width="2" stroke-linecap="round"/>
                                <path d="M16.5 3.5C16.8978 3.10217 17.4374 2.87868 18 2.87868C18.2786 2.87868 18.5544 2.93355 18.8118 3.04015C19.0692 3.14674 19.303 3.303 19.5 3.5C19.697 3.697 19.8533 3.93082 19.9599 4.18819C20.0665 4.44556 20.1213 4.72141 20.1213 5C20.1213 5.27859 20.0665 5.55444 19.9599 5.81181C19.8533 6.06918 19.697 6.303 19.5 6.5L7 19L3 20L4 16L16.5 3.5Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                    </div>
                </label>
                <input type="file" id="profile-picture-input" name="profile_picture" accept="image/*">
            </div>

            <h1 class="profile-name">{{ $user->name }}</h1>
            <p class="profile-email">{{ $user->email }}</p>

            <div class="profile-form">
                <div class="form-group">
                    <label class="form-label">Gender</label>
                    <select name="gender" class="form-select">
                        <option value="">Select Gender</option>
                        <option value="Male" {{ $user->gender == 'Male' ? 'selected' : '' }}>Male</option>
                        <option value="Female" {{ $user->gender == 'Female' ? 'selected' : '' }}>Female</option>
                    </select>
                    @error('gender')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="profile-divider"></div>

                <div class="form-group">
                    <label class="form-label">Date of Birth</label>
                    <input type="date" name="date_of_birth" class="form-input" 
                           value="{{ $user->date_of_birth }}">
                    @error('date_of_birth')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Weight</label>
                    <input type="number" step="0.01" name="weight" class="form-input" 
                           value="{{ $user->weight }}" placeholder="— KG">
                    @error('weight')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="profile-divider"></div>

                <div class="form-group">
                    <label class="form-label">Phone Number</label>
                    <input type="text" name="phone_number" class="form-input" 
                           value="{{ $user->phone_number }}" placeholder="0812-3456-7890">
                    @error('phone_number')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Height</label>
                    <input type="number" step="0.01" name="height" class="form-input" 
                           value="{{ $user->height }}" placeholder="— CM">
                    @error('height')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="profile-divider"></div>

                <div class="form-group">
                    <label class="form-label">Address</label>
                    <input type="text" name="address" class="form-input" 
                           value="{{ $user->address }}" placeholder="Jl. Example No. 123">
                    @error('address')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <button type="submit" class="btn-save-changes">Save Changes</button>
        </form>
    </div>
</div>

<script>
    const input = document.getElementById('profile-picture-input');
    const preview = document.getElementById('profile-preview');
    const icon = document.getElementById('profile-icon');

    input.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
                if (icon) icon.style.display = 'none';
            };
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection