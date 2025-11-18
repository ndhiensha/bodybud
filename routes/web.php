<?php

use Illuminate\Support\Facades\Route;

// Controllers
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProgressController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\WorkoutActivityLogController;


/*
|--------------------------------------------------------------------------
| Public Pages (Tanpa Login)
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);


/*
|--------------------------------------------------------------------------
| Routes Dengan Middleware Auth
|--------------------------------------------------------------------------
| Semua rute yang memerlukan user terautentikasi (login)
*/

Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------
    | Dashboard & Static Pages
    |--------------------------------------------------------------
    */
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/myworkout', function () {
        return view('myworkout');
    })->name('myworkout');


    /*
    |--------------------------------------------------------------
    | Progress (Rute yang Bermasalah)
    |--------------------------------------------------------------
    */
    // Pastikan ini adalah satu-satunya rute /progress
    Route::get('/progress', [ProgressController::class, 'showPage'])->name('progress');
    Route::post('/progress/start', [ProgressController::class, 'start']);
    Route::put('/progress/{id}', [ProgressController::class, 'updateSets']);


    /*
    |--------------------------------------------------------------
    | Workout Activity Logs
    |--------------------------------------------------------------
    */
    Route::get('/activity', [WorkoutActivityLogController::class, 'index'])->name('activity.index');
    Route::post('/activity/add', [WorkoutActivityLogController::class, 'store'])->name('activity.store');
    Route::get('/activity/stats', [WorkoutActivityLogController::class, 'stats'])->name('activity.stats');


    /*
    |--------------------------------------------------------------
    | Notifications
    |--------------------------------------------------------------
    */
    Route::get('/notifications/get', [NotificationController::class, 'getUserNotifications'])->name('notifications.get');
    Route::get('/notifikasi', [NotificationController::class, 'getUserNotifications'])->name('notifikasi');


    /*
    |--------------------------------------------------------------
    | Profile (Grup rute profile yang benar)
    |--------------------------------------------------------------
    */
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    
    // Jika Anda ingin menggunakan show, ganti edit. Saya biarkan `edit` sesuai kode awal Anda.
    // Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show'); 
    
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


/*
|--------------------------------------------------------------------------
| Auth Scaffolding Routes Breeze/Fortify/Jetstream
|--------------------------------------------------------------------------
*/
// Pastikan file auth.php yang direquire berada di luar blok middleware 'auth' di atas
require __DIR__.'/auth.php';