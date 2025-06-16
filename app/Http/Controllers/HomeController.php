<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rekomendasi; // Sesuaikan model

class HomeController extends Controller
{
    public function index()
    {
        $rekomendasi = Rekomendasi::all();
        return view('home', compact('rekomendasi'));
    }
}

