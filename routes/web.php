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
    | Progress
    |--------------------------------------------------------------
    */
    Route::get('/progress', [ProgressController::class, 'showPage'])->name('progress');
    Route::post('/progress/start', [ProgressController::class, 'start']);
    Route::put('/progress/{id}', [ProgressController::class, 'updateSets']);


    /*
    |--------------------------------------------------------------
    | Workout Activity Logs
    |--------------------------------------------------------------
    */
    Route::get('/activity', [WorkoutActivityLogController::class, 'index']);
    Route::post('/activity/add', [WorkoutActivityLogController::class, 'store']);
    Route::get('/activity/stats', [WorkoutActivityLogController::class, 'stats']);


    /*
    |--------------------------------------------------------------
    | Notifications
    |--------------------------------------------------------------
    */
    Route::get('/notifications/get', [NotificationController::class, 'getUserNotifications'])
        ->name('notifications.get');

    Route::get('/notifikasi', [NotificationController::class, 'getUserNotifications'])
        ->name('notifikasi');


    /*
    |--------------------------------------------------------------
    | Profile
    |--------------------------------------------------------------
    */
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

/*
|--------------------------------------------------------------------------
| Profile Routes
|--------------------------------------------------------------------------
|
| Add these routes to your existing web.php file
|
*/

// Profile routes (protected by auth middleware)
Route::middleware(['auth'])->group(function () {
    // Show profile page
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    
    // Update profile
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    
    // Delete account
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Other routes...
Route::get('/', function () {
    return view('welcome');
});

Route::get('/workout', function () {
    return view('workout');
})->middleware('auth');

Route::get('/progress', function () {
    return view('progress');
})->middleware('auth');

});


/*
|--------------------------------------------------------------------------
| Auth Scaffolding Routes Breeze/Fortify/Jetstream
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';


