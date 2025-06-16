<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rekomendasi; // Import model Rekomendasi

class RekomendasiController extends Controller
{
    public function index()
    {
        $rekomendasi = Rekomendasi::all(); // Ambil semua data dari tabel
        return view('home', compact('rekomendasi')); // Kirim data ke view
    }
}


