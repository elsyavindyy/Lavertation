<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // jangan lupa import DB

class DashboardController extends Controller
{
    public function index()
    {
        $reservations = DB::table('reservations')
            ->join('users', 'reservations.user_id', '=', 'users.id') // sesuaikan foreign key
            ->select(
                'reservations.*',
                'users.name as username'
            )
            ->orderBy('reservations.created_at', 'desc') // urut dari terbaru
            ->limit(3) // ambil 3 data terakhir
            ->get(); // ambil semua reservations

        return view('dashboard', compact('reservations'));
    }
}
