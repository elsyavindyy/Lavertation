<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Menampilkan semua user
    public function index()
    {
        $users = User::all();

        return view('admin.users.index', compact('users'));
    }

    // Hapus user
    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()
                ->route('admin.users.index')
                ->with('error', 'User tidak ditemukan.');
        }

        $user->delete();

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User berhasil dihapus.');
    }
}
