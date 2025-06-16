<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Tampilkan profil admin.
     */
   public function show()
{
    $admin = Auth::user(); // Sama dengan Auth::guard('web')->user()
    if (!$admin) {
        return redirect()->route('admin.login')->with('error', 'Anda belum login.');
    }
    return view('admin.profile', compact('admin'));
}



}
