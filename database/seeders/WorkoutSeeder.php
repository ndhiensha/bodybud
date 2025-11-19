<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WorkoutSeeder extends Seeder
{
    public function run(): void
    {
        $workouts = [
            // ARM WORKOUTS
            [
                'category' => 'arm',
                'name' => 'Push-ups',
                'description' => 'Mulai dengan posisi plank, tangan selebar bahu. Turunkan tubuh hingga dada hampir menyentuh lantai, lalu dorong kembali ke atas. Jaga punggung tetap lurus sepanjang gerakan.',
                'calories' => 35,
                'duration' => 180,
                'repetitions' => 15,
                'step_order' => 1
            ],
            [
                'category' => 'arm',
                'name' => 'Tricep Dips',
                'description' => 'Duduk di tepi kursi, tangan di samping pinggul. Geser pantat ke depan, tekuk siku untuk menurunkan tubuh, lalu dorong kembali ke atas menggunakan tangan.',
                'calories' => 30,
                'duration' => 150,
                'repetitions' => 12,
                'step_order' => 2
            ],
            [
                'category' => 'arm',
                'name' => 'Diamond Push-ups',
                'description' => 'Posisi push-up dengan tangan membentuk diamond di bawah dada. Turunkan tubuh sambil menjaga siku tetap dekat dengan tubuh, fokus pada tricep.',
                'calories' => 40,
                'duration' => 120,
                'repetitions' => 10,
                'step_order' => 3
            ],
            [
                'category' => 'arm',
                'name' => 'Arm Circles',
                'description' => 'Berdiri tegak, rentangkan tangan ke samping. Putar tangan dengan gerakan melingkar kecil, kemudian tingkatkan ukuran lingkaran. Lakukan searah dan berlawanan jarum jam.',
                'calories' => 20,
                'duration' => 120,
                'repetitions' => 30,
                'step_order' => 4
            ],
            [
                'category' => 'arm',
                'name' => 'Plank to Down Dog',
                'description' => 'Mulai dari posisi plank. Angkat pinggul ke atas membentuk segitiga (down dog), rasakan stretch di lengan dan bahu. Kembali ke plank dan ulangi.',
                'calories' => 45,
                'duration' => 180,
                'repetitions' => 12,
                'step_order' => 5
            ],

            // LEG WORKOUTS
            [
                'category' => 'leg',
                'name' => 'Squats',
                'description' => 'Berdiri dengan kaki selebar bahu. Turunkan tubuh seperti duduk di kursi, jaga lutut tidak melewati jari kaki. Dorong kembali ke atas melalui tumit.',
                'calories' => 50,
                'duration' => 180,
                'repetitions' => 20,
                'step_order' => 1
            ],
            [
                'category' => 'leg',
                'name' => 'Lunges',
                'description' => 'Langkahkan satu kaki ke depan, turunkan tubuh hingga kedua lutut membentuk 90 derajat. Dorong kembali ke posisi awal. Bergantian kaki.',
                'calories' => 55,
                'duration' => 200,
                'repetitions' => 16,
                'step_order' => 2
            ],
            [
                'category' => 'leg',
                'name' => 'Jump Squats',
                'description' => 'Lakukan squat biasa, tapi saat naik lompat setinggi mungkin. Mendarat dengan lembut langsung ke posisi squat berikutnya.',
                'calories' => 70,
                'duration' => 150,
                'repetitions' => 15,
                'step_order' => 3
            ],
            [
                'category' => 'leg',
                'name' => 'Calf Raises',
                'description' => 'Berdiri tegak, angkat tumit dari lantai hingga berdiri di ujung jari kaki. Tahan sebentar, lalu turunkan perlahan. Gunakan dinding untuk keseimbangan jika perlu.',
                'calories' => 25,
                'duration' => 120,
                'repetitions' => 25,
                'step_order' => 4
            ],
            [
                'category' => 'leg',
                'name' => 'Wall Sit',
                'description' => 'Sandarkan punggung ke dinding, turunkan tubuh hingga paha sejajar lantai seperti duduk di kursi. Tahan posisi ini, jaga lutut di atas pergelangan kaki.',
                'calories' => 35,
                'duration' => 60,
                'repetitions' => 1,
                'step_order' => 5
            ],

            // BACK WORKOUTS
            [
                'category' => 'back',
                'name' => 'Superman',
                'description' => 'Berbaring tengkurap, rentangkan tangan ke depan. Angkat tangan dan kaki secara bersamaan dari lantai, tahan sebentar, lalu turunkan perlahan.',
                'calories' => 30,
                'duration' => 120,
                'repetitions' => 15,
                'step_order' => 1
            ],
            [
                'category' => 'back',
                'name' => 'Bridge',
                'description' => 'Berbaring telentang, tekuk lutut dengan kaki rata di lantai. Angkat pinggul hingga tubuh membentuk garis lurus dari bahu ke lutut. Tahan dan turunkan.',
                'calories' => 40,
                'duration' => 150,
                'repetitions' => 15,
                'step_order' => 2
            ],
            [
                'category' => 'back',
                'name' => 'Bird Dog',
                'description' => 'Posisi merangkak. Rentangkan tangan kanan dan kaki kiri bersamaan hingga sejajar lantai. Tahan, lalu kembali. Bergantian sisi.',
                'calories' => 35,
                'duration' => 180,
                'repetitions' => 20,
                'step_order' => 3
            ],
            [
                'category' => 'back',
                'name' => 'Cobra Stretch',
                'description' => 'Berbaring tengkurap, tangan di bawah bahu. Dorong tubuh bagian atas ke atas sambil menjaga pinggul tetap di lantai. Rasakan stretch di punggung bawah.',
                'calories' => 15,
                'duration' => 90,
                'repetitions' => 10,
                'step_order' => 4
            ],
            [
                'category' => 'back',
                'name' => 'Reverse Snow Angels',
                'description' => 'Berbaring tengkurap, tangan di samping tubuh. Angkat tangan sedikit dari lantai, gerakkan ke arah kepala membentuk setengah lingkaran, lalu kembali.',
                'calories' => 25,
                'duration' => 120,
                'repetitions' => 12,
                'step_order' => 5
            ],
        ];

        DB::table('workouts')->insert($workouts);
    }
}