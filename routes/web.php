<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\HistoryReservationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\ReservationsController; // Pastikan ini controller admin
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\LabController;
// use App\Http\Controllers\ProfileController; // <--- Jangan lupa import ini jika pakai ProfileController

// ====================
// REDIRECT UTAMA
// ====================
Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }
    return redirect()->route('login');
});

// ====================
// ADMIN ROUTES
// ====================
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    
    // <--- PERBAIKAN DISINI: Menambahkan route 'admin.dashboard'
    // Saya arahkan ke halaman Reservasi Admin sebagai dashboard utamanya.
    // Jika kamu punya Controller khusus dashboard admin, ubah [ReservationsController::class, 'index'] 
    Route::get('/dashboard', [ReservationsController::class, 'index'])->name('admin.dashboard'); 

    Route::get('/reservations', [ReservationsController::class, 'index'])->name('admin.reservations.index');
    Route::get('/reservations/{id}', [ReservationsController::class, 'show'])->name('admin.reservations.show');
    Route::post('/reservations/{id}/status', [ReservationsController::class, 'updateStatus'])->name('admin.reservations.updateStatus');

    Route::get('/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('admin.users.destroy');
});

// ====================
// AUTH ROUTES (GUEST ONLY)
// ====================
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.submit');

    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store'])->name('register.store');
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// ====================
// USER ROUTES
// ====================
Route::middleware('auth')->group(function () {

    // DASHBOARD USER
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // SETTINGS
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');

    // PROFILE
    // Pastikan ProfileController sudah di-import di atas jika mau dipakai
    // Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');

    // RESERVATION
    Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index');
    Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');

    // HISTORY
    Route::get('/booked-history', [HistoryController::class, 'index'])->name('booked-history.index');
});