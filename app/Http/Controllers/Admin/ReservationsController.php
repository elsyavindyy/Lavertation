<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservation;

class ReservationsController extends Controller
{
    /**
     * Menampilkan daftar semua reservasi.
     */
    public function index(Request $request)
    {
        $query = Reservation::with('user');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        $reservations = $query->latest()->paginate(10);

        return view('admin.admindashboard', compact('reservations'));
    }

    /**
     * Menampilkan detail satu reservasi.
     */
    public function show($id)
    {
        $reservation = Reservation::with('user')->findOrFail($id);
        return view('admin.reservations.show', compact('reservation'));
    }

    /**
     * Memperbarui status reservasi (Approve / Reject).
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:approved,rejected,pending',
        ]);

        $reservation = Reservation::findOrFail($id);
        $reservation->status = $request->status;
        $reservation->save();

        return redirect()->back()->with('success', 'Status reservasi berhasil diperbarui!');
    }

    /**
     * --- TAMBAHAN BARU: MENGHAPUS DATA ---
     */
    public function destroy($id)
    {
        // Cari data
        $reservation = Reservation::findOrFail($id);
        
        // Hapus data
        $reservation->delete();

        // Kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Data reservasi berhasil dihapus!');
    }
}