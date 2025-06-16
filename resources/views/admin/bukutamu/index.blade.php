@extends('layouts.app')


@section('content')
    <div class="p-6 bg-white rounded shadow-md max-w-7xl mx-auto mt-6">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold">Buku Tamu</h1>
            <a href="{{ route('bukutamu.export', request()->all()) }}"
   class="bg-red-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-red-700 transition">
    Export PDF
</a>

            
        </div>

         <form id="searchForm" method="GET" action="{{ route('bukutamu.index') }}">
            <div class="flex flex-col md:flex-row justify-between items-center mb-4 gap-4 md:gap-0">
                <div class="relative w-full md:w-1/2">
                    <input id="searchInput" type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari berdasarkan nama, NIK, atau pekerjaan..."
                        class="w-full border rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-600">
                    <button type="submit"
                        class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-blue-700 text-white px-3 py-1 text-sm rounded hover:bg-blue-800 transition">
                        Search
                    </button>
                </div>

        <div class="flex space-x-2">
            @php
                $months = [
                    1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April',
                    5 => 'May', 6 => 'June', 7 => 'July', 8 => 'August',
                    9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December'
                ];
            @endphp


            <select name="month" class="border rounded-lg px-3 py-2 text-sm">
                <option value="">Semua Bulan</option>
                @foreach ($months as $key => $value)
                    <option value="{{ $key }}" {{ request('month') == $key ? 'selected' : '' }}>{{ $value }}</option>
                @endforeach
            </select>

            <select name="year" class="border rounded-lg px-3 py-2 text-sm">
                <option value="">Semua Tahun</option>
                @for ($y = now()->year; $y >= 2020; $y--)
                    <option value="{{ $y }}" {{ request('year') == $y ? 'selected' : '' }}>{{ $y }}</option>
                @endfor
            </select>

<button type="submit"
    class="bg-[#00218D] text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-900 transition">
    Filter
</button>    
    
</div>
    </div>
</form>

        <div class="overflow-x-auto rounded-lg shadow-md">
            <table class="min-w-full bg-white">
                <thead class="bg-blue-800 text-white">
                    <tr>
                        <th class="py-3 px-6 text-left text-sm font-semibold">No</th>
                        <th class="py-3 px-6 text-left text-sm font-semibold">Nama</th>
                        <th class="py-3 px-6 text-left text-sm font-semibold">NIK</th>
                        <th class="py-3 px-6 text-left text-sm font-semibold">Pekerjaan</th>
                        <th class="py-3 px-6 text-left text-sm font-semibold">No. Telp</th>
                        <th class="py-3 px-6 text-left text-sm font-semibold">Alamat</th>
                        <th class="py-3 px-6 text-left text-sm font-semibold">Keperluan</th>
                        <th class="py-3 px-6 text-left text-sm font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @foreach ($guests as $index => $guest)
                    <tr class="border-b hover:bg-gray-50 transition">
                        <td class="py-3 px-6 text-sm">{{ ($guests->currentPage() - 1) * $guests->perPage() + $index + 1 }}</td>
                        <td class="py-3 px-6 text-sm">{{ $guest->name }}</td>
                        <td class="py-3 px-6 text-sm">{{ $guest->nik }}</td>
                        <td class="py-3 px-6 text-sm">{{ $guest->pekerjaan }}</td>
                        <td class="py-3 px-6 text-sm">{{ $guest->phone }}</td>
                        <td class="py-3 px-6 text-sm">{{ $guest->alamat }}</td>
                        <td class="py-3 px-6 text-sm">{{ $guest->keperluan }}</td>
                        <td class="py-3 px-6 text-sm flex gap-2 flex-wrap">
                            {{-- Tombol Lihat --}}
                            <a href="{{ route('bukutamu.show', $guest->id) }}"
                               class="flex items-center gap-1 bg-blue-100 text-blue-700 border border-blue-300 px-3 py-1.5 rounded-lg text-xs hover:bg-blue-200 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                                Lihat
                            </a>
                        
                            {{-- Tombol Edit --}}
                            <a href="{{ route('bukutamu.edit', $guest->id) }}"
                               class="flex items-center gap-1 bg-yellow-100 text-yellow-800 border border-yellow-300 px-3 py-1.5 rounded-lg text-xs hover:bg-yellow-200 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M15.232 5.232l3.536 3.536M9 13l6.586-6.586a2 2 0 112.828 2.828L11.828 15.828a2 2 0 01-1.414.586H7v-3a2 2 0 01.586-1.414z"/>
                                </svg>
                                Edit
                            </a>
                        
                            {{-- Tombol Hapus --}}
                            <form id="delete-form-{{ $guest->id }}" action="{{ route('bukutamu.destroy', $guest->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="button"
                                    onclick="confirmDelete({{ $guest->id }})"
                                    class="flex items-center gap-1 bg-red-100 text-red-700 border border-red-300 px-3 py-1.5 rounded-lg text-xs hover:bg-red-200 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                                Hapus
                            </button>
                        </form>
                        </td>
                                         
                    </tr>
                    @endforeach

                    @if ($guests->isEmpty())
                    <tr>
                        <td colspan="8" class="text-center py-4 text-gray-500">Tidak ada data tamu.</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $guests->withQueryString()->links() }}
        </div>
    </div>
@endsection

@section('footer')
    <footer class="mt-12 text-center text-sm text-gray-500">
        &copy; {{ date('Y') }} Dinas Pendidikan Provinsi Jawa Timur. All rights reserved.
    </footer>
@endsection
@push('scripts')
<script>
    const searchInput = document.getElementById('searchInput');
    const searchForm = document.getElementById('searchForm');

    searchInput.addEventListener('input', function () {
        if (this.value.trim() === '') {
            searchForm.submit();
        }
    });
    function confirmDelete(id) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data ini akan dihapus secara permanen.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Hapus',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }
</script>
@endpush
