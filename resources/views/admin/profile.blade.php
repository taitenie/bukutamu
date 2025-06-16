@extends('layouts.app')

@section('content')
    <div class="p-8 bg-white rounded-xl shadow-lg max-w-3xl mx-auto mt-12">
        <h1 class="text-3xl font-extrabold text-blue-900 mb-10 border-b border-blue-200 pb-4">Profil Admin</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            {{-- Nama --}}
            <div>
                <label class="block text-sm font-semibold text-gray-500 mb-2 uppercase tracking-wide">Nama</label>
                <p class="text-lg text-gray-900 font-medium">{{ $admin->name }}</p>
            </div>

            {{-- Email --}}
            <div>
                <label class="block text-sm font-semibold text-gray-500 mb-2 uppercase tracking-wide">Email</label>
                <p class="text-lg text-gray-900 font-medium break-words">{{ $admin->email }}</p>
            </div>

            {{-- Password --}}
            <div>
                <label class="block text-sm font-semibold text-gray-500 mb-2 uppercase tracking-wide">Password</label>
                <p class="text-lg text-gray-900 font-mono select-none tracking-widest">••••••••</p>
            </div>

    
        </div>

        {{-- Tombol Aksi --}}
        <div class="mt-10 text-right">
            <a href="{{ route('admin.dataadmin.edit', $admin->id) }}"
               class="inline-flex items-center gap-2 bg-yellow-200 text-yellow-900 font-semibold text-sm px-5 py-2 rounded-lg border border-yellow-300 shadow-sm hover:bg-yellow-300 hover:shadow-md transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M15.232 5.232l3.536 3.536M9 13l6.586-6.586a2 2 0 112.828 2.828L11.828 15.828a2 2 0 01-1.414.586H7v-3a2 2 0 01.586-1.414z"/>
                </svg>
                Edit Profil
            </a>
        </div>
    </div>
@endsection
