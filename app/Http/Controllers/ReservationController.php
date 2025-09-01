<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    // Lihat semua reservasi
    public function index()
    {
        $reservations = Reservation::with(['user', 'lab'])->get();
        return response()->json($reservations);
    }

    // Simpan reservasi baru
    public function store(Request $request)
    {
        $request->validate([
            'user_id'    => 'required|exists:users,id',
            'lab_id'     => 'required|exists:labs,id',
            'date'       => 'required|date',
            'start_time' => 'required',
            'end_time'   => 'required',
        ]);

        $reservation = Reservation::create([
            'user_id'    => $request->user_id,
            'lab_id'     => $request->lab_id,
            'date'       => $request->date,
            'start_time' => $request->start_time,
            'end_time'   => $request->end_time,
            'status'     => 'pending',
        ]);

        return response()->json([
            'message' => 'Reservasi berhasil dibuat',
            'data'    => $reservation,
        ], 201);
    }

    // Update status (misalnya admin approve/reject)
    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:approved,rejected',
        ]);

        $reservation = Reservation::findOrFail($id);
        $reservation->update([
            'status' => $request->status,
        ]);

        return response()->json([
            'message' => 'Status reservasi diperbarui',
            'data'    => $reservation,
        ]);
    }



    // Hapus reservasi
    public function destroy($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->delete();

        return response()->json(['message' => 'Reservasi dihapus']);
    }
}
