// profile.js - Main Profile Functionality

document.addEventListener('DOMContentLoaded', function() {
    // Initialize all profile functions
    initProfilePictureUpload();
    initAlerts();
    initFormValidation();
    initDateInput();
    initNavbarScroll();
    initLogoutModal();
});

// Profile Picture Upload
function initProfilePictureUpload() {
    const profilePictureInput = document.getElementById('profile_picture');
    
    if (profilePictureInput) {
        profilePictureInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                // Validate file type
                const validTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
                if (!validTypes.includes(file.type)) {
                    alert('Please upload a valid image file (JPEG, PNG, GIF)');
                    return;
                }

                // Validate file size (max 2MB)
                if (file.size > 2 * 1024 * 1024) {
                    alert('File size must be less than 2MB');
                    return;
                }

                const reader = new FileReader();
                reader.onload = function(e) {
                    const avatarPreview = document.querySelector('.profile-avatar');
                    
                    if (avatarPreview) {
                        // Create new img element
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.alt = 'Profile Picture';
                        img.style.width = '100%';
                        img.style.height = '100%';
                        img.style.objectFit = 'cover';
                        img.style.borderRadius = '50%';
                        
                        // Clear existing content and add new image
                        avatarPreview.innerHTML = '';
                        avatarPreview.appendChild(img);
                        
                        // Re-add edit button
                        const editBtn = document.createElement('div');
                        editBtn.className = 'avatar-edit';
                        editBtn.innerHTML = `
                            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/>
                            </svg>
                        `;
                        avatarPreview.appendChild(editBtn);
                    }
                };
                reader.readAsDataURL(file);
            }
        });
    }

    // Add click event to avatar edit button
    const avatarEdit = document.querySelector('.avatar-edit');
    if (avatarEdit) {
        avatarEdit.addEventListener('click', function() {
            if (profilePictureInput) {
                profilePictureInput.click();
            }
        });
    }
}

// Auto-hide alerts
function initAlerts() {
    const alerts = document.querySelectorAll('.alert-success, .alert-error');
    
    // Add slideOut animation style
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
    
    alerts.forEach(alert => {
        setTimeout(() => {
            alert.style.animation = 'slideOut 0.3s ease';
            setTimeout(() => alert.remove(), 300);
        }, 5000);
    });
}

// Form Validation
function initFormValidation() {
    const profileForm = document.getElementById('profileForm');
    
    if (profileForm) {
        profileForm.addEventListener('submit', function(e) {
            const weight = document.querySelector('input[name="weight"]');
            const height = document.querySelector('input[name="height"]');
            const phone = document.querySelector('input[name="phone"]');
            
            // Validate weight
            if (weight && weight.value) {
                const weightValue = parseFloat(weight.value);
                if (isNaN(weightValue) || weightValue <= 0) {
                    e.preventDefault();
                    alert('Weight must be a valid number greater than 0');
                    weight.focus();
                    return false;
                }
            }
            
            // Validate height
            if (height && height.value) {
                const heightValue = parseFloat(height.value);
                if (isNaN(heightValue) || heightValue <= 0) {
                    e.preventDefault();
                    alert('Height must be a valid number greater than 0');
                    height.focus();
                    return false;
                }
            }

            // Validate phone number
            if (phone && phone.value) {
                const phonePattern = /^[0-9\-\+\s()]+$/;
                if (!phonePattern.test(phone.value)) {
                    e.preventDefault();
                    alert('Please enter a valid phone number');
                    phone.focus();
                    return false;
                }
            }
        });
    }
}

// Date Input Formatting
function initDateInput() {
    const dateInput = document.querySelector('input[name="dob"]');
    if (dateInput) {
        // Set max date to today (can't be born in the future)
        const today = new Date().toISOString().split('T')[0];
        dateInput.setAttribute('max', today);
    }
}

// Navbar Scroll Effect
function initNavbarScroll() {
    const navbar = document.querySelector('.navbar');
    
    if (navbar) {
        window.addEventListener('scroll', function() {
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
    }
}

// Logout Modal
function initLogoutModal() {
    const btnLogout = document.getElementById("btnLogout");
    const logoutModal = document.getElementById("logoutModal");
    const btnCancelLogout = document.getElementById("btnCancelLogout");

    if (btnLogout && logoutModal) {
        btnLogout.addEventListener("click", function(e) {
            e.preventDefault();
            logoutModal.classList.add("active");
        });
    }

    if (btnCancelLogout && logoutModal) {
        btnCancelLogout.addEventListener("click", function(e) {
            e.preventDefault();
            logoutModal.classList.remove("active");
        });
    }

    if (logoutModal) {
        logoutModal.addEventListener("click", function(e) {
            if (e.target === logoutModal) {
                logoutModal.classList.remove("active");
            }
        });
    }
}

// Toggle Edit Mode
function toggleEdit() {
    const formFields = document.querySelectorAll('#profileFormFields input, #profileFormFields select');
    const btnEdit = document.getElementById('btnEdit');
    const btnSave = document.getElementById('btnSave');
    const formGroups = document.querySelectorAll('.form-group');

    // Enable all form fields
    formFields.forEach(field => {
        field.disabled = false;
        field.classList.add('editable');
    });

    // Remove readonly class from form groups
    formGroups.forEach(group => {
        group.classList.remove('form-readonly');
        group.classList.add('form-editable');
    });

    // Toggle buttons
    if (btnEdit) btnEdit.style.display = 'none';
    if (btnSave) btnSave.style.display = 'block';
}

// Cancel Edit (optional function to revert changes)
function cancelEdit() {
    const formFields = document.querySelectorAll('#profileFormFields input, #profileFormFields select');
    const btnEdit = document.getElementById('btnEdit');
    const btnSave = document.getElementById('btnSave');
    const formGroups = document.querySelectorAll('.form-group');

    // Disable all form fields
    formFields.forEach(field => {
        field.disabled = true;
        field.classList.remove('editable');
    });

    // Add readonly class back to form groups
    formGroups.forEach(group => {
        group.classList.add('form-readonly');
        group.classList.remove('form-editable');
    });

    // Toggle buttons
    if (btnEdit) btnEdit.style.display = 'block';
    if (btnSave) btnSave.style.display = 'none';
    
    // Reload page to reset form values
    location.reload();
}