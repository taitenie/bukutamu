<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Survey;
use App\Models\SurveyAnswer;

class QuestionController extends Controller
{
    
  public function index()
{
    $question = Question::all();
    $surveyAnswers = SurveyAnswer::with(['survey', 'question'])->get();

    // Ambil semua survei dan relasi jawaban + pertanyaannya
    $survey = Survey::with('answers.question')->get();

    return view('admin.question.index', compact('question', 'surveyAnswers', 'survey'));
}

    public function edit($id)
    {
        $question = Question::findOrFail($id);
        return view('admin.question.edit', compact('question'));
    }
public function create()
{
    return view('admin.question.create');
}

    public function update(Request $request, $id)
{
    $request->validate([
        'question_text' => 'required|string|max:255',
    ]);

    $question = Question::findOrFail($id);
    $question->update([
        'question_text' => $request->input('question_text'),
    ]);

    return redirect()->route('admin.question.index')->with('success', 'Pertanyaan berhasil diperbarui.');
}
public function destroy($id)
{
    $question = Question::findOrFail($id);
    $question->delete();

    return redirect()->route('admin.question.index')->with('success', 'Pertanyaan berhasil dihapus.');
}
public function store(Request $request)
{
    // Validasi input
    $request->validate([
        'question_text' => 'required|string|max:255',
    ]);

    // Simpan ke database
    Question::create([
        'question_text' => $request->input('question_text'),
    ]);

    // Redirect kembali ke halaman index dengan pesan sukses
    return redirect()->route('admin.question.index')->with('success', 'Pertanyaan berhasil ditambahkan.');
}


}
