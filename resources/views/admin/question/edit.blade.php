@extends('layouts.app')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold text-blue-800 mb-4">Edit Pertanyaan Survei</h2>
    <form action="{{ route('admin.question.update', $question->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label class="block text-gray-700 mb-2">Pertanyaan</label>
            <input type="text" name="question_text" value="{{ $question->question_text }}" class="w-full p-2 border border-gray-300 rounded" required>
        </div>
        <button type="submit" class="bg-blue-800 text-white px-4 py-2 rounded hover:bg-blue-900">Update</button>
        <a href="{{ route('admin.question.index') }}" class="ml-2 text-gray-600 hover:underline">Batal</a>
    </form>
</div>
@endsection