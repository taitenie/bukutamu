<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use Illuminate\Http\Request;

class SurveyWelcomeController extends Controller
{
    // Menampilkan halaman awal welcome
    public function welcome()
    {
        return view('surveywelcome');
    }

    // Menangani form submit dari welcome
    public function start(Request $request)
    {
        try {
            // Validasi input
            $validated = $request->validate([
                'nama' => 'required|string|max:255',
                'umur' => 'required|integer|min:1|max:120',
                'no_hp' => 'required|string|max:20',
                'jenis_kelamin' => 'required|in:L,P',
            ]);

            // Simpan data ke tabel surveys
            $survey = Survey::create([
                'nama' => $validated['nama'],
                'umur' => $validated['umur'],
                'no_hp' => $validated['no_hp'],
                'jenis_kelamin' => $validated['jenis_kelamin'],
            ]);

            session(['survey_id' => $survey->id]);

            // Redirect ke halaman pertanyaan pertama
            return redirect()->route('survey.question', ['step' => 1]);
        } catch (\Exception $e) {
            // Redirect ke halaman surveywelcome dengan pesan error
            return redirect()->route('survey.welcome')->with('error', $e->getMessage());
        }
    }

    // Menampilkan halaman survey form
    public function form()
    {
        // Cek apakah data visitor ada di session
        if (!session()->has('visitor')) {
            return redirect()->route('survey.welcome');
        }

        return view('survey.survey');
    }
}
