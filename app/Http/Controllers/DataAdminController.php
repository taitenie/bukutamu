<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DataAdminController extends Controller
{
    // Menampilkan daftar admin
    public function index(Request $request)
    {
        $admins = Admin::when($request->search, function ($query) use ($request) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
        })->paginate(10);

        return view('admin.dataadmin.index', compact('admins'));
    }

    // Menampilkan form untuk membuat admin baru
    public function create()
    {
        return view('admin.dataadmin.create');
    }

    // Menyimpan admin baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|min:8|confirmed',
        ]);

        Admin::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('admin.dataadmin.index')->with('success', 'Admin berhasil dibuat!');
    }

    // Menampilkan form untuk mengedit admin
    public function edit(Admin $dataadmin)
{
    return view('admin.dataadmin.edit', ['admin' => $dataadmin]);
}



    // Memperbarui data admin
    public function update(Request $request, Admin $dataadmin)
{
    // Validasi seperti biasa
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:admins,email,' . $dataadmin->id,
        'password' => 'nullable|min:8|confirmed',
    ]);

    $dataadmin->update([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'password' => $request->filled('password') ? Hash::make($validated['password']) : $dataadmin->password,
    ]);

    return redirect()->route('admin.dataadmin.index')->with('success', 'Admin berhasil diperbarui!');
}



    // Menghapus admin
    public function destroy(Admin $dataadmin)
    {
        $dataadmin->delete();

        return redirect()->route('admin.dataadmin.index')->with('success', 'Admin berhasil dihapus!');
    }

}
