<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use Carbon\Carbon;

class DashboardController extends Controller
{
    
    public function index(Request $request)
    {
        //Tentukan tanggal yang akan ditampilkan.
        $currentDate = $request->has('date') ? Carbon::parse($request->date) : Carbon::today();

        //Ambil data reservasi dari database
        $reservations = Reservation::with('user') 
                                   ->whereDate('reservation_date', $currentDate) 
                                   ->where('status', 'approved') 
                                   ->orderBy('time_start', 'asc') 
                                   ->get();

        //Siapkan tanggal untuk tombol navigasi "sebelumnya" dan "berikutnya"
        $previousDate = $currentDate->copy()->subDay()->toDateString();
        $nextDate = $currentDate->copy()->addDay()->toDateString();

        //Kirim semua data yang diperlukan ke view
        return view('dashboard', [
            'reservations' => $reservations,
            'currentDate' => $currentDate,
            'previousDate' => $previousDate,
            'nextDate' => $nextDate,
        ]);
    }
}