<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DonorController;
use App\Http\Controllers\BloodBankController;
use App\Http\Controllers\BloodRequestController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LogoutController;
use Illuminate\Support\Facades\Route;

// Home Route
Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }
    return redirect()->route('login');
});

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});

// Protected Routes - Require Authentication
Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Donors Routes
    Route::resource('donors', DonorController::class);

    // Blood Banks Routes
    Route::resource('blood-banks', BloodBankController::class);

    // Blood Requests Routes
    Route::resource('blood-requests', BloodRequestController::class);
    Route::post('/blood-requests/{bloodRequest}/status', [BloodRequestController::class, 'updateStatus'])->name('blood-requests.update-status');

    // Logout Route
    Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');
});
