<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AdminLoginController extends Controller
{
    // Menampilkan Form Login Admin
    public function showLoginForm()
    {
        return view('admin.login'); // Pastikan view 'admin.login' ada
    }

    // Menangani Proses Login
    public function login(Request $request)
    {
        // Validasi input dari user
        $validatedData = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Periksa kredensial login
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Jika login berhasil, redirect ke halaman dashboard
            return redirect()->route('admin.dashboard');
        }

        // Jika login gagal, redirect kembali ke halaman login dengan pesan error
        return redirect()->back()->withInput()->with('error', 'Email atau password salah.');
    }

    // Logout Admin
    public function logout()
    {
        // Hapus session login
        Auth::logout();
        Session::flush(); // Clear the session data
        return redirect()->route('admin.login');
    }
}
