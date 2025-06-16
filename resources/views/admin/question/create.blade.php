@extends('layouts.app')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold text-blue-800 mb-4">Tambah Pertanyaan Baru</h2>
    <form action="{{ route('admin.question.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label class="block text-gray-700 mb-2">Pertanyaan</label>
            <input type="text" name="question_text" class="w-full p-2 border border-gray-300 rounded" required>
        </div>
        <button type="submit" class="bg-blue-800 text-white px-4 py-2 rounded hover:bg-blue-900">Simpan</button>
        <a href="{{ route('admin.question.index') }}" class="ml-2 text-gray-600 hover:underline">Batal</a>
    </form>
</div>
@endsection
