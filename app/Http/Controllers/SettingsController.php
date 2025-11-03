<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
{
    /**
     * Menampilkan halaman pengaturan (Settings).
     * * @return \Illuminate\View\View
     */
    public function index()
    {
        // Secara umum, halaman pengaturan mungkin tidak memerlukan data khusus,
        // tetapi kita bisa mengirimkan data pengguna yang sedang login jika diperlukan.
        $user = Auth::user();

        return view('settings.index', compact('user'));
    }

    /**
     * Menyimpan atau memperbarui pengaturan (jika diperlukan di masa depan).
     * * public function update(Request $request)
     * {
     * // Logika untuk memproses dan menyimpan perubahan pengaturan di sini.
     * // Contoh: validasi dan update user preferences.
     * * return redirect()->route('settings.index')->with('success', 'Pengaturan berhasil diperbarui.');
     * }
     */
}