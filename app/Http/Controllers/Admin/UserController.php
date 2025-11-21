<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // Menampilkan semua user
    public function index()
    {
        // Ambil data user terbaru dengan pagination
        $users = User::latest()->paginate(10);

        // PERBAIKAN DISINI:
        // Sesuai nama file di screenshot kamu: 'resources/views/admin/user.blade.php'
        // Maka panggilnya adalah 'admin.user'
        return view('admin.user', compact('users'));
    }

    // Hapus user
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Mencegah penghapusan akun Admin
        if ($user->is_admin == 1) {
            // Redirect kembali ke route index (pastikan nama route di web.php benar)
            return redirect()
                ->route('admin.users.index') 
                ->with('error', 'Akun Admin tidak boleh dihapus demi keamanan!');
        }

        $user->delete();

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User berhasil dihapus.');
    }
}