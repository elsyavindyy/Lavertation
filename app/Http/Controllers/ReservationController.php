<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ReservationController extends Controller
{
   
    public function index()
    {
        // Menampilkan reservasi milik pengguna yang sedang login
        $userReservations = Reservation::where('user_id', Auth::id())
                                       ->latest() // Menampilkan yang terbaru di atas
                                       ->paginate(10); // Membatasi 10 per halaman

        return view('reservations.index', compact('userReservations'));
    }


    public function store(Request $request)
    {
        // 1. Validasi input dari form HTML Anda
        $validatedData = $request->validate([
            'reason_for_reservation' => 'required|string|max:255',
            'reservation_date'       => 'required|date|after_or_equal:today',
            'time_start'             => 'required|date_format:H:i',
            'time_finish'            => 'required|date_format:H:i|after:time_start',
            'floor'                  => 'required|string|max:255',
        ]);

        $date = $validatedData['reservation_date'];
        $timeStart = $validatedData['time_start'];
        $timeFinish = $validatedData['time_finish'];

        // 2. Pengecekan konflik (jadwal bentrok)
        $existingReservation = Reservation::where('floor', $validatedData['floor'])
            ->where('date', $date) 
            ->where('status', 'approved') 
            ->where(function ($query) use ($timeStart, $timeFinish) {
                
                $query->where('time_start', '<', $timeFinish)
                      ->where('time_finish', '>', $timeStart);
            })
            ->first(); 

        // Jika ada jadwal bentrok, kembalikan error
        if ($existingReservation) {
            return back()->withErrors([
                'time_start' => 'Maaf, jadwal pada lantai dan waktu tersebut sudah dipesan (approved).'
            ])->withInput();
        }
        
        // 3. Simpan ke database
        Reservation::create([
            'user_id'     => Auth::id(), 
            'reason'      => $validatedData['reason_for_reservation'], 
            'date'        => $date,                                    
            'time_start'  => $timeStart,
            'time_finish' => $timeFinish,
            'floor'       => $validatedData['floor'],
            'status'      => 'pending', 
        ]);

        return redirect()->route('reservations.index')->with('success', 'Reservasi berhasil diajukan dan sedang menunggu persetujuan.');
    }
}