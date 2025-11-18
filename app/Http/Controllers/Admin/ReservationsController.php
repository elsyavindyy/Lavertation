<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservation;

class ReservationController extends Controller
{
    // Menampilkan semua reservation
    public function index(Request $request)
    {
        $query = Reservation::query();

        // Filter berdasarkan status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        // Filter berdasarkan user_id
        if ($request->has('user_id') && $request->user_id != '') {
            $query->where('user_id', $request->user_id);
        }

        // Urutkan berdasarkan tanggal terbaru
        $reservations = $query->orderBy('created_at', 'desc')->get();

        return view('admin.reservations.index', compact('reservations'));
    }

    // Menampilkan detail reservation
    public function show($id)
    {
        $reservation = Reservation::findOrFail($id);
        return view('admin.reservations.show', compact('reservation'));
    }

    // Optional: update status reservation
    public function updateStatus(Request $request, $id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->status = $request->status;
        $reservation->save();

        return redirect()->back()->with('success', 'Reservation status updated!');
    }
}
