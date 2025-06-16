@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto mt-10 bg-white rounded-lg shadow p-8">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Detail Tamu - {{ $guest->name }}</h2>
        <a href="{{ route('bukutamu.index') }}" class="text-blue-600 hover:underline">← Kembali</a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <p class="font-semibold">NIK:</p>
            <p class="text-gray-700">{{ $guest->nik }}</p>
        </div>
        <div>
            <p class="font-semibold">Nomor Telepon:</p>
            <p class="text-gray-700">{{ $guest->phone }}</p>
        </div>
        <div>
            <p class="font-semibold">Pekerjaan:</p>
            <p class="text-gray-700">{{ $guest->pekerjaan }}</p>
        </div>
        <div>
            <p class="font-semibold">Keperluan:</p>
            <p class="text-gray-700">{{ $guest->keperluan }}</p>
        </div>
        <div>
            <p class="font-semibold">Alamat:</p>
            <p class="text-gray-700">{{ $guest->alamat }}</p>
        </div>
        <div>
            <p class="font-semibold">Jenis Kelamin:</p>
            <p class="text-gray-700">{{ $guest->gender == 'L' ? 'Laki-laki' : 'Perempuan' }}</p>
        </div>
        <div>
            <p class="font-semibold">Identitas:</p>
            <p class="text-gray-700">{{ $guest->identitas }}</p>
        </div>
        {{-- Bidang --}}
            <div>
                <p class="font-semibold">Bidang:</p>
                <p class="text-gray-700">
                    {{ $guest->bidang ? $guest->bidang->nama : '-' }}
                </p>
            </div>

            {{-- Rekomendasi --}}
            <div>
                <p class="font-semibold">Rekomendasi:</p>
                <p class="text-gray-700">
                    {{ $guest->rekomendasi ? $guest->rekomendasi->nama : '-'}}
                </p>
            </div>

        @if($guest->foto)
        <div class="md:col-span-2">
            <p class="font-semibold mb-2">Foto Identitas:</p>
            <img src="{{ asset('storage/' . $guest->foto) }}" alt="Foto Identitas" class="w-64 rounded border shadow">
        </div>
        @endif
    </div>

    <div class="mt-8 flex items-center gap-4">
    {{-- Tombol Edit --}}
    <a href="{{ route('bukutamu.edit', $guest->id) }}"
       class="flex items-center gap-1 bg-yellow-100 text-yellow-800 border border-yellow-300 px-3 py-1.5 rounded-lg text-sm hover:bg-yellow-200 transition">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
             viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M15.232 5.232l3.536 3.536M9 13l6.586-6.586a2 2 0 112.828 2.828L11.828 15.828a2 2 0 01-1.414.586H7v-3a2 2 0 01.586-1.414z"/>
        </svg>
        Edit
    </a>

    {{-- Tombol Hapus --}}
    <form action="{{ route('bukutamu.destroy', $guest->id) }}" method="POST"
          onsubmit="return confirm('Yakin ingin menghapus data ini?');" class="inline">
        @csrf
        @method('DELETE')
        <button type="submit"
                class="flex items-center gap-1 bg-red-100 text-red-700 border border-red-300 px-3 py-1.5 rounded-lg text-sm hover:bg-red-200 transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                 viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M6 18L18 6M6 6l12 12"/>
            </svg>
            Hapus
        </button>
    </form>
</div>
@endsection
