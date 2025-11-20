<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    /**
     * Menampilkan riwayat reservasi pengguna.
     */
    public function index(Request $request)
    {
        // 1. Mulai query dasar: hanya ambil data milik user yang sedang login
        $query = Reservation::where('user_id', Auth::id());

        // 2. LOGIKA PENCARIAN (SEARCH BAR)
        // Jika ada parameter 'search' di URL, tambahkan kondisi pencarian
        if ($request->has('search') && $request->search != '') {
            $searchTerm = $request->search;
            
            // Mencari di kolom 'reason', 'floor', atau 'status'
            // Menggunakan grouping (function($q)) agar logika OR tidak merusak filter user_id
            $query->where(function($q) use ($searchTerm) {
                $q->where('reason', 'like', '%' . $searchTerm . '%')
                  ->orWhere('floor', 'like', '%' . $searchTerm . '%')
                  ->orWhere('status', 'like', '%' . $searchTerm . '%');
            });
        }

        // 3. LOGIKA PENGURUTAN & PAGINATION
        $history = $query->orderBy('date', 'desc') // Urutkan dari tanggal terbaru
                         ->orderBy('time_start', 'desc') // Lalu urutkan jam
                         ->paginate(10);           // Batasi 10 per halaman

        // 4. Kirim data ke view
       return view('history.booked-history', compact('history'));
    }
}