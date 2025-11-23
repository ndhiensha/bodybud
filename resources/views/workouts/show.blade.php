<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Workout App</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: linear-gradient(135deg, #f5e6e8 0%, #e8f4f8 50%, #e8f5e9 100%);
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
        }

        /* Header */
        .header {
            text-align: center;
            margin-bottom: 50px;
            position: relative;
        }

        .btn-back {
            position: absolute;
            left: 0;
            top: 0;
            background: white;
            color: #333;
            padding: 12px 24px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }

        .btn-back:hover {
            background: #f0f0f0;
            transform: translateX(-5px);
        }

        .main-title {
            font-size: 2.5rem;
            font-weight: 800;
            color: #333;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .subtitle {
            color: #666;
            font-size: 1.1rem;
        }

        /* Exercise Cards Grid */
        .exercise-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 25px;
            margin-bottom: 50px;
        }

        .exercise-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .exercise-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        }

        .exercise-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 5rem;
        }

        .exercise-card.pink .exercise-image {
            background: linear-gradient(135deg, #ffc0cb 0%, #ffb6c1 100%);
        }

        .exercise-card.blue .exercise-image {
            background: linear-gradient(135deg, #add8e6 0%, #87ceeb 100%);
        }

        .exercise-card.green .exercise-image {
            background: linear-gradient(135deg, #c8e6c9 0%, #a5d6a7 100%);
        }

        .exercise-content {
            padding: 25px;
        }

        .exercise-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #333;
            margin-bottom: 12px;
        }

        .exercise-description {
            color: #666;
            line-height: 1.6;
            margin-bottom: 20px;
            font-size: 0.95rem;
        }

        .exercise-stats {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
            margin-bottom: 20px;
        }

        .stat-badge {
            background: #f8f9fa;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 600;
            color: #555;
        }

        .btn-select {
            width: 100%;
            background: #000;
            color: white;
            padding: 15px;
            border: none;
            border-radius: 50px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-select:hover {
            background: #333;
            transform: scale(1.02);
        }

        /* Modal Detail */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            z-index: 1000;
            align-items: center;
            justify-content: center;
            padding: 20px;
            overflow-y: auto;
        }

        .modal.active {
            display: flex;
        }

        .modal-content {
            background: white;
            border-radius: 20px;
            max-width: 800px;
            width: 100%;
            max-height: 90vh;
            overflow-y: auto;
            animation: slideUp 0.3s ease;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .modal-header {
            padding: 30px;
            border-bottom: 2px solid #f0f0f0;
            position: sticky;
            top: 0;
            background: white;
            z-index: 10;
        }

        .modal-close {
            float: right;
            background: #f0f0f0;
            border: none;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            font-size: 1.5rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .modal-close:hover {
            background: #e0e0e0;
            transform: rotate(90deg);
        }

        .modal-title {
            font-size: 2rem;
            font-weight: 700;
            color: #333;
            margin-top: 10px;
        }

        .modal-body {
            padding: 30px;
        }

        .video-container {
            position: relative;
            padding-bottom: 56.25%;
            height: 0;
            overflow: hidden;
            border-radius: 15px;
            margin-bottom: 30px;
            background: #000;
        }

        .video-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        .detail-section {
            margin-bottom: 30px;
        }

        .detail-section h3 {
            font-size: 1.3rem;
            font-weight: 700;
            color: #333;
            margin-bottom: 15px;
        }

        .detail-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .detail-item {
            text-align: center;
            padding: 20px;
            background: #f8f9fa;
            border-radius: 15px;
        }

        .detail-value {
            font-size: 2rem;
            font-weight: 800;
            color: #333;
            margin-bottom: 8px;
        }

        .detail-label {
            font-size: 0.9rem;
            color: #666;
            font-weight: 500;
        }

        .instructions-list {
            list-style: none;
            padding: 0;
        }

        .instructions-list li {
            padding: 15px;
            background: #f8f9fa;
            border-radius: 10px;
            margin-bottom: 10px;
            padding-left: 45px;
            position: relative;
        }

        .instructions-list li:before {
            content: attr(data-step);
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            background: #000;
            color: white;
            width: 25px;
            height: 25px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8rem;
            font-weight: 700;
        }

        .btn-start-workout {
            width: 100%;
            background: #4CAF50;
            color: white;
            padding: 20px;
            border: none;
            border-radius: 50px;
            font-size: 1.2rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 20px;
        }

        .btn-start-workout:hover {
            background: #45a049;
            transform: scale(1.02);
        }

        /* Category Tabs */
        .category-tabs {
            display: flex;
            gap: 15px;
            margin-bottom: 40px;
            flex-wrap: wrap;
            justify-content: center;
        }

        .tab-btn {
            padding: 12px 30px;
            border: 2px solid #ddd;
            background: white;
            border-radius: 50px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .tab-btn.active {
            background: #000;
            color: white;
            border-color: #000;
        }

        .tab-btn:hover {
            border-color: #000;
        }

        @media (max-width: 768px) {
            .main-title {
                font-size: 1.8rem;
            }

            .exercise-grid {
                grid-template-columns: 1fr;
            }

            .btn-back {
                position: static;
                display: inline-block;
                margin-bottom: 20px;
            }

            .header {
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <a class="btn-back" onclick="goBack()" href= "{{ route('dashboard') }}">← Back</a>
            <h1 class="main-title" id="categoryTitle">Pilih Kategori Workout</h1>
            <p class="subtitle" id="categorySubtitle">Pilih jenis latihan yang kamu mau</p>
        </div>

        <!-- Category Tabs -->
        <div class="category-tabs">
            <button class="tab-btn active" onclick="changeCategory('arm')">💪 Arm Workout</button>
            <button class="tab-btn" onclick="changeCategory('leg')">🦵 Leg Workout</button>
            <button class="tab-btn" onclick="changeCategory('abs')">🔥 Abs Workout</button>
        </div>

        <!-- Exercise Grid -->
        <div class="exercise-grid" id="exerciseGrid"></div>
    </div>

    <!-- Modal Detail -->
    <div class="modal" id="exerciseModal">
        <div class="modal-content">
            <div class="modal-header">
                <button class="modal-close" onclick="closeModal()">×</button>
                <h2 class="modal-title" id="modalTitle"></h2>
            </div>
            <div class="modal-body">
                <div class="video-container" id="videoContainer"></div>
                
                <div class="detail-grid">
                    <div class="detail-item">
                        <div class="detail-value" id="modalCalories">0</div>
                        <div class="detail-label">Kalori</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-value" id="modalDuration">0</div>
                        <div class="detail-label">Menit</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-value" id="modalReps">0</div>
                        <div class="detail-label">Repetisi</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-value" id="modalSets">0</div>
                        <div class="detail-label">Set</div>
                    </div>
                </div>

                <div class="detail-section">
                    <h3>📝 Cara Melakukan</h3>
                    <ul class="instructions-list" id="modalInstructions"></ul>
                </div>

                <div class="detail-section">
                    <h3>⚠️ Tips & Perhatian</h3>
                    <p id="modalTips" style="color: #666; line-height: 1.8;"></p>
                </div>

                <button class="btn-start-workout" onclick="startWorkout()">
                    🏋️ Mulai Latihan Sekarang
                </button>
            </div>
        </div>
    </div>

    <script>
        const workoutData = {
            arm: [
                {
                    name: "Push Up",
                    description: "Latihan klasik untuk dada, trisep, dan bahu. Cocok untuk pemula hingga advanced.",
                    icon: "💪",
                    calories: 50,
                    duration: 5,
                    reps: 15,
                    sets: 3,
                    videoId: "IODxDxX7oi4",
                    instructions: [
                        "Mulai dengan posisi plank, tangan selebar bahu",
                        "Turunkan tubuh hingga dada hampir menyentuh lantai",
                        "Jaga tubuh tetap lurus dari kepala hingga kaki",
                        "Dorong tubuh kembali ke posisi awal",
                        "Ulangi gerakan dengan kontrol penuh"
                    ],
                    tips: "Jaga core tetap kencang. Jangan biarkan pinggul turun. Nafas keluar saat naik, masuk saat turun."
                },
                {
                    name: "Bicep Curl",
                    description: "Latihan fokus untuk membesarkan otot lengan atas (biceps). Butuh dumbbell atau beban.",
                    icon: "🏋️",
                    calories: 40,
                    duration: 8,
                    reps: 12,
                    sets: 4,
                    videoId: "ykJmrZ5v0Oo",
                    instructions: [
                        "Berdiri tegak dengan dumbbell di kedua tangan",
                        "Siku tetap dekat dengan tubuh",
                        "Angkat beban ke arah bahu dengan memutar pergelangan tangan",
                        "Tahan sebentar di posisi atas",
                        "Turunkan perlahan ke posisi awal"
                    ],
                    tips: "Jangan ayun tubuh. Fokus pada kontraksi biceps. Gunakan beban yang sesuai kemampuan."
                },
                {
                    name: "Tricep Dips",
                    description: "Latihan bodyweight untuk tricep menggunakan kursi atau bench.",
                    icon: "💺",
                    calories: 45,
                    duration: 6,
                    reps: 12,
                    sets: 3,
                    videoId: "6kALZikXxLc",
                    instructions: [
                        "Duduk di tepi kursi/bench, tangan di samping pinggul",
                        "Geser tubuh ke depan hingga pantat melayang",
                        "Turunkan tubuh dengan menekuk siku 90 derajat",
                        "Dorong kembali ke atas dengan tricep",
                        "Jaga punggung dekat dengan kursi"
                    ],
                    tips: "Jangan turun terlalu dalam jika baru mulai. Fokus pada tricep, bukan bahu."
                },
                {
                    name: "Diamond Push Up",
                    description: "Variasi push up yang lebih fokus ke tricep dengan posisi tangan diamond.",
                    icon: "💎",
                    calories: 60,
                    duration: 5,
                    reps: 10,
                    sets: 3,
                    videoId: "J0DnG1_S92I",
                    instructions: [
                        "Posisi plank dengan tangan membentuk diamond di bawah dada",
                        "Jari telunjuk dan jempol kedua tangan saling menyentuh",
                        "Turunkan tubuh hingga dada menyentuh tangan",
                        "Dorong kembali ke atas dengan kontrol",
                        "Jaga tubuh tetap lurus"
                    ],
                    tips: "Gerakan ini lebih sulit dari push up biasa. Mulai dengan kneeling jika perlu."
                },
                {
                    name: "Shoulder Press",
                    description: "Latihan untuk bahu menggunakan dumbbell atau barbel.",
                    icon: "🎯",
                    calories: 55,
                    duration: 8,
                    reps: 10,
                    sets: 4,
                    videoId: "qEwKCR5JCog",
                    instructions: [
                        "Berdiri atau duduk dengan dumbbell di ketinggian bahu",
                        "Telapak tangan menghadap ke depan",
                        "Dorong beban ke atas hingga lengan lurus",
                        "Jangan kunci siku sepenuhnya di atas",
                        "Turunkan perlahan ke posisi awal"
                    ],
                    tips: "Jaga core kencang. Jangan melengkungkan punggung saat mendorong."
                },
                {
                    name: "Plank to Push Up",
                    description: "Kombinasi plank dan push up untuk lengan dan core.",
                    icon: "🔄",
                    calories: 65,
                    duration: 7,
                    reps: 10,
                    sets: 3,
                    videoId: "L4oFJRDAU4Q",
                    instructions: [
                        "Mulai dari posisi plank dengan forearm",
                        "Naikkan satu tangan ke posisi push up",
                        "Naikkan tangan satunya",
                        "Turun kembali ke forearm satu per satu",
                        "Ulangi dengan memulai tangan yang berbeda"
                    ],
                    tips: "Jaga pinggul tetap stabil. Jangan goyang ke kiri-kanan."
                }
            ],
            leg: [
                {
                    name: "Squats",
                    description: "Raja dari semua latihan kaki. Melatih paha, glutes, dan core.",
                    icon: "🦵",
                    calories: 70,
                    duration: 10,
                    reps: 15,
                    sets: 4,
                    videoId: "aclHkVaku9U",
                    instructions: [
                        "Berdiri dengan kaki selebar bahu",
                        "Turunkan pinggul seperti duduk di kursi",
                        "Jaga lutut tidak melewati jari kaki",
                        "Turun hingga paha sejajar lantai",
                        "Dorong tumit untuk kembali berdiri"
                    ],
                    tips: "Jaga dada tetap tegak. Berat badan di tumit, bukan jari kaki."
                },
                {
                    name: "Lunges",
                    description: "Latihan satu kaki yang efektif untuk quadriceps dan glutes.",
                    icon: "🚶",
                    calories: 65,
                    duration: 8,
                    reps: 12,
                    sets: 3,
                    videoId: "QOVaHwm-Q6U",
                    instructions: [
                        "Berdiri tegak, melangkah maju dengan satu kaki",
                        "Turunkan pinggul hingga kedua lutut 90 derajat",
                        "Lutut belakang hampir menyentuh lantai",
                        "Dorong kaki depan untuk kembali berdiri",
                        "Ganti kaki dan ulangi"
                    ],
                    tips: "Jaga tubuh tegak. Lutut depan tidak boleh melewati jari kaki."
                },
                {
                    name: "Jump Squats",
                    description: "Squats explosive untuk power dan cardio.",
                    icon: "🦘",
                    calories: 90,
                    duration: 6,
                    reps: 15,
                    sets: 3,
                    videoId: "A-cFYWvaHr0",
                    instructions: [
                        "Mulai dari posisi squat biasa",
                        "Ledakkan tubuh ke atas dengan melompat",
                        "Ayunkan lengan untuk momentum",
                        "Mendarat dengan lembut kembali ke squat",
                        "Langsung lanjut repetisi berikutnya"
                    ],
                    tips: "Mendarat dengan lembut untuk melindungi lutut. Pemanasan dulu sebelum melakukan."
                },
                {
                    name: "Calf Raises",
                    description: "Latihan untuk betis yang kuat dan definisi jelas.",
                    icon: "👠",
                    calories: 35,
                    duration: 6,
                    reps: 20,
                    sets: 4,
                    videoId: "gwLzBJYoWlI",
                    instructions: [
                        "Berdiri tegak dengan kaki selebar pinggul",
                        "Angkat tumit setinggi mungkin",
                        "Tahan sebentar di posisi atas",
                        "Turunkan perlahan ke posisi awal",
                        "Bisa pakai tangga untuk range of motion lebih"
                    ],
                    tips: "Gerakan perlahan dan terkontrol. Squeeze betis di posisi atas."
                },
                {
                    name: "Wall Sit",
                    description: "Latihan isometrik yang membakar paha dengan intensif.",
                    icon: "🧱",
                    calories: 50,
                    duration: 5,
                    reps: 60,
                    sets: 3,
                    videoId: "y-wV4Venusw",
                    instructions: [
                        "Bersandar di dinding, kaki 60cm dari dinding",
                        "Turunkan tubuh hingga paha sejajar lantai",
                        "Punggung rata di dinding, lutut 90 derajat",
                        "Tahan posisi selama yang diminta",
                        "Berdiri perlahan saat selesai"
                    ],
                    tips: "Jangan tahan nafas. Tetap bernafas normal meski terasa berat."
                },
                {
                    name: "Bulgarian Split Squat",
                    description: "Latihan kaki advance dengan satu kaki di atas bangku.",
                    icon: "🎪",
                    calories: 75,
                    duration: 10,
                    reps: 10,
                    sets: 3,
                    videoId: "2C-uNgKwPLE",
                    instructions: [
                        "Kaki belakang di atas bangku/kursi",
                        "Kaki depan cukup jauh untuk balance",
                        "Turunkan tubuh hingga lutut depan 90 derajat",
                        "Dorong kaki depan untuk naik",
                        "Selesai satu sisi baru ganti"
                    ],
                    tips: "Ini cukup advanced. Mulai tanpa beban dulu untuk balance."
                }
            ],
            abs: [
                {
                    name: "Crunches",
                    description: "Latihan abs klasik yang efektif untuk upper abs.",
                    icon: "🔥",
                    calories: 40,
                    duration: 5,
                    reps: 20,
                    sets: 3,
                    videoId: "Xyd_fa5zoEU",
                    instructions: [
                        "Berbaring telentang, lutut ditekuk",
                        "Tangan di belakang kepala (jangan tarik leher)",
                        "Angkat bahu dari lantai menggunakan abs",
                        "Exhale saat naik, inhale saat turun",
                        "Jangan angkat punggung bawah dari lantai"
                    ],
                    tips: "Fokus pada abs, bukan leher. Gerakan tidak perlu naik tinggi."
                },
                {
                    name: "Plank",
                    description: "Latihan core terbaik untuk stabilitas dan kekuatan inti.",
                    icon: "🏋️",
                    calories: 45,
                    duration: 5,
                    reps: 60,
                    sets: 3,
                    videoId: "pSHjTRCQxIw",
                    instructions: [
                        "Posisi forearm plank, siku di bawah bahu",
                        "Tubuh lurus dari kepala hingga tumit",
                        "Aktifkan abs dan glutes",
                        "Jangan biarkan pinggul turun atau naik",
                        "Tahan posisi sesuai waktu yang ditentukan"
                    ],
                    tips: "Bernafas normal. Jika terlalu berat, turunkan lutut ke lantai."
                },
                {
                    name: "Russian Twist",
                    description: "Latihan rotasi untuk obliques (abs samping).",
                    icon: "🌪️",
                    calories: 55,
                    duration: 6,
                    reps: 30,
                    sets: 3,
                    videoId: "wkD8rjkodUI",
                    instructions: [
                        "Duduk dengan lutut ditekuk, kaki terangkat",
                        "Tubuh sedikit condong ke belakang",
                        "Putar tubuh ke kanan, sentuh lantai",
                        "Putar ke kiri, sentuh lantai",
                        "Itu hitungan 1 rep (kanan-kiri)"
                    ],
                    tips: "Gunakan beban jika terlalu mudah. Jaga punggung tetap lurus."
                },
                {
                    name: "Leg Raises",
                    description: "Target lower abs dengan mengangkat kaki.",
                    icon: "⬆️",
                    calories: 50,
                    duration: 6,
                    reps: 15,
                    sets: 3,
                    videoId: "JB2oyawG9KI",
                    instructions: [
                        "Berbaring telentang, kaki lurus",
                        "Tangan di samping atau di bawah pinggul",
                        "Angkat kaki hingga 90 derajat",
                        "Turunkan perlahan tanpa menyentuh lantai",
                        "Jaga punggung bawah tetap di lantai"
                    ],
                    tips: "Jangan ayun kaki. Gerakan harus terkontrol dan perlahan."
                },
                {
                    name: "Mountain Climbers",
                    description: "Cardio + abs dalam satu gerakan dinamis.",
                    icon: "⛰️",
                    calories: 80,
                    duration: 5,
                    reps: 30,
                    sets: 3,
                    videoId: "nmwgirgXLYM",
                    instructions: [
                        "Mulai dari posisi push up/plank",
                        "Tarik lutut kanan ke dada",
                        "Kembali dan tarik lutut kiri",
                        "Bergantian dengan cepat seperti berlari",
                        "Jaga pinggul tidak naik turun"
                    ],
                    tips: "Semakin cepat, semakin intens cardio-nya. Mulai pelan jika masih belajar."
                },
                {
                    name: "Bicycle Crunches",
                    description: "Kombinasi crunch dan twist untuk seluruh area abs.",
                    icon: "🚴",
                    calories: 60,
                    duration: 6,
                    reps: 20,
                    sets: 3,
                    videoId: "9FGilxCbdz8",
                    instructions: [
                        "Berbaring dengan tangan di belakang kepala",
                        "Angkat bahu dan aktifkan abs",
                        "Bawa siku kanan ke lutut kiri",
                        "Ganti siku kiri ke lutut kanan",
                        "Kaki yang tidak dipakai tetap lurus melayang"
                    ],
                    tips: "Gerakan seperti mengayuh sepeda. Fokus pada rotasi tubuh."
                }
            ]
        };

        let currentCategory = 'arm';
        let selectedExercise = null;

        function changeCategory(category) {
            currentCategory = category;
            
            // Update active tab
            document.querySelectorAll('.tab-btn').forEach(btn => {
                btn.classList.remove('active');
            });
            event.target.classList.add('active');

            // Update title
            const titles = {
                arm: 'ARM WORKOUT',
                leg: 'LEG WORKOUT',
                abs: 'ABS WORKOUT'
            };
            
            document.getElementById('categoryTitle').textContent = titles[category];
            document.getElementById('categorySubtitle').textContent = `${workoutData[category].length} jenis latihan tersedia`;

            // Render exercises
            renderExercises();
        }

        function renderExercises() {
            const grid = document.getElementById('exerciseGrid');
            const exercises = workoutData[currentCategory];
            
            grid.innerHTML = exercises.map((exercise, index) => `
                <div class="exercise-card ${currentCategory === 'arm' ? 'pink' : currentCategory === 'leg' ? 'blue' : 'green'}" onclick="showDetail(${index})" style="animation: fadeIn 0.5s ease ${index * 0.1}s both;">
                    <div class="exercise-image">${exercise.icon}</div>
                    <div class="exercise-content">
                        <h3 class="exercise-title">${exercise.name}</h3>
                        <p class="exercise-description">${exercise.description}</p>
                        <div class="exercise-stats">
                            <span class="stat-badge">🔥 ${exercise.calories} kal</span>
                            <span class="stat-badge">⏱️ ${exercise.duration} min</span>
                            <span class="stat-badge">🔄 ${exercise.reps}x</span>
                        </div>
                        <button class="btn-select">Lihat Detail & Video →</button>
                    </div>
                </div>
            `).join('');
        }

        function showDetail(index) {
            selectedExercise = workoutData[currentCategory][index];
            const modal = document.getElementById('exerciseModal');
            
            // Fill modal content
            document.getElementById('modalTitle').textContent = selectedExercise.name;
            document.getElementById('modalCalories').textContent = selectedExercise.calories;
            document.getElementById('modalDuration').textContent = selectedExercise.duration;
            document.getElementById('modalReps').textContent = selectedExercise.reps;
            document.getElementById('modalSets').textContent = selectedExercise.sets;
            document.getElementById('modalTips').textContent = selectedExercise.tips;
            
            // Video
            document.getElementById('videoContainer').innerHTML = `
                <iframe 
                    src="https://www.youtube.com/embed/${selectedExercise.videoId}" 
                    frameborder="0" 
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                    allowfullscreen>
                </iframe>
            `;
            
            // Instructions
            const instructionsList = document.getElementById('modalInstructions');
            instructionsList.innerHTML = selectedExercise.instructions.map((instruction, i) => `
                <li data-step="${i + 1}">${instruction}</li>
            `).join('');
            
            // Show modal
            modal.classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            const modal = document.getElementById('exerciseModal');
            modal.classList.remove('active');
            document.body.style.overflow = 'auto';
        }

        function startWorkout() {
            alert(`🏋️ Memulai: ${selectedExercise.name}!\n\n` +
                  `📊 Target:\n` +
                  `• ${selectedExercise.sets} set × ${selectedExercise.reps} repetisi\n` +
                  `• Istirahat 60 detik antar set\n` +
                  `• Total waktu: ${selectedExercise.duration} menit\n\n` +
                  `💡 Tips:\n` +
                  `• Pemanasan 3-5 menit dulu\n` +
                  `• Fokus pada form yang benar\n` +
                  `• Nafas teratur\n` +
                  `• Stop jika ada nyeri\n\n` +
                  `Semangat! 💪`);
            
            closeModal();
        }

        function goBack() {
            if (confirm('Kembali ke halaman utama?')) {
                // Di aplikasi asli, ini akan navigate ke dashboard
                alert('Navigasi ke dashboard...');
            }
        }

        // Close modal when clicking outside
        document.getElementById('exerciseModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });

        // Keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeModal();
            }
        });

        // Add fadeIn animation
        const style = document.createElement('style');
        style.textContent = `
            @keyframes fadeIn {
                from {
                    opacity: 0;
                    transform: translateY(20px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
        `;
        document.head.appendChild(style);

        // Initialize
        renderExercises();
    </script>
</body>
</html>