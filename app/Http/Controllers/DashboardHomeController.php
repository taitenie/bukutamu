<?php

namespace App\Http\Controllers;

use App\Models\BukuTamu;
use App\Models\SurveyAnswer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;


class DashboardHomeController extends Controller
{
    public function index(Request $request)
    {
        $month = $request->get('month', Carbon::now()->month);
        $year = $request->get('year', Carbon::now()->year);

        // Statistik Buku Tamu
        $totalTamu = BukuTamu::count();
        $tamuBulanIni = BukuTamu::whereMonth('created_at', $month)->whereYear('created_at', $year)->count();
        $tamuHariIni = BukuTamu::whereDate('created_at', Carbon::today())->count();

        // Data bidang paling banyak dikunjungi
        $bidangs = BukuTamu::selectRaw('bidang_id, bidangs.nama as bidang, COUNT(*) as total')
            ->join('bidangs', 'buku_tamus.bidang_id', '=', 'bidangs.id')
            ->whereMonth('buku_tamus.created_at', $month)
            ->whereYear('buku_tamus.created_at', $year)
            ->groupBy('bidang_id', 'bidangs.nama')
            ->orderByDesc('total')
            ->get();

        $labelsBidang = $bidangs->pluck('bidang')->toArray();
        $dataBidang = $bidangs->pluck('total')->toArray();
        $mostVisitedBidang = $bidangs->first()?->bidang ?? 'Belum ada data';

        // Line Chart - Kunjungan per hari bulan ini
        $daysInMonth = Carbon::createFromDate($year, $month, 1)->daysInMonth;
        $labelsMonth = range(1, $daysInMonth);
        $dataMonth = [];

        foreach ($labelsMonth as $day) {
            $dataMonth[] = BukuTamu::whereYear('created_at', $year)
                ->whereMonth('created_at', $month)
                ->whereDay('created_at', $day)
                ->count();
        }

        // Survey Chart (Pie)
        $surveyAnswers = SurveyAnswer::with('question')
            ->whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->get();

        $surveyChartData = [];
        foreach ($surveyAnswers->groupBy('question_id') as $questionId => $answers) {
            $question = optional($answers->first()->question)->question_text ?? 'Pertanyaan Dihapus';
            $answerCounts = $answers->groupBy('answer')->map->count();
            $surveyChartData[$questionId] = [
                'question' => $question,
                'answers' => $answerCounts->toArray(),
            ];
        }



        $surveyLabels = $surveyAnswers->groupBy('answer')->keys()->toArray();
        $surveyData = $surveyAnswers->groupBy('answer')->map->count()->values()->toArray();

        return view('admin.dashboardhome', compact(
            'totalTamu', 'tamuBulanIni', 'tamuHariIni',
            'labelsBidang', 'dataBidang', 'mostVisitedBidang',
            'labelsMonth', 'dataMonth',
            'surveyChartData', 'surveyLabels', 'surveyData',
            'month', 'year'
        ));
    }

    public function filter(Request $request)
    {
        return redirect()->route('admin.dashboardhome', [
            'month' => $request->input('month'),
            'year' => $request->input('year')
        ]);
    }

    public function exportPDF(Request $request)
{
    $month = $request->get('month', date('m'));
    $year = $request->get('year', date('Y'));

    $totalTamu = BukuTamu::count();
    $tamuBulanIni = BukuTamu::whereMonth('created_at', $month)->whereYear('created_at', $year)->count();
    $tamuHariIni = BukuTamu::whereDate('created_at', today())->count();

    $bidangs = BukuTamu::selectRaw('bidang_id, bidangs.nama as bidang, COUNT(*) as total')
        ->join('bidangs', 'buku_tamus.bidang_id', '=', 'bidangs.id')
        ->whereMonth('buku_tamus.created_at', $month)
        ->whereYear('buku_tamus.created_at', $year)
        ->groupBy('bidang_id', 'bidangs.nama')
        ->orderByDesc('total')
        ->get();

    $labelsBidang = $bidangs->pluck('bidang')->toArray();
    $dataBidang = $bidangs->pluck('total')->toArray();
    $mostVisitedBidang = $bidangs->first()?->bidang ?? 'Belum ada data';

    // Line Chart
    $daysInMonth = Carbon::createFromDate($year, $month, 1)->daysInMonth;
    $labelsMonth = range(1, $daysInMonth);
    $dataMonth = [];
    foreach ($labelsMonth as $day) {
        $dataMonth[] = BukuTamu::whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->whereDay('created_at', $day)
            ->count();
    }

    // Survey Data
    $surveyAnswers = SurveyAnswer::with('question')
        ->whereMonth('created_at', $month)
        ->whereYear('created_at', $year)
        ->get();

    $surveyChartData = [];

    foreach ($surveyAnswers->groupBy('question_id') as $questionId => $answers) {
        $questionText = optional($answers->first()->question)->question_text ?? 'Pertanyaan Dihapus';
        $answerCounts = $answers->groupBy('answer')->map->count();
        $surveyChartData[$questionText] = $answerCounts->toArray();
    }

    $pdf = Pdf::loadView('admin.dashboard_pdf', compact(
        'month', 'year', 'totalTamu', 'tamuBulanIni', 'tamuHariIni',
        'labelsBidang', 'dataBidang', 'mostVisitedBidang',
        'labelsMonth', 'dataMonth',
        'surveyChartData'
    ));

    return $pdf->stream("laporan-dashboard-$month-$year.pdf");
}
}
