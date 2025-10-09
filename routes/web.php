<?php

use App\Http\Controllers\LabController;
use App\Http\Controllers\ReservationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);

Route::get('/welcome', function () {
    return view('welcome');
})->middleware('auth')->name('welcome');

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

// Public labs
Route::get('/labs', [LabController::class, 'index'])->name('labs.index');
Route::get('/labs/{id}', [LabController::class, 'show'])->name('labs.show');

// Reservations (hanya login user)
Route::middleware('auth')->group(function () {
    Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index');
    Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');
    Route::get('/reservations/{id}', [ReservationController::class, 'show'])->name('reservations.show');
    Route::put('/reservations/{id}', [ReservationController::class, 'update'])->name('reservations.update');
    Route::delete('/reservations/{id}', [ReservationController::class, 'destroy'])->name('reservations.destroy');
});

require __DIR__.'/auth.php';
