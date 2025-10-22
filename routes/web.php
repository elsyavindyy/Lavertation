<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LabController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\RegisteredUserController;

// ====================
// REDIRECT UTAMA
// ====================
Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard'); // Sudah login → dashboard
    }
    return redirect()->route('login'); // Belum login → ke login
});

// ====================
// AUTH ROUTES
// ====================
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.submit');

    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store'])->name('register.store');
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Dummy profile route
Route::get('/profile', function () {
    return view('profile');
})->middleware('auth')->name('profile.edit');

// ====================
// PROTECTED ROUTES (AUTH ONLY)
// ====================
Route::middleware('auth')->group(function () {

    // DASHBOARD
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // LABS
    Route::get('/labs', [LabController::class, 'index'])->name('labs.index');
    Route::get('/labs/{id}', [LabController::class, 'show'])->name('labs.show');
    Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index');
    Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');
    
});
