<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Admin;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\HistoryReservationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\RegisteredUserController; 
use App\Http\Controllers\Admin\ReservationsController;


// ====================
// REDIRECT UTAMA
// ====================
Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }
    return redirect()->route('login');
});


Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/reservations', [ReservationController::class, 'index'])->name('admin.reservations.index');
    Route::get('/reservations/{id}', [ReservationController::class, 'show'])->name('admin.reservations.show');
    Route::post('/reservations/{id}/status', [ReservationController::class, 'updateStatus'])->name('admin.reservations.updateStatus');
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
// PROTECTED ROUTES (AUTH ONLY)
// ====================
Route::middleware('auth')->group(function () {

    // DASHBOARD
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // PROFILE (Menggunakan closure sementara untuk menghindari error controller)
    Route::get('/profile', function () {
        // Ganti 'profile.index' dengan nama view Profile Anda yang benar
        return view('profile.index'); 
    })->name('profile.show');

    // SETTINGS (ROUTE UNTUK MENGHILANGKAN ERROR settings.index)
    Route::get('/settings', function () {
        // Ganti 'settings.index' dengan nama view Settings Anda yang benar
        return view('settings.index'); 
    })->name('settings.index');
    Route::get('/history-reservations', [HistoryReservationController::class, 'index'])->name('history.index');
    Route::get('/history-reservations/{id}', [HistoryReservationController::class, 'show'])->name('history.show');
    // LABS
    Route::get('/labs', [LabController::class, 'index'])->name('labs.index');
    Route::get('/labs/{id}', [LabController::class, 'show'])->name('labs.show');
    Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index');
    Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');
    
});