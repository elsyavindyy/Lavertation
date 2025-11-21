<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Menampilkan form login.
     */
    public function showLoginForm()
    {
        if (Auth::check()) {
            return $this->redirectBasedOnRole(Auth::user());
        }
        return view('auth.login');
    }

    /**
     * Menangani proses login.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return $this->redirectBasedOnRole(Auth::user());
        }

        return back()->withErrors([
            'username' => 'Username atau password salah.',
        ])->onlyInput('username');
    }

    /**
     * Menangani proses logout.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    /**
     * Helper function: Menentukan tujuan redirect.
     */
    protected function redirectBasedOnRole($user)
    {
        // HAPUS baris $role = ... karena kolom 'role' TIDAK ADA di databasemu.
        // Langsung cek kolom 'is_admin'
        
        if ($user->is_admin == 1) {
            return redirect()->route('admin.dashboard'); 
        }

        // Default ke dashboard user biasa (jika is_admin = 0)
        return redirect()->route('dashboard');
    }
}