<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Periksa apakah pengguna sudah login
        if (!Auth::check()) {
            return redirect()->route('admin.login')->with('error', 'Please log in first!');
        }

        // Jika sudah login, arahkan ke halaman dashboard
        return view('admin.dashboard');
    }
}
