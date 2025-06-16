<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Mengecek apakah pengguna sudah login
        if (!Auth::check()) {
            return redirect()->route('admin.dashboard'); // Arahkan ke halaman login jika belum login
        }

        return $next($request); // Lanjutkan jika pengguna sudah login
    }
}
