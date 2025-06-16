@extends('layouts.app')

@section('content')
<div class="bg-white p-6 rounded-lg shadow max-w-7xl mx-auto mt-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Data Survei</h2>
        <a href="{{ route('admin.question.create') }}" class="bg-green-600 hover:bg-green-700 text-white text-sm px-4 py-2 rounded shadow">
    <i class="fas fa-plus mr-2"></i>Tambah Pertanyaan
</a>


    </div>

    {{-- Tombol Tab --}}
    <div class="mb-6 flex flex-wrap gap-3">
        <button class="tab-button px-4 py-2 text-sm rounded-md font-medium" id="btn-tab1" onclick="showTab('tab1')">Master Pertanyaan</button>
        <button class="tab-button px-4 py-2 text-sm rounded-md font-medium" id="btn-tab2" onclick="showTab('tab2')">Hasil Survei</button>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    {{-- Tab 1: Master Pertanyaan --}}
    <div id="tab1" class="tab-content">
        <div class="overflow-x-auto rounded-lg shadow-md">
            <table class="min-w-full text-sm">
                <thead class="bg-blue-800 text-white">
                    <tr>
                        <th class="py-3 px-6 text-left">No</th>
                        <th class="py-3 px-6 text-left">Pertanyaan</th>
                        <th class="py-3 px-6 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @foreach($question as $index => $q)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="py-3 px-6">{{ $index + 1 }}</td>
                        <td class="py-3 px-6">{{ $q->question_text }}</td>
                        <td class="py-3 px-6 flex gap-2 flex-wrap">
                            {{-- Tombol Edit --}}
<a href="{{ route('admin.question.edit', $q->id) }}"
   class="flex items-center gap-1 bg-yellow-100 text-yellow-800 border border-yellow-300 px-3 py-1.5 rounded-lg text-xs hover:bg-yellow-200 transition">
    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
         viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
        <path stroke-linecap="round" stroke-linejoin="round"
              d="M15.232 5.232l3.536 3.536M9 13l6.586-6.586a2 2 0 112.828 2.828L11.828 15.828a2 2 0 01-1.414.586H7v-3a2 2 0 01.586-1.414z"/>
    </svg>
    Edit
</a>

{{-- Tombol Hapus --}}
<form id="delete-question-{{ $q->id }}" action="{{ route('admin.question.destroy', $q->id) }}" method="POST" class="inline">
    @csrf
    @method('DELETE')
    <button type="button"
            onclick="confirmDeleteQuestion({{ $q->id }})"
            class="flex items-center gap-1 bg-red-100 text-red-700 border border-red-300 px-3 py-1.5 rounded-lg text-xs hover:bg-red-200 transition">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
             viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
        </svg>
        Hapus
    </button>
</form>
                        </td>
                    </tr>
                    @endforeach
                    @if($question->isEmpty())
                    <tr>
                        <td colspan="3" class="text-center py-4 text-gray-500">Belum ada pertanyaan tersedia.</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    {{-- Tab 2: Hasil Survei --}}
    <div id="tab2" class="tab-content hidden">
        <div class="overflow-x-auto rounded-lg shadow-md">
            <table class="min-w-full text-sm">
                <thead class="bg-blue-800 text-white">
                    <tr>
                        <th class="py-3 px-6 text-left">No</th>
                        <th class="py-3 px-6 text-left">Nama Pengunjung</th>
                        <th class="py-3 px-6 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @foreach ($survey as $index => $data)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="py-3 px-6">{{ $index + 1 }}</td>
                        <td class="py-3 px-6">{{ $data->nama }}</td>
                        <td class="py-3 px-6 text-center">
                            <button class="btn-view" data-bs-toggle="modal" data-bs-target="#modalJawaban{{ $data->id }}">
                                View
                            </button>
                        </td>
                    </tr>
                    {{-- Modal Jawaban --}}
                    <div class="modal fade" id="modalJawaban{{ $data->id }}" tabindex="-1">
                        <div class="modal-dialog modal-lg modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Jawaban - {{ $data->nama }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <ul class="list-disc list-inside space-y-2">
                                        @foreach ($data->answers as $answer)
                                            <li>
                                                <strong>Pertanyaan:</strong> {{ $answer->question->question_text ?? '-' }}<br>
                                                <strong>Jawaban:</strong> {{ $answer->answer }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn-close-modal" data-bs-dismiss="modal">Tutup</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @if($survey->isEmpty())
                    <tr>
                        <td colspan="3" class="text-center py-4 text-gray-500">Belum ada data survei.</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function showTab(tabId) {
        ['tab1', 'tab2'].forEach(id => {
            document.getElementById(id).classList.add('hidden');
        });
        document.getElementById(tabId).classList.remove('hidden');
        document.querySelectorAll('.tab-button').forEach(btn => btn.classList.remove('active'));
        document.getElementById('btn-' + tabId).classList.add('active');
    }

    document.addEventListener('DOMContentLoaded', function () {
        showTab('tab1');
    });

    function confirmDeleteQuestion(id) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Pertanyaan ini akan dihapus secara permanen",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Hapus',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-question-' + id).submit();
            }
        });
    }
</script>
@endsection

@section('styles')
<style>
    .tambah-button {
        background-color: #00AA5B;
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 0.5rem;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
    }

    .tambah-button:hover {
        background-color: #009250;
    }

    .tab-button {
        background-color: #f3f4f6;
        color: #1f2937;
        transition: all 0.2s;
        border-radius: 0.375rem;
    }

    .tab-button.active, .tab-button:hover {
        background-color: #2563eb;
        color: white;
    }



    .btn-view {
        background-color: #2563eb;
        color: white;
        padding: 0.25rem 0.75rem;
        font-size: 0.75rem;
        border-radius: 0.375rem;
    }

    .btn-close-modal {
        background-color: #e5e7eb;
        padding: 0.5rem 1rem;
        border-radius: 0.375rem;
    }
</style>
@endsection
