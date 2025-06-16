@extends('layouts.app')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold text-blue-800 mb-4">Hasil Survei</h2>
    <table class="min-w-full table-auto">
        <thead>
            <tr class="bg-gray-200 text-gray-700">
                <th class="px-4 py-2">Nama Responden</th>
                <th class="px-4 py-2">Pertanyaan</th>
                <th class="px-4 py-2">Jawaban</th>
                <th class="px-4 py-2">Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($surveyAnswers as $answer)
            <tr class="border-t">
                <td class="px-4 py-2">{{ $answer->survey->respondent_name }}</td>
                <td class="px-4 py-2">{{ $answer->question->text }}</td>
                <td class="px-4 py-2">{{ $answer->answer }}</td>
                <td class="px-4 py-2">{{ $answer->created_at->format('d M Y H:i') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
