<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    // 🔹 Tampilkan semua data reservasi
    public function index()
    {
        $reservations = Reservation::all();
        return view('reservations.index', compact('reservations'));
    }

    // 🔹 Form tambah reservasi baru
    public function create()
    {
        return view('reservations.create');
    }

    // 🔹 Simpan data baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|numeric',
            'reason_for_reservation' => 'required|string|max:255',
            'reservation_date' => 'required|date',
            'time_start' => 'required',
            'time_finish' => 'required',
            'floor' => 'required|string|max:50',
        ]);

        Reservation::create([
            'user_id' => $request->user_id,
            'reason_for_reservation' => $request->reason_for_reservation,
            'reservation_date' => $request->reservation_date,
            'time_start' => $request->time_start,
            'time_finish' => $request->time_finish,
            'floor' => $request->floor,
            'status' => 'pending', // default saat dibuat
        ]);

        return redirect()->route('reservations.index')->with('success', 'Reservasi berhasil ditambahkan!');
    }

    // 🔹 Form edit data
    public function edit($id)
    {
        $reservation = Reservation::findOrFail($id);
        return view('reservations.edit', compact('reservation'));
    }

    // 🔹 Update data di database
    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required|numeric',
            'reason_for_reservation' => 'required|string|max:255',
            'reservation_date' => 'required|date',
            'time_start' => 'required',
            'time_finish' => 'required',
            'floor' => 'required|string|max:50',
            'status' => 'required|in:pending,approved,rejected',
        ]);

        $reservation = Reservation::findOrFail($id);
        $reservation->update([
            'user_id' => $request->user_id,
            'reason_for_reservation' => $request->reason_for_reservation,
            'reservation_date' => $request->reservation_date,
            'time_start' => $request->time_start,
            'time_finish' => $request->time_finish,
            'floor' => $request->floor,
            'status' => $request->status,
        ]);

        return redirect()->route('reservations.index')->with('success', 'Reservasi berhasil diperbarui!');
    }

    // 🔹 Hapus data reservasi
    public function destroy($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->delete();

        return redirect()->route('reservations.index')->with('success', 'Reservasi berhasil dihapus!');
    }
}
