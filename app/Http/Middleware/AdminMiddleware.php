<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Cek apakah user sudah login
        if (!Auth::check()) {
            return redirect('/login');
        }

        // 2. PERBAIKAN DISINI:
        // Kita cek kolom 'is_admin'. 
        // Jika nilainya BUKAN 1 (misalnya 0), maka dia ditendang.
        if (Auth::user()->is_admin != 1) {
            
            // Jika bukan admin, kembalikan ke dashboard biasa
            return redirect('/dashboard')->with('error', 'Anda tidak memiliki akses admin.');
        }

        // 3. Jika lolos (is_admin == 1), izinkan masuk
        return $next($request);
    }
}