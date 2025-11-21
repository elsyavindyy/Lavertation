<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// ====================================================
// 1. IMPORT SEMUA CONTROLLER
// ====================================================

// Controller Autentikasi
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Auth\RegisteredUserController;

// Controller User Biasa
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\LabController; // (Opsional, jika dipakai nanti)

// Controller Khusus Admin
use App\Http\Controllers\Admin\ReservationsController; // Admin Reservasi
use App\Http\Controllers\Admin\UserController;         // Admin User

// ====================================================
// 2. REDIRECT UTAMA (ROOT)
// ====================================================
Route::get('/', function () {
    // Cek apakah user sedang login
    if (Auth::check()) {
        // Jika sudah login, langsung lempar ke dashboard
        // (Middleware nanti yang menentukan apakah dashboard user atau admin)
        return redirect()->route('dashboard');
    }
    // Jika belum login, lempar ke halaman login
    return redirect()->route('login');
});

// ====================================================
// 3. AUTH ROUTES (GUEST ONLY - BELUM LOGIN)
// ====================================================
Route::middleware('guest')->group(function () {
    // Login
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.submit');

    // Register
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store'])->name('register.store');
});

// Logout (Bisa diakses oleh siapa saja yang sudah login)
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// ====================================================
// 4. ADMIN ROUTES (KHUSUS ADMIN)
// ====================================================
// Middleware 'admin' wajib ada untuk keamanan
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    
    // A. DASHBOARD ADMIN
    // Menggunakan index ReservationsController sebagai halaman utama dashboard admin
    Route::get('/dashboard', [ReservationsController::class, 'index'])->name('admin.dashboard'); 

    // B. MANAJEMEN RESERVASI
    // Melihat daftar reservasi
    Route::get('/reservations', [ReservationsController::class, 'index'])->name('admin.reservations.index');
    // Melihat detail 1 reservasi
    Route::get('/reservations/{id}', [ReservationsController::class, 'show'])->name('admin.reservations.show');
    // Update Status (Approve / Reject)
    Route::post('/reservations/{id}/status', [ReservationsController::class, 'updateStatus'])->name('admin.reservations.updateStatus');
    // Delete Reservasi (Hapus Data)
    Route::delete('/reservations/{id}', [ReservationsController::class, 'destroy'])->name('admin.reservations.destroy');

    // C. MANAJEMEN USER (PENGGUNA)
    // Melihat daftar user
    Route::get('/users', [UserController::class, 'index'])->name('admin.users.index');
    // Menghapus user
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('admin.users.destroy');
});

// ====================================================
// 5. USER ROUTES (USER BIASA)
// ====================================================
// Middleware 'auth' wajib ada agar tamu tidak bisa masuk
Route::middleware('auth')->group(function () {

    // DASHBOARD USER
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // SETTINGS / PENGATURAN
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');

    // RESERVATION (FORMULIR & PROSES)
    Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index');
    Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');

    // HISTORY / RIWAYAT
    Route::get('/booked-history', [HistoryController::class, 'index'])->name('booked-history.index');
});