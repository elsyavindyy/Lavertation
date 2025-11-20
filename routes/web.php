<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LabController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\HistoryController;

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

    // // PROFILE (Menggunakan closure sementara untuk menghindari error controller)
    // Route::get('/profile', function () {
    //     // Ganti 'profile.index' dengan nama view Profile Anda yang benar
    //     return view('profile.index'); 
    // })->name('profile.show');

    // SETTINGS (ROUTE UNTUK MENGHILANGKAN ERROR settings.index)
    Route::get('/settings', function () {
        return view('settings.index'); 
    })->name('settings.index');
    
    // LABS
    Route::get('/labs', [LabController::class, 'index'])->name('labs.index');
    Route::get('/labs/{id}', [LabController::class, 'show'])->name('labs.show');
    Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index');
    Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');
    
    // HISTORY RESERVATIONS
    Route::get('/history', [HistoryController::class, 'index'])
    ->name('booked-history.index');
    Route::get('/booked-history', [HistoryController::class, 'index'])->name('booked-history.index');
});