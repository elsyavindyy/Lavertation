<?php
use App\Http\Controllers\LabController;
use App\Http\Controllers\ReservationController;


Route::get('/labs', [LabController::class, 'index']);
Route::get('/labs/{id}', [LabController::class, 'show']);

Route::get('/reservations', [ReservationController::class, 'index']);
Route::post('/reservations', [ReservationController::class, 'store']);
Route::put('/reservations/{id}', [ReservationController::class, 'update']);
Route::delete('/reservations/{id}', [ReservationController::class, 'destroy']);

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::resource('reservations', ReservationController::class);

require __DIR__.'/auth.php';
