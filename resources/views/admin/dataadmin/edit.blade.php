@extends('layouts.app')

@section('content')
    <div class="p-6 bg-white rounded shadow-md max-w-7xl mx-auto mt-6">
        <h1 class="text-2xl font-bold mb-4">Edit Admin</h1>

        {{-- Form Edit Admin --}}
        <form method="POST" action="{{ route('admin.dataadmin.update', $admin) }}">
            @csrf
            @method('PUT')

            <div class="space-y-4">
                {{-- Nama --}}
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
                    <input type="text" name="name" id="name"
                        class="mt-1 block w-full border rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-600"
                        value="{{ old('name', $admin->name) }}" required>
                </div>

                {{-- Email --}}
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" id="email"
                        class="mt-1 block w-full border rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-600"
                        value="{{ old('email', $admin->email) }}" required>
                </div>

                {{-- Password --}}
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password (opsional)</label>
                    <input type="password" name="password" id="password"
                        class="mt-1 block w-full border rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-600">
                </div>

                {{-- Konfirmasi Password --}}
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation"
                        class="mt-1 block w-full border rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-600">
                </div>
            </div>

            {{-- Tombol Aksi --}}
            <div class="flex items-center gap-4 mt-6">
                <button type="submit"
                    class="bg-blue-600 text-white px-4 py-2 rounded shadow hover:bg-blue-700">
                    Update
                </button>
                <a href="{{ route('admin.dataadmin.index') }}"
                    class="bg-gray-300 text-gray-800 px-4 py-2 rounded shadow hover:bg-gray-400">
                    Kembali
                </a>
            </div>
        </form>
    </div>
@endsection
