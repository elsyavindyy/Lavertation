<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation; // pastikan model sudah ada
use Illuminate\Support\Facades\Auth;

class HistoryReservationController extends Controller
{
    // Menampilkan daftar history reservation
    public function index()
    {
        // ambil user yang login
        $user = Auth::user();

        // ambil reservations yang sudah selesai
        $history = Reservation::where('user_id', $user->id)
                              ->where('status', 'completed')
                              ->orderBy('created_at', 'desc')
                              ->get();

        return view('history_reservations.index', compact('history'));
    }

    // Menampilkan detail reservation tertentu
    public function show($id)
    {
        $user = Auth::user();

        $reservation = Reservation::where('id', $id)
                                  ->where('user_id', $user->id)
                                  ->firstOrFail();

        return view('history_reservations.show', compact('reservation'));
    }
}
