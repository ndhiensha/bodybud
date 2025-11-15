<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Workout - BodyBud</title>

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/myworkout.css') }}">

</head>

<body>
    <div class="container">

        <nav class="navbar">
            <div class="logo">
                <img src="/images/logo.png" alt="BodyBud Logo" class="logo-img">
                <span class="logo-text">BodyBud</span>
            </div>
           <ul class="nav-menu">
                <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li><a href="{{ route('myworkout') }}">My Workout</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </nav>

       <!-- HEADER (WITH FRAME) -->
        <div class="header">
            <div class="header-container">

                <div class="header-left">
                    <h1>
                        <svg width="55" height="55" fill="none" stroke="#3E4D37" stroke-width="3" viewBox="0 0 24 24">
                            <path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        Plan Your Workout
                    </h1>
                    <p>Atur jadwal workout kamu biar lebih terorganisir</p>
                </div>

                <button class="btn-add" onclick="openModal()">
                    <svg width="20" height="20" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M12 4v16m8-8H4"/>
                    </svg>
                    Buat Workout Baru
                </button>

            </div>
        </div>


        <!-- GRID -->
        <div id="workoutGrid" class="workout-grid"></div>

        <!-- EMPTY STATE -->
        <div id="emptyState" class="empty-state" style="display:none;">
            <svg class="icon-lg" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
            </svg>
            <h3>Belum ada workout yang dijadwalkan</h3>
            <p>Klik "Buat Workout Baru" untuk mulai planning!</p>
        </div>
    </div>

        <!-- MODAL OVERLAY -->
    <div id="workoutModal" class="modal">

        <!-- MODAL BOX -->
        <div class="modal-content">

            <div class="modal-header">
                <h2 class="modal-title" id="modalTitle">Buat Workout Baru</h2>
                <button class="btn-close" onclick="closeModal()">×</button>
            </div>

            <div class="form-group">
                <label for="workoutDate">Tanggal</label>
                <input type="date" id="workoutDate">
            </div>

            <div class="form-group">
                <label for="workoutType">Jenis Workout</label>
                <select id="workoutType">
                    <option value="Arm Workout">Arm Workout</option>
                    <option value="Leg Workout">Leg Workout</option>
                    <option value="Back Workout">Back Workout</option>
                </select>
            </div>

            <div class="form-group">
                <label for="workoutDuration">Durasi (menit)</label>
                <input type="number" id="workoutDuration">
            </div>

            <div class="form-group">
                <label for="workoutNotes">Catatan (opsional)</label>
                <textarea id="workoutNotes"></textarea>
            </div>

            <div class="modal-actions">
                <button class="btn-cancel" onclick="closeModal()">Batal</button>
                <button class="btn-submit" onclick="saveWorkout()">Simpan</button>
            </div>

        </div>

    </div>

    <!-- SCRIPT -->
    <script src="{{ asset('js/workout.js') }}"></script>

</body>
</html>
