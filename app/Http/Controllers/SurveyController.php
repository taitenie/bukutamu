<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Survey;
use App\Models\SurveyAnswer;
use App\Models\Question;

class SurveyController extends Controller
{
    public function startSurvey(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'umur' => 'required|integer|min:1|max:120',
            'no_hp' => 'required|string|max:20',
            'jenis_kelamin' => 'required|in:L,P',
        ]);

        $survey = Survey::create([
            'nama' => $request->input('nama'),
            'umur' => $request->input('umur'),
            'no_hp' => $request->input('no_hp'),
            'jenis_kelamin' => $request->input('jenis_kelamin'),
        ]);

        session(['survey_id' => $survey->id]);

        return redirect()->route('survey.question', ['step' => 1]);
    }

    public function showQuestion(Request $request)
    {
        $questions = Question::orderBy('id')->get(['id', 'question_text']);
        $step = (int) $request->get('step', 1);

        if ($step < 1 || $step > $questions->count()) {
            return redirect()->route('survey.thankyou');
        }

        $currentQuestion = $questions[$step - 1];

        $surveyId = session('survey_id');
        if (!$surveyId) {
            return redirect()->route('survey.welcome')->with('error', 'Silakan mulai survei terlebih dahulu.');
        }

        $prevAnswer = SurveyAnswer::where('survey_id', $surveyId)
            ->where('question_id', $currentQuestion->id)
            ->value('answer');

        return view('survey', [
            'question' => $currentQuestion,
            'questions' => $questions,
            'step' => $step,
            'totalQuestions' => $questions->count(),
            'prevAnswer' => $prevAnswer,
        ]);
    }

    public function storeAnswer(Request $request)
    {
        try {
            $step = (int) $request->input('step');
            $action = $request->input('action'); // next, back, submit

            if ($action !== 'back') {
                $request->validate([
                    'jawaban' => 'required',
                ]);
            }

            $surveyId = session('survey_id');
            if (!$surveyId) {
                throw new \Exception('Silakan mulai survei terlebih dahulu.');
            }

            $questions = Question::orderBy('id')->get(['id', 'question_text']);
            if ($step < 1 || $step > $questions->count()) {
                throw new \Exception('Nomor pertanyaan tidak valid.');
            }

            $currentQuestion = $questions[$step - 1];

            if ($action !== 'back') {
                SurveyAnswer::updateOrCreate(
                    [
                        'survey_id' => $surveyId,
                        'question_id' => $currentQuestion->id,
                    ],
                    [
                        'answer' => $request->input('jawaban'),
                    ]
                );
            }

            if ($action === 'back') {
                $nextStep = max(1, $step - 1);
            } elseif ($action === 'submit') {
                return redirect()->route('survey.thankyou');
            } else {
                $nextStep = $step + 1;
            }

            return redirect()->route('survey.question', ['step' => $nextStep]);
        } catch (\Exception $e) {
            return redirect()->route('survey.welcome')->with('error', $e->getMessage());
        }
    }
}
