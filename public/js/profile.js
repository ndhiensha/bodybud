// profile.js - Main Profile Functionality

document.addEventListener('DOMContentLoaded', function() {
    initProfilePictureUpload();
    initAlerts();
    initFormValidation();
    initDateInput();
    initNavbarScroll();
    initLogoutModal();
    initBadgeSystem();
});

// Profile Picture Upload
function initProfilePictureUpload() {
    const profilePictureInput = document.getElementById('profile_picture');
    
    if (profilePictureInput) {
        profilePictureInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const validTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
                if (!validTypes.includes(file.type)) {
                    alert('Please upload a valid image file (JPEG, PNG, GIF)');
                    return;
                }

                if (file.size > 2 * 1024 * 1024) {
                    alert('File size must be less than 2MB');
                    return;
                }

                const reader = new FileReader();
                reader.onload = function(e) {
                    const avatarPreview = document.querySelector('.profile-avatar');
                    
                    if (avatarPreview) {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.alt = 'Profile Picture';
                        img.style.width = '100%';
                        img.style.height = '100%';
                        img.style.objectFit = 'cover';
                        img.style.borderRadius = '50%';
                        
                        avatarPreview.innerHTML = '';
                        avatarPreview.appendChild(img);
                        
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
            
            if (weight && weight.value) {
                const weightValue = parseFloat(weight.value);
                if (isNaN(weightValue) || weightValue <= 0) {
                    e.preventDefault();
                    alert('Weight must be a valid number greater than 0');
                    weight.focus();
                    return false;
                }
            }
            
            if (height && height.value) {
                const heightValue = parseFloat(height.value);
                if (isNaN(heightValue) || heightValue <= 0) {
                    e.preventDefault();
                    alert('Height must be a valid number greater than 0');
                    height.focus();
                    return false;
                }
            }

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

    formFields.forEach(field => {
        field.disabled = false;
        field.classList.add('editable');
    });

    formGroups.forEach(group => {
        group.classList.remove('form-readonly');
        group.classList.add('form-editable');
    });

    if (btnEdit) btnEdit.style.display = 'none';
    if (btnSave) btnSave.style.display = 'block';
}

// Cancel Edit
function cancelEdit() {
    const formFields = document.querySelectorAll('#profileFormFields input, #profileFormFields select');
    const btnEdit = document.getElementById('btnEdit');
    const btnSave = document.getElementById('btnSave');
    const formGroups = document.querySelectorAll('.form-group');

    formFields.forEach(field => {
        field.disabled = true;
        field.classList.remove('editable');
    });

    formGroups.forEach(group => {
        group.classList.add('form-readonly');
        group.classList.remove('form-editable');
    });

    if (btnEdit) btnEdit.style.display = 'block';
    if (btnSave) btnSave.style.display = 'none';
    
    location.reload();
}

// ============================================
// SIMPLIFIED BADGE SYSTEM - 3 FIXED BADGES
// ============================================

const BADGE_CONFIG = {
    beginner: { 
        count: 25, 
        name: 'Beginner',
        icon: '/images/beginner.svg',  // ⭐ Path ke file SVG
        color: 'beginner'
    },
    intermediate: { 
        count: 50, 
        name: 'Intermediate',
        icon: '/images/intermediete.svg',  // ⭐ Path ke file SVG
        color: 'intermediate'
    },
    advanced: { 
        count: 100, 
        name: 'Advanced',
        icon: '/images/advanced.svg',  // ⭐ Path ke file SVG
        color: 'advanced'
    }
};

// Initialize Badge System
function initBadgeSystem() {
    syncBadgeProgressFromBackend();
    renderBadges();
}

// Sync dengan data dari backend (progress.js)
function syncBadgeProgressFromBackend() {
    let totalCompleted = 0;
    
    // Ambil data dari progress.js jika tersedia
    if (typeof window.progressData !== 'undefined') {
        const categories = window.progressData.categories;
        
        // Hitung total workout yang completed dari semua kategori
        Object.keys(categories).forEach(category => {
            totalCompleted += categories[category].completed || 0;
        });
    }
    
    // Simpan total workout completed
    localStorage.setItem('totalWorkoutsCompleted', totalCompleted.toString());
    
    return totalCompleted;
}

// Render 3 badges langsung
// Render 3 badges langsung
function renderBadges() {
    const achievementContainer = document.querySelector('.achievement-container');
    if (!achievementContainer) return;

    // Ambil total workout completed
    let totalCompleted = parseInt(localStorage.getItem('totalWorkoutsCompleted') || '0');
    
    // Re-sync dari backend jika tersedia
    if (typeof window.progressData !== 'undefined') {
        totalCompleted = syncBadgeProgressFromBackend();
    }

    let html = '';

    // Render 3 badges: Beginner, Intermediate, Advanced
    Object.keys(BADGE_CONFIG).forEach(level => {
        const config = BADGE_CONFIG[level];
        const isUnlocked = totalCompleted >= config.count;
        
        // ⭐ PERUBAHAN UTAMA DI SINI ⭐
        html += `
            <div class="achievement-badge ${isUnlocked ? config.color : 'locked'}">
                <div class="badge-icon-large">
                    <img src="${config.icon}" alt="${config.name}" class="badge-main-icon">
                    ${!isUnlocked ? '<div class="lock-overlay">🔒</div>' : ''}
                </div>
                <div class="badge-label">${config.name}</div>
                <div class="badge-progress">${totalCompleted} / ${config.count} workouts</div>
            </div>
        `;
    });

    achievementContainer.innerHTML = html;
    
    // Check for newly unlocked badges
    checkBadgeUnlocks(totalCompleted);
}

// Check dan notify untuk badge yang baru unlock
function checkBadgeUnlocks(totalCompleted) {
    const lastChecked = parseInt(localStorage.getItem('lastBadgeCheck') || '0');
    
    // Cek apakah ada badge baru yang unlock
    Object.keys(BADGE_CONFIG).forEach(level => {
        const config = BADGE_CONFIG[level];
        
        // Jika baru mencapai threshold badge ini
        if (totalCompleted >= config.count && lastChecked < config.count) {
            showBadgeUnlockNotification(config);
        }
    });
    
    // Update last check
    localStorage.setItem('lastBadgeCheck', totalCompleted.toString());
}

// Show badge unlock notification
function showBadgeUnlockNotification(config) {
    const notification = document.createElement('div');
    notification.className = 'badge-unlock-notification';
    notification.innerHTML = `
        <div class="notification-content">
            <div class="notification-icon">${config.icon}</div>
            <div class="notification-text">
                <h3>Badge Unlocked!</h3>
                <p>${config.name} Achievement</p>
            </div>
        </div>
    `;

    document.body.appendChild(notification);

    setTimeout(() => notification.classList.add('show'), 100);

    setTimeout(() => {
        notification.classList.remove('show');
        setTimeout(() => notification.remove(), 300);
    }, 3000);
}

// Function untuk update badge dari halaman lain (dipanggil setelah workout selesai)
function updateBadgeProgress() {
    renderBadges();
}