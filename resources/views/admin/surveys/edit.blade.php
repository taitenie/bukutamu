@extends('layouts.app')

@section('content')
<div class="p-6 max-w-3xl mx-auto bg-white shadow-md rounded-lg">
    <h2 class="text-2xl font-bold mb-4">Edit Pertanyaan Survei</h2>

    @if ($errors->any())
        <div class="bg-red-100 text-red-800 p-2 rounded mb-4">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.survei.update', $question->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')
        <div>
            <label class="block font-medium">Nomor Pertanyaan</label>
            <input type="number" name="question_number" value="{{ old('question_number', $question->question_number) }}" class="w-full border border-gray-300 p-2 rounded" required>
        </div>
        <div>
            <label class="block font-medium">Isi Pertanyaan</label>
            <textarea name="question" class="w-full border border-gray-300 p-2 rounded" rows="4" required>{{ old('question', $question->question) }}</textarea>
        </div>
        <div class="flex justify-end space-x-2">
            <a href="{{ route('admin.survei.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Batal</a>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Perbarui</button>
        </div>
    </form>
</div>
@endsection
