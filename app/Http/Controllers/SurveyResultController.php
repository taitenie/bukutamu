<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use App\Models\SurveyAnswer;
use App\Models\Question;
use Illuminate\Http\Request;

class SurveyResultController extends Controller
{
    public function index()
    {
        $surveys = Survey::orderBy('created_at', 'desc')->get();
        return view('admin.survey_results.index', compact('surveys'));
        
    }

    public function show($id)
{
    $survey = Survey::findOrFail($id);
    $answers = SurveyAnswer::where('survey_id', $id)
                ->with('question')
                ->orderBy('created_at', 'desc') // tambahkan ini
                ->get();

    return view('admin.survey_results.show', compact('survey', 'answers'));
}

}
