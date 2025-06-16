<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Notifications\DatabaseNotification;



class AdminController extends Controller
{
    //
    public function index()
{
    return view('admin.dashboard');
}
public function create()
    {
        return view('admins.create');
    }

    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'email' => 'required|email|unique:admins',
            'password' => 'required|min:8',
        ]);

        // Buat admin baru
        Admin::create([
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']), // Meng-hash password
        ]);

        return redirect()->route('admin.create')->with('success', 'Admin created successfully!');
    }
     public function getNotifications()
    {
        $notifications = DatabaseNotification::whereNull('read_at')
            ->orderByDesc('created_at')
            ->limit(10)
            ->get();

        return response()->json($notifications);
    }

}

