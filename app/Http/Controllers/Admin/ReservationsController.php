<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservation;

class ReservationsController extends Controller
{
    /**
     * Menampilkan daftar semua reservasi (untuk Admin).
     */
    public function index(Request $request)
    {
        // Mulai query dengan memuat relasi 'user' agar bisa menampilkan nama pemohon
        $query = Reservation::with('user');

        // Filter berdasarkan Status (jika ada di request)
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter berdasarkan User ID (jika ingin melihat history user tertentu)
        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        // Urutkan dari yang terbaru & Pagination
        // Menggunakan latest() sama dengan orderBy('created_at', 'desc')
        $reservations = $query->latest()->paginate(10);

        // Kirim data ke view
        // Pastikan Anda sudah membuat view: resources/views/admin/reservations/index.blade.php
        // Atau sesuaikan jika Anda menggunakan satu view dashboard admin
        return view('admin.admindashboard', compact('reservations'));
    }

    /**
     * Menampilkan detail satu reservasi.
     */
    public function show($id)
    {
        $reservation = Reservation::with('user')->findOrFail($id);
        
        // Pastikan view ini ada: resources/views/admin/reservations/show.blade.php
        return view('admin.reservations.show', compact('reservation'));
    }

    /**
     * Memperbarui status reservasi (Approve / Reject).
     */
    public function updateStatus(Request $request, $id)
    {
        // Validasi input status
        $request->validate([
            'status' => 'required|in:approved,rejected,pending',
        ]);

        // Cari reservasi & update
        $reservation = Reservation::findOrFail($id);
        $reservation->status = $request->status;
        $reservation->save();

        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Status reservasi berhasil diperbarui!');
    }
}