<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;

class HistoryReservationController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // PERBAIKAN:
        // Saya menghapus ->where('status', 'completed')
        // Agar status 'approved', 'pending', dan 'rejected' SEMUA MUNCUL.
        
        $history = Reservation::where('user_id', $user->id)
                              ->latest() // Sama dengan orderBy('created_at', 'desc')
                              ->get();   // Atau gunakan ->paginate(10) jika data banyak

        // Pastikan view kamu namanya benar
        return view('history_reservations.index', compact('history'));
    }

    public function show($id)
    {
        $user = Auth::user();

        $reservation = Reservation::where('id', $id)
                                  ->where('user_id', $user->id)
                                  ->firstOrFail();

        return view('history_reservations.show', compact('reservation'));
    }
}