<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\BukuTamu;
use App\Models\SurveyAnswer;
use Carbon\Carbon;

class ExportController extends Controller
{
    public function exportDashboardPDF(Request $request)
    {
        $month = $request->get('month', Carbon::now()->month);
        $year = $request->get('year', Carbon::now()->year);

        $totalTamu = BukuTamu::count();
        $tamuBulanIni = BukuTamu::whereMonth('created_at', $month)
                                 ->whereYear('created_at', $year)
                                 ->count();
        $tamuHariIni = BukuTamu::whereDate('created_at', Carbon::today())->count();

        $bidangs = BukuTamu::selectRaw('bidangs.nama as bidang, COUNT(*) as total')
            ->join('bidangs', 'buku_tamus.bidang_id', '=', 'bidangs.id')
            ->whereMonth('buku_tamus.created_at', $month)
            ->whereYear('buku_tamus.created_at', $year)
            ->groupBy('bidangs.nama')
            ->orderByDesc('total')
            ->get();


        $labelsBidang = $bidangs->pluck('bidang');
        $dataBidang = $bidangs->pluck('total');

        $daysInMonth = Carbon::createFromDate($year, $month, 1)->daysInMonth;
        $labelsMonth = [];
        $dataMonth = [];

        for ($day = 1; $day <= $daysInMonth; $day++) {
            $labelsMonth[] = $day;
            $count = BukuTamu::whereYear('created_at', $year)
                ->whereMonth('created_at', $month)
                ->whereDay('created_at', $day)
                ->count();
            $dataMonth[] = $count;
        }

        $surveyAnswers = SurveyAnswer::with('question')
    ->whereMonth('created_at', $month)
    ->whereYear('created_at', $year)
    ->get();

$surveyStats = [];

foreach ($surveyAnswers->groupBy('question_id') as $questionId => $answers) {
    $questionText = optional($answers->first()->question)->question_text ?? 'Pertanyaan Dihapus';
    $answerCounts = $answers->groupBy('answer')->map->count()->toArray();
    $surveyStats[$questionText] = $answerCounts;
}


        $pdf = PDF::loadView('admin.export.dashboard_pdf', compact(
            'totalTamu', 'tamuBulanIni', 'tamuHariIni',
            'labelsBidang', 'dataBidang',
            'labelsMonth', 'dataMonth',
            'surveyStats',
            'month', 'year'
        ));

        return $pdf->download("dashboard_export_{$year}_{$month}.pdf");
    }
}
