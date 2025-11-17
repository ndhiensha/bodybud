let workouts = [];
let editingId = null;

// Load workouts from storage
function loadWorkouts() {
    const stored = localStorage.getItem('workouts');
    workouts = stored ? JSON.parse(stored) : [];
    renderWorkouts();
}

// Save workouts to storage
function saveToStorage() {
    localStorage.setItem('workouts', JSON.stringify(workouts));
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
    const sorted = [...workouts].sort((a, b) => new Date(a.date) - new Date(b.date));

    grid.innerHTML = sorted.map(workout => {
        const typeClass = workout.type.toLowerCase().replace(' ', '-').replace('workout', '').trim();
        const date = new Date(workout.date);
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
                        <div class="workout-type">${workout.type}</div>
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
function editWorkout(id) {
    const workout = workouts.find(w => w.id === id);
    if (!workout) return;

    editingId = id;
    document.getElementById('modalTitle').textContent = 'Edit Workout';
    document.getElementById('workoutDate').value = workout.date;
    document.getElementById('workoutType').value = workout.type;
    document.getElementById('workoutDuration').value = workout.duration;
    document.getElementById('workoutNotes').value = workout.notes || '';
    document.getElementById('workoutModal').classList.add('active');
}

// Save workout
function saveWorkout() {
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

    if (editingId) {
        const index = workouts.findIndex(w => w.id === editingId);
        workouts[index] = { ...workouts[index], date, type, duration: durationInt, notes };
    } else {
        const newWorkout = {
            id: Date.now(),
            date,
            type,
            duration: durationInt,
            notes
        };
        workouts.push(newWorkout);
    }

    saveToStorage();
    renderWorkouts();
    closeModal();
}

// Delete workout
function deleteWorkout(id) {
    if (!confirm('Yakin mau hapus workout ini?')) return;
    workouts = workouts.filter(w => w.id !== id);
    saveToStorage();
    renderWorkouts();
}

// Close modal by clicking background
document.getElementById('workoutModal').addEventListener('click', function(e) {
    if (e.target === this) closeModal();
});

// Initialize
loadWorkouts();

// Sticky header with scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });