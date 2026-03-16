<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ConnectionController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', [AuthController::class, 'home'])->name('home');

// Authentication routes
Route::middleware('guest')->group(function () {
    // Login routes
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'processLogin']);

    // Registration routes (3-step process)
    Route::get('/register', [AuthController::class, 'showRegisterStep1'])->name('register');
    Route::get('/register/step1', [AuthController::class, 'showRegisterStep1'])->name('register.step1');
    Route::post('/register/step1', [AuthController::class, 'processRegisterStep1']);
    
    Route::get('/register/step2', [AuthController::class, 'showRegisterStep2'])->name('register.step2');
    Route::post('/register/step2', [AuthController::class, 'processRegisterStep2']);
    
    Route::get('/register/step3', [AuthController::class, 'showRegisterStep3'])->name('register.step3');
    Route::post('/register/step3', [AuthController::class, 'processRegisterStep3']);
});

// Protected routes (require authentication)
Route::middleware('auth')->group(function () {
    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Dashboard
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');

    // Profile management
    Route::get('/my-profile', [AuthController::class, 'showMyProfile'])->name('my-profile');
    Route::get('/profile/edit', [AuthController::class, 'showEditProfile'])->name('profile.edit');
    Route::put('/profile', [AuthController::class, 'updateProfile'])->name('profile.update');
    Route::post('/profile/deactivate', [AuthController::class, 'deactivateProfile'])->name('profile.deactivate');
    Route::delete('/profile/delete', [AuthController::class, 'deleteProfile'])->name('profile.delete');
    Route::get('/profile/download-data', [AuthController::class, 'downloadUserData'])->name('profile.download-data');

    // Search functionality
    Route::get('/search', [AuthController::class, 'showSearch'])->name('search');
    Route::get('/profile/{user}', [AuthController::class, 'showProfile'])->name('profile.show');

    // Connection routes
    Route::post('/connect/request/{user}', [ConnectionController::class, 'sendRequest'])->name('connection.request');
    Route::post('/connect/accept/{connection}', [ConnectionController::class, 'acceptRequest'])->name('connection.accept');
    Route::post('/connect/decline/{connection}', [ConnectionController::class, 'declineRequest'])->name('connection.decline');
    Route::get('/connect/status/{user}', [ConnectionController::class, 'getConnectionStatus'])->name('connection.status');
});
