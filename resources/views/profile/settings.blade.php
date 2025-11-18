@extends('layouts.app')

@section('title', 'Settings')

@section('content')
<style>
    .settings-container {
        max-width: 700px;
        margin: 120px auto 60px;
        padding: 0 20px;
    }

    .settings-card {
        background: #FFFFFF;
        border-radius: 20px;
        padding: 40px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        margin-bottom: 25px;
    }

    .settings-title {
        font-size: 24px;
        font-weight: 700;
        color: #2A2A2A;
        margin-bottom: 25px;
        padding-bottom: 15px;
        border-bottom: 2px solid #F0F0F0;
    }

    .form-group {
        margin-bottom: 25px;
    }

    .form-label {
        display: block;
        font-size: 14px;
        font-weight: 600;
        color: #5A5A5A;
        margin-bottom: 8px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .form-input {
        width: 100%;
        padding: 12px 18px;
        border: 1px solid #E0E0E0;
        border-radius: 10px;
        font-size: 15px;
        color: #2A2A2A;
        transition: all 0.3s;
        font-family: 'Inter', sans-serif;
    }

    .form-input:focus {
        outline: none;
        border-color: #D4D96F;
        box-shadow: 0 0 0 3px rgba(212, 217, 111, 0.1);
    }

    .form-input:disabled {
        background-color: #F5F5F5;
        cursor: not-allowed;
    }

    .btn-save {
        padding: 14px 50px;
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

    .btn-save:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(212, 217, 111, 0.5);
    }

    .btn-delete {
        padding: 14px 40px;
        background: linear-gradient(135deg, #FF6B6B 0%, #EE5A52 100%);
        border: none;
        border-radius: 30px;
        font-size: 16px;
        font-weight: 600;
        color: #FFFFFF;
        cursor: pointer;
        transition: all 0.3s;
        box-shadow: 0 4px 15px rgba(255, 107, 107, 0.3);
    }

    .btn-delete:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(255, 107, 107, 0.5);
    }

    .danger-zone {
        border: 2px solid #FFE5E5;
        background: #FFF5F5;
        border-radius: 12px;
        padding: 25px;
    }

    .danger-zone-title {
        font-size: 18px;
        font-weight: 700;
        color: #DC3545;
        margin-bottom: 10px;
    }

    .danger-zone-text {
        font-size: 14px;
        color: #6A6A6A;
        margin-bottom: 20px;
        line-height: 1.6;
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

    .error-message {
        color: #DC3545;
        font-size: 13px;
        margin-top: 5px;
    }

    .password-toggle {
        position: relative;
    }

    .password-toggle input {
        padding-right: 45px;
    }

    .password-toggle-btn {
        position: absolute;
        right: 12px;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        cursor: pointer;
        color: #8A8A8A;
        font-size: 20px;
        padding: 5px;
    }

    /* Modal Styles */
    .modal {
        display: none;
        position: fixed;
        z-index: 9999;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.6);
        animation: fadeIn 0.3s;
    }

    .modal.active {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .modal-content {
        background: #FFFFFF;
        border-radius: 20px;
        padding: 40px;
        max-width: 450px;
        width: 90%;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
        animation: slideUp 0.3s;
    }

    .modal-title {
        font-size: 22px;
        font-weight: 700;
        color: #DC3545;
        margin-bottom: 15px;
    }

    .modal-text {
        font-size: 15px;
        color: #6A6A6A;
        margin-bottom: 25px;
        line-height: 1.6;
    }

    .modal-buttons {
        display: flex;
        gap: 15px;
        justify-content: flex-end;
    }

    .btn-cancel {
        padding: 12px 30px;
        background: #F0F0F0;
        border: none;
        border-radius: 25px;
        font-size: 15px;
        font-weight: 600;
        color: #5A5A5A;
        cursor: pointer;
        transition: all 0.3s;
    }

    .btn-cancel:hover {
        background: #E0E0E0;
    }

    .btn-confirm-delete {
        padding: 12px 30px;
        background: linear-gradient(135deg, #FF6B6B 0%, #EE5A52 100%);
        border: none;
        border-radius: 25px;
        font-size: 15px;
        font-weight: 600;
        color: #FFFFFF;
        cursor: pointer;
        transition: all 0.3s;
    }

    .btn-confirm-delete:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(255, 107, 107, 0.5);
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    @keyframes slideUp {
        from {
            transform: translateY(50px);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }
</style>

<div class="settings-container">
    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Account Information -->
    <div class="settings-card">
        <h2 class="settings-title">Account Information</h2>
        <form action="{{ route('profile.settings.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label class="form-label">Full Name</label>
                <input type="text" name="name" class="form-input" 
                       value="{{ old('name', $user->name) }}" required>
                @error('name')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Email Address</label>
                <input type="email" name="email" class="form-input" 
                       value="{{ old('email', $user->email) }}" required>
                @error('email')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn-save">Save Changes</button>
        </form>
    </div>

    <!-- Change Password -->
    <div class="settings-card">
        <h2 class="settings-title">Change Password</h2>
        <form action="{{ route('profile.settings.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group password-toggle">
                <label class="form-label">Current Password</label>
                <input type="password" id="current-password" name="current_password" class="form-input">
                <button type="button" class="password-toggle-btn" onclick="togglePassword('current-password')">👁️</button>
                @error('current_password')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group password-toggle">
                <label class="form-label">New Password</label>
                <input type="password" id="new-password" name="new_password" class="form-input">
                <button type="button" class="password-toggle-btn" onclick="togglePassword('new-password')">👁️</button>
                @error('new_password')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group password-toggle">
                <label class="form-label">Confirm New Password</label>
                <input type="password" id="confirm-password" name="new_password_confirmation" class="form-input">
                <button type="button" class="password-toggle-btn" onclick="togglePassword('confirm-password')">👁️</button>
            </div>

            <button type="submit" class="btn-save">Update Password</button>
        </form>
    </div>

    <!-- Danger Zone -->
    <div class="settings-card">
        <h2 class="settings-title">Danger Zone</h2>
        <div class="danger-zone">
            <h3 class="danger-zone-title">Delete Account</h3>
            <p class="danger-zone-text">
                Once you delete your account, there is no going back. Please be certain. 
                All your data including profile information, workout history, and achievements will be permanently deleted.
            </p>
            <button type="button" class="btn-delete" onclick="openDeleteModal()">
                Delete My Account
            </button>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="modal">
    <div class="modal-content">
        <h3 class="modal-title">Confirm Account Deletion</h3>
        <p class="modal-text">
            Are you absolutely sure you want to delete your account? This action cannot be undone.
            Please enter your password to confirm.
        </p>
        
        <form id="deleteForm" action="{{ route('profile.delete') }}" method="POST">
            @csrf
            @method('DELETE')
            
            <div class="form-group password-toggle">
                <label class="form-label">Password</label>
                <input type="password" id="delete-password" name="password" class="form-input" required>
                <button type="button" class="password-toggle-btn" onclick="togglePassword('delete-password')">👁️</button>
            </div>

            <div class="modal-buttons">
                <button type="button" class="btn-cancel" onclick="closeDeleteModal()">Cancel</button>
                <button type="submit" class="btn-confirm-delete">Delete Account</button>
            </div>
        </form>
    </div>
</div>

<script>
    function togglePassword(inputId) {
        const input = document.getElementById(inputId);
        input.type = input.type === 'password' ? 'text' : 'password';
    }

    function openDeleteModal() {
        document.getElementById('deleteModal').classList.add('active');
    }

    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.remove('active');
    }

    // Close modal when clicking outside
    window.onclick = function(event) {
        const modal = document.getElementById('deleteModal');
        if (event.target === modal) {
            closeDeleteModal();
        }
    }
</script>
@endsection