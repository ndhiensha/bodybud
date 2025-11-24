// profile.js - Main Profile Functionality

document.addEventListener('DOMContentLoaded', function() {
    // Initialize all profile functions
    initProfilePictureUpload();
    initAlerts();
    initFormValidation();
    initDateInput();
    initNavbarScroll();
    initLogoutModal();
    initBadgeSystem(); // <-- TAMBAHAN UNTUK BADGE SYSTEM
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

// ============================================
// BADGE SYSTEM - MULAI DARI SINI
// ============================================

// Badge Configuration
const BADGE_CONFIG = {
    // Arms workouts
    'push_up': {
        name: 'Push Up Master',
        category: 'arms',
        icon: '💪',
        levels: {
            beginner: { count: 50, name: 'Push Up Starter' },
            intermediate: { count: 200, name: 'Push Up Pro' },
            advanced: { count: 500, name: 'Push Up Legend' }
        }
    },
    'bicep_curls': {
        name: 'Bicep Builder',
        category: 'arms',
        icon: '💪',
        levels: {
            beginner: { count: 50, name: 'Bicep Starter' },
            intermediate: { count: 200, name: 'Bicep Pro' },
            advanced: { count: 500, name: 'Bicep Legend' }
        }
    },
    'tricep_dips': {
        name: 'Tricep Champion',
        category: 'arms',
        icon: '💪',
        levels: {
            beginner: { count: 50, name: 'Tricep Starter' },
            intermediate: { count: 200, name: 'Tricep Pro' },
            advanced: { count: 500, name: 'Tricep Legend' }
        }
    },
    // Legs workouts
    'squats': {
        name: 'Squat Master',
        category: 'legs',
        icon: '🦵',
        levels: {
            beginner: { count: 50, name: 'Squat Starter' },
            intermediate: { count: 200, name: 'Squat Pro' },
            advanced: { count: 500, name: 'Squat Legend' }
        }
    },
    'lunges': {
        name: 'Lunge Champion',
        category: 'legs',
        icon: '🦵',
        levels: {
            beginner: { count: 50, name: 'Lunge Starter' },
            intermediate: { count: 200, name: 'Lunge Pro' },
            advanced: { count: 500, name: 'Lunge Legend' }
        }
    },
    // Abs workouts
    'crunches': {
        name: 'Crunch Master',
        category: 'abs',
        icon: '🔥',
        levels: {
            beginner: { count: 50, name: 'Crunch Starter' },
            intermediate: { count: 200, name: 'Crunch Pro' },
            advanced: { count: 500, name: 'Crunch Legend' }
        }
    },
    'plank': {
        name: 'Plank Champion',
        category: 'abs',
        icon: '🔥',
        levels: {
            beginner: { count: 300, name: 'Plank Starter' }, // in seconds (5 minutes)
            intermediate: { count: 1200, name: 'Plank Pro' }, // 20 minutes
            advanced: { count: 3000, name: 'Plank Legend' } // 50 minutes
        }
    }
};

// Initialize Badge System
function initBadgeSystem() {
    loadBadgeProgress();
    renderBadgeCollection();
    loadDisplayedBadges();
}

// Load badge progress from localStorage
function loadBadgeProgress() {
    const savedProgress = localStorage.getItem('badgeProgress');
    if (!savedProgress) {
        // Initialize with zero progress
        const initialProgress = {};
        Object.keys(BADGE_CONFIG).forEach(workout => {
            initialProgress[workout] = 0;
        });
        localStorage.setItem('badgeProgress', JSON.stringify(initialProgress));
    }
}

// Get current badge level for a workout
function getBadgeLevel(workout, count) {
    const config = BADGE_CONFIG[workout];
    if (!config) return null;

    if (count >= config.levels.advanced.count) {
        return { level: 'advanced', ...config.levels.advanced };
    } else if (count >= config.levels.intermediate.count) {
        return { level: 'intermediate', ...config.levels.intermediate };
    } else if (count >= config.levels.beginner.count) {
        return { level: 'beginner', ...config.levels.beginner };
    }
    return null;
}

// Render badge collection (all badges including locked ones)
function renderBadgeCollection() {
    const badgeContainer = document.getElementById('badgeCollection');
    if (!badgeContainer) return;

    const progress = JSON.parse(localStorage.getItem('badgeProgress') || '{}');
    let html = '<div class="badge-grid">';

    Object.keys(BADGE_CONFIG).forEach(workout => {
        const config = BADGE_CONFIG[workout];
        const count = progress[workout] || 0;
        const currentLevel = getBadgeLevel(workout, count);

        // Show all three levels for each workout
        ['beginner', 'intermediate', 'advanced'].forEach(level => {
            const levelData = config.levels[level];
            const isUnlocked = currentLevel && 
                (level === 'beginner' && count >= levelData.count ||
                 level === 'intermediate' && count >= levelData.count ||
                 level === 'advanced' && count >= levelData.count);

            html += `
                <div class="badge-item ${isUnlocked ? 'unlocked' : 'locked'}" 
                     data-workout="${workout}" 
                     data-level="${level}"
                     ${isUnlocked ? `onclick="toggleBadgeSelection('${workout}', '${level}')"` : ''}>
                    <div class="badge-icon ${level}">
                        ${isUnlocked ? config.icon : '🔒'}
                    </div>
                    <div class="badge-name">${levelData.name}</div>
                    <div class="badge-progress">
                        ${count} / ${levelData.count}
                    </div>
                    ${isUnlocked ? '<div class="badge-checkmark">✓</div>' : ''}
                </div>
            `;
        });
    });

    html += '</div>';
    badgeContainer.innerHTML = html;
}

// Toggle badge selection for display
function toggleBadgeSelection(workout, level) {
    const badgeKey = `${workout}_${level}`;
    let displayedBadges = JSON.parse(localStorage.getItem('displayedBadges') || '[]');

    const index = displayedBadges.indexOf(badgeKey);
    
    if (index > -1) {
        // Remove badge
        displayedBadges.splice(index, 1);
    } else {
        // Add badge (limit to 3 displayed badges)
        if (displayedBadges.length >= 3) {
            alert('You can only display up to 3 badges on your profile!');
            return;
        }
        displayedBadges.push(badgeKey);
    }

    localStorage.setItem('displayedBadges', JSON.stringify(displayedBadges));
    updateBadgeSelectionUI();
    updateProfileBadges();
}

// Update badge selection UI
function updateBadgeSelectionUI() {
    const displayedBadges = JSON.parse(localStorage.getItem('displayedBadges') || '[]');
    const allBadgeItems = document.querySelectorAll('.badge-item.unlocked');

    allBadgeItems.forEach(item => {
        const workout = item.getAttribute('data-workout');
        const level = item.getAttribute('data-level');
        const badgeKey = `${workout}_${level}`;

        if (displayedBadges.includes(badgeKey)) {
            item.classList.add('selected');
        } else {
            item.classList.remove('selected');
        }
    });
}

// Load and display selected badges on profile
function loadDisplayedBadges() {
    updateProfileBadges();
}

// Update profile badges display
function updateProfileBadges() {
    const achievementContainer = document.querySelector('.achievement-container');
    if (!achievementContainer) return;

    const displayedBadges = JSON.parse(localStorage.getItem('displayedBadges') || '[]');
    
    let html = '';
    displayedBadges.forEach(badgeKey => {
        const [workout, level] = badgeKey.split('_');
        const config = BADGE_CONFIG[workout];
        if (!config) return;

        const levelData = config.levels[level];
        html += `
            <div class="achievement-badge ${level}">
                <div class="badge-icon-large">${config.icon}</div>
                <div class="badge-label">${levelData.name}</div>
            </div>
        `;
    });

    // If no badges selected, show placeholder
    if (html === '') {
        html = `
            <div class="achievement-badge">
                <div class="badge-icon-large">🏆</div>
            </div>
            <div class="achievement-badge">
                <div class="badge-icon-large">⭐</div>
            </div>
            <div class="achievement-badge">
                <div class="badge-icon-large">🎖️</div>
            </div>
        `;
    }

    achievementContainer.innerHTML = html;
}

// Update badge progress (call this when user completes a workout)
function updateBadgeProgress(workout, increment = 1) {
    const progress = JSON.parse(localStorage.getItem('badgeProgress') || '{}');
    progress[workout] = (progress[workout] || 0) + increment;
    localStorage.setItem('badgeProgress', JSON.stringify(progress));

    // Check if new badge unlocked
    const currentLevel = getBadgeLevel(workout, progress[workout]);
    if (currentLevel) {
        showBadgeUnlockNotification(workout, currentLevel);
    }

    // Re-render badge collection
    renderBadgeCollection();
}

// Show badge unlock notification
function showBadgeUnlockNotification(workout, levelData) {
    const config = BADGE_CONFIG[workout];
    
    // Create notification element
    const notification = document.createElement('div');
    notification.className = 'badge-unlock-notification';
    notification.innerHTML = `
        <div class="notification-content">
            <div class="notification-icon">${config.icon}</div>
            <div class="notification-text">
                <h3>Badge Unlocked!</h3>
                <p>${levelData.name}</p>
            </div>
        </div>
    `;

    document.body.appendChild(notification);

    // Animate in
    setTimeout(() => notification.classList.add('show'), 100);

    // Remove after 3 seconds
    setTimeout(() => {
        notification.classList.remove('show');
        setTimeout(() => notification.remove(), 300);
    }, 3000);
}

// Open badge modal
function openBadgeModal() {
    const modal = document.getElementById('badgeModal');
    if (modal) {
        modal.classList.add('active');
        renderBadgeCollection();
        updateBadgeSelectionUI();
    }
}

// Close badge modal
function closeBadgeModal() {
    const modal = document.getElementById('badgeModal');
    if (modal) {
        modal.classList.remove('active');
    }
}

// Filter badge by category
function filterBadgeCategory(category) {
    // Update active tab
    const tabs = document.querySelectorAll('.badge-tab');
    tabs.forEach(tab => tab.classList.remove('active'));
    event.target.classList.add('active');

    // Filter badges
    const badgeItems = document.querySelectorAll('.badge-item');
    badgeItems.forEach(item => {
        const workout = item.getAttribute('data-workout');
        const config = BADGE_CONFIG[workout];
        
        if (category === 'all' || config.category === category) {
            item.style.display = 'block';
        } else {
            item.style.display = 'none';
        }
    });
}

// Example: Simulate workout completion (for testing)
function simulateWorkout(workout) {
    updateBadgeProgress(workout, 10);
}