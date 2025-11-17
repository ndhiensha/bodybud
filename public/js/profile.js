document.addEventListener('DOMContentLoaded', function() {
    const profilePictureInput = document.getElementById('profile_picture');
    
    if (profilePictureInput) {
        profilePictureInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const avatarPreview = document.getElementById('avatarPreview');
                    const avatarContainer = avatarPreview.parentElement;
                    
                    // Create new img element
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.alt = 'Profile Picture';
                    img.id = 'avatarPreview';
                    img.style.width = '100%';
                    img.style.height = '100%';
                    img.style.objectFit = 'cover';
                    
                    // Replace old preview
                    avatarContainer.innerHTML = '';
                    avatarContainer.appendChild(img);
                };
                reader.readAsDataURL(file);
            }
        });
    }
    
    // Auto-hide alerts after 5 seconds
    const alerts = document.querySelectorAll('.alert-success, .alert-error');
    alerts.forEach(alert => {
        setTimeout(() => {
            alert.style.animation = 'slideOut 0.3s ease';
            setTimeout(() => alert.remove(), 300);
        }, 5000);
    });
    
    // Add slideOut animation
    const style = document.createElement('style');
    style.textContent = `
        @keyframes slideOut {
            from {
                transform: translateX(0);
                opacity: 1;
            }
            to {
                transform: translateX(100%);
                opacity: 0;
            }
        }
    `;
    document.head.appendChild(style);
    
    // Form validation
    const profileForm = document.getElementById('profileForm');
    if (profileForm) {
        profileForm.addEventListener('submit', function(e) {
            const weight = document.querySelector('input[name="weight"]');
            const height = document.querySelector('input[name="height"]');
            
            if (weight && parseFloat(weight.value) <= 0) {
                e.preventDefault();
                alert('Weight must be greater than 0');
                weight.focus();
                return false;
            }
            
            if (height && parseFloat(height.value) <= 0) {
                e.preventDefault();
                alert('Height must be greater than 0');
                height.focus();
                return false;
            }
        });
    }
    
    // Date input formatting
    const dateInput = document.querySelector('input[name="date_of_birth"]');
    if (dateInput && !dateInput.value) {
        dateInput.type = 'text';
        dateInput.placeholder = '15 May, 2006';
        dateInput.addEventListener('focus', function() {
            this.type = 'date';
        });
        dateInput.addEventListener('blur', function() {
            if (!this.value) {
                this.type = 'text';
            }
        });
    }
});