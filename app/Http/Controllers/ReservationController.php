<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ReservationController extends Controller
{
    // Tampilkan halaman dashboard
    public function dashboard()
    {
        $today = Carbon::today();
        // Mengambil reservasi hari ini yang sudah disetujui
        $reservations = Reservation::whereDate('reservation_date', $today)
                                   ->where('status', 'approved') // Hanya tampilkan yang sudah pasti
                                   ->orderBy('time_start', 'asc')
                                   ->get();

        return view('dashboard', compact('reservations'));
    }

    public function index()
    {
        // Menampilkan reservasi milik pengguna yang sedang login
        $userReservations = Reservation::where('user_id', Auth::id())
                                       ->latest()
                                       ->paginate(10);

        return view('reservations.index', compact('userReservations'));
    }

    // Form input reservasi
    public function create()
    {
        return view('reservations.create');
    }

    // Simpan data reservasi
    public function store(Request $request)
    {
        // 1. Validasi input dasar
        $request->validate([
            'reason_for_reservation' => 'required|string|max:255',
            'reservation_date' => 'required|date|after_or_equal:today',
            'time_start' => 'required',
            'time_finish' => 'required|after:time_start',
            'floor' => 'required|string|max:255',
        ]);

        $timeStart = Carbon::parse($request->time_start);
        $timeFinish = Carbon::parse($request->time_finish);

       
        $existingReservation = Reservation::where('floor', $request->floor)
            ->where('status', 'approved') 
            ->where(function ($query) use ($timeStart, $timeFinish) {
              
                $query->where('time_start', '<', $timeFinish)
                      ->where('time_finish', '>', $timeStart);
            })
            ->first(); 

       
        if ($existingReservation) {
            return back()->withErrors([
                'time_start' => 'Maaf, jadwal pada lantai dan waktu tersebut sudah dipesan oleh orang lain.'
            ])->withInput(); 
        }
        
    
        Reservation::create([
            'user_id' => Auth::id(),
            'reason_for_reservation' => $request->reason_for_reservation,
            'reservation_date' => $request->reservation_date,
            'time_start' => $timeStart,
            'time_finish' => $timeFinish,
            'floor' => $request->floor,
            'status' => 'approved', 
        ]);

        return redirect()->route('reservations.index')->with('success', 'Reservasi berhasil dikonfirmasi!');
    }
}