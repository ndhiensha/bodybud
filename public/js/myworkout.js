let workouts = [];
let editingId = null;

// CSRF Token for Laravel
const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;

// Load workouts from server
async function loadWorkouts() {
    try {
        const response = await fetch('/workout-plans', {
            method: 'GET',
            headers: {
                'Accept': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            }
        });

        const result = await response.json();
        
        if (result.success) {
            workouts = result.data;
            renderWorkouts();
        } else {
            console.error('Failed to load workouts:', result.message);
        }
    } catch (error) {
        console.error('Error loading workouts:', error);
    }
}

// Render workouts
function renderWorkouts() {
    const grid = document.getElementById('workoutGrid');
    const empty = document.getElementById('emptyState');

    if (workouts.length === 0) {
        grid.style.display = 'none';
        empty.style.display = 'block';
        return;
    }

    grid.style.display = 'grid';
    empty.style.display = 'none';

    // Sort by date
    const sorted = [...workouts].sort((a, b) => new Date(a.workout_date) - new Date(b.workout_date));

    grid.innerHTML = sorted.map(workout => {
        const typeClass = workout.workout_type.toLowerCase().replace(' ', '-').replace('workout', '').trim();
        const date = new Date(workout.workout_date);
        const dateStr = date.toLocaleDateString('id-ID', {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        });

        return `
            <div class="workout-card type-${typeClass}">
                <div class="card-header">
                    <div>
                        <div class="workout-type">${workout.workout_type}</div>
                        <h3 class="workout-date">${dateStr}</h3>
                        <p class="workout-duration">Durasi: ${workout.duration} menit</p>
                    </div>
                    <div class="card-actions">
                        <button class="btn-icon btn-edit" onclick="editWorkout(${workout.id})">
                            <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                        </button>
                        <button class="btn-icon btn-delete" onclick="deleteWorkout(${workout.id})">
                            <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                        </button>
                    </div>
                </div>
                ${workout.notes ? `
                    <div class="workout-notes">
                        <p>${workout.notes}</p>
                    </div>
                ` : ''}
            </div>
        `;
    }).join('');
}

// Open modal
function openModal() {
    editingId = null;
    document.getElementById('modalTitle').textContent = 'Buat Workout Baru';
    document.getElementById('workoutDate').value = '';
    document.getElementById('workoutType').value = 'Arm Workout';
    document.getElementById('workoutDuration').value = '';
    document.getElementById('workoutNotes').value = '';
    document.getElementById('workoutModal').classList.add('active');
}

// Close modal
function closeModal() {
    document.getElementById('workoutModal').classList.remove('active');
    editingId = null;
}

// Edit workout
async function editWorkout(id) {
    try {
        const response = await fetch(`/workout-plans/${id}`, {
            method: 'GET',
            headers: {
                'Accept': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            }
        });

        const result = await response.json();
        
        if (result.success) {
            const workout = result.data;
            editingId = id;
            document.getElementById('modalTitle').textContent = 'Edit Workout';
            document.getElementById('workoutDate').value = workout.workout_date;
            document.getElementById('workoutType').value = workout.workout_type;
            document.getElementById('workoutDuration').value = workout.duration;
            document.getElementById('workoutNotes').value = workout.notes || '';
            document.getElementById('workoutModal').classList.add('active');
        } else {
            alert(result.message);
        }
    } catch (error) {
        console.error('Error fetching workout:', error);
        alert('Gagal mengambil data workout');
    }
}

// Save workout (Create or Update)
async function saveWorkout() {
    const date = document.getElementById('workoutDate').value;
    const type = document.getElementById('workoutType').value;
    const duration = document.getElementById('workoutDuration').value;
    const notes = document.getElementById('workoutNotes').value;

    // Validation
    if (!date) return alert('Tanggal harus diisi!');
    if (!duration) return alert('Durasi harus diisi!');

    const durationInt = parseInt(duration);
    if (isNaN(durationInt) || durationInt < 1) {
        return alert('Durasi minimal 1 menit!');
    }

    const workoutData = {
        workout_date: date,
        workout_type: type,
        duration: durationInt,
        notes: notes
    };

    try {
        let response;
        
        if (editingId) {
            // UPDATE
            response = await fetch(`/workout-plans/${editingId}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify(workoutData)
            });
        } else {
            // CREATE
            response = await fetch('/workout-plans', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify(workoutData)
            });
        }

        const result = await response.json();

        if (result.success) {
            alert(result.message);
            closeModal();
            loadWorkouts(); // Reload data
        } else {
            // Show validation errors
            if (result.errors) {
                const errorMessages = Object.values(result.errors).flat().join('\n');
                alert(errorMessages);
            } else {
                alert(result.message);
            }
        }
    } catch (error) {
        console.error('Error saving workout:', error);
        alert('Gagal menyimpan workout. Silakan coba lagi.');
    }
}

// Delete workout
async function deleteWorkout(id) {
    if (!confirm('Yakin mau hapus workout ini?')) return;

    try {
        const response = await fetch(`/workout-plans/${id}`, {
            method: 'DELETE',
            headers: {
                'Accept': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            }
        });

        const result = await response.json();

        if (result.success) {
            alert(result.message);
            loadWorkouts(); // Reload data
        } else {
            alert(result.message);
        }
    } catch (error) {
        console.error('Error deleting workout:', error);
        alert('Gagal menghapus workout');
    }
}

// Close modal by clicking background
document.getElementById('workoutModal')?.addEventListener('click', function(e) {
    if (e.target === this) closeModal();
});

// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
    loadWorkouts();
});

// Sticky header with scroll effect
window.addEventListener('scroll', function() {
    const navbar = document.querySelector('.navbar');
    if (navbar) {
        if (window.scrollY > 50) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    }
});

// Logout modal handling
const logoutBtn = document.querySelector('.icon-btn:last-child');
const logoutModal = document.getElementById('logoutModal');
const btnCancelLogout = document.getElementById('btnCancelLogout');

if (logoutBtn && logoutModal) {
    logoutBtn.addEventListener('click', () => {
        logoutModal.classList.add('active');
    });

    btnCancelLogout?.addEventListener('click', () => {
        logoutModal.classList.remove('active');
    });

    logoutModal.addEventListener('click', (e) => {
        if (e.target === logoutModal) {
            logoutModal.classList.remove('active');
        }
    });
}