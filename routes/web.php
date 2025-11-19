<?php

use Illuminate\Support\Facades\Route;

// Controllers
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProgressController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\WorkoutActivityLogController;
use App\Http\Controllers\WorkoutController;

// ✅ NEW: Import 4 CRUD Controllers
use App\Http\Controllers\WorkoutPlanController;
use App\Http\Controllers\WorkoutPlanCreateController;
use App\Http\Controllers\WorkoutPlanUpdateController;
use App\Http\Controllers\WorkoutPlanDeleteController;


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


    /*
    |--------------------------------------------------------------
    | ✅ NEW: Workout Plan CRUD (Separated into 4 Controllers)
    |--------------------------------------------------------------
    */
    
    // === READ (Index & Show) ===
    Route::get('/myworkout', [WorkoutPlanController::class, 'index'])->name('myworkout');
    Route::get('/workout-plans', [WorkoutPlanController::class, 'getWorkouts'])->name('workout-plans.get');
    Route::get('/workout-plans/{id}', [WorkoutPlanController::class, 'show'])->name('workout-plans.show');
    
    // === CREATE ===
    Route::post('/workout-plans', [WorkoutPlanCreateController::class, 'store'])->name('workout-plans.store');
    Route::post('/workout-plans/validate', [WorkoutPlanCreateController::class, 'validate'])->name('workout-plans.validate');
    
    // === UPDATE ===
    Route::put('/workout-plans/{id}', [WorkoutPlanUpdateController::class, 'update'])->name('workout-plans.update');
    Route::patch('/workout-plans/{id}/toggle-complete', [WorkoutPlanUpdateController::class, 'toggleComplete'])->name('workout-plans.toggle');
    Route::post('/workout-plans/bulk-update', [WorkoutPlanUpdateController::class, 'bulkUpdate'])->name('workout-plans.bulk-update');
    
    // === DELETE ===
    Route::delete('/workout-plans/{id}', [WorkoutPlanDeleteController::class, 'destroy'])->name('workout-plans.destroy');
    Route::delete('/workout-plans/completed/all', [WorkoutPlanDeleteController::class, 'deleteCompleted'])->name('workout-plans.delete-completed');
    Route::delete('/workout-plans/past/all', [WorkoutPlanDeleteController::class, 'deletePast'])->name('workout-plans.delete-past');
    Route::delete('/workout-plans/type/{type}', [WorkoutPlanDeleteController::class, 'deleteByType'])->name('workout-plans.delete-by-type');
    Route::delete('/workout-plans/all/confirm', [WorkoutPlanDeleteController::class, 'deleteAll'])->name('workout-plans.delete-all');
    
    // Soft Delete (Optional)
    Route::delete('/workout-plans/{id}/soft', [WorkoutPlanDeleteController::class, 'softDelete'])->name('workout-plans.soft-delete');
    Route::post('/workout-plans/{id}/restore', [WorkoutPlanDeleteController::class, 'restore'])->name('workout-plans.restore');
    Route::delete('/workout-plans/{id}/force', [WorkoutPlanDeleteController::class, 'forceDelete'])->name('workout-plans.force-delete');


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
    | Profile
    |--------------------------------------------------------------
    */
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/update-password', [ProfileController::class, 'updatePassword'])->name('profile.updatePassword');
    Route::delete('/profile/delete-picture', [ProfileController::class, 'deleteProfilePicture'])->name('profile.deletePicture');


    /*
    |--------------------------------------------------------------
    | Workout (General)
    |--------------------------------------------------------------
    */
    Route::get('/workouts', [WorkoutController::class, 'index'])->name('workouts.index');
    Route::get('/workout/{category}', [WorkoutController::class, 'show'])->name('workouts.show');
});


/*
|--------------------------------------------------------------------------
| Auth Scaffolding Routes
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';