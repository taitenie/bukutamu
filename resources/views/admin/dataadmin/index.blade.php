@extends('layouts.app')

@section('content')
<div class="p-6 bg-white rounded shadow-md max-w-7xl mx-auto mt-6">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Data Admin</h1>
        <a href="{{ route('admin.dataadmin.create') }}" class="bg-green-600 hover:bg-green-700 text-white text-sm px-4 py-2 rounded shadow">
            <i class="fas fa-plus mr-2"></i>Tambah Admin
        </a>
    </div>

    <form id="searchFormAdmin" method="GET" action="{{ route('admin.dataadmin.index') }}">
        <div class="flex flex-col md:flex-row justify-between items-center mb-4 gap-4 md:gap-0">
            <div class="relative w-full md:w-1/2">
                <input 
                    id="searchInputAdmin"
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Cari berdasarkan nama atau email..."
                    class="w-full border rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-600"
                >
                <button 
                    type="submit"
                    class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-blue-700 text-white px-3 py-1 text-sm rounded hover:bg-blue-800 transition"
                >
                    Search
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
                    <th class="py-3 px-6 text-left text-sm font-semibold">Email</th>
                    <th class="py-3 px-6 text-left text-sm font-semibold">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                @foreach ($admins as $index => $admin)
                <tr class="border-b hover:bg-gray-50 transition">
                    <td class="py-3 px-6 text-sm">{{ ($admins->currentPage() - 1) * $admins->perPage() + $index + 1 }}</td>
                    <td class="py-3 px-6 text-sm">{{ $admin->name }}</td>
                    <td class="py-3 px-6 text-sm">{{ $admin->email }}</td>
                    <td class="py-3 px-6 text-sm flex gap-2 flex-wrap">
                        {{-- Tombol Edit --}}
                        <a href="{{ route('admin.dataadmin.edit', $admin->id) }}"
                           class="flex items-center gap-1 bg-yellow-100 text-yellow-800 border border-yellow-300 px-3 py-1.5 rounded-lg text-xs hover:bg-yellow-200 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M15.232 5.232l3.536 3.536M9 13l6.586-6.586a2 2 0 112.828 2.828L11.828 15.828a2 2 0 01-1.414.586H7v-3a2 2 0 01.586-1.414z"/>
                            </svg>
                            Edit
                        </a>
                    
                        {{-- Tombol Hapus --}}
                        <form id="delete-admin-{{ $admin->id }}" action="{{ route('admin.dataadmin.destroy', $admin->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="button"
                                    onclick="confirmDeleteAdmin({{ $admin->id }})"
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

                @if ($admins->isEmpty())
                <tr>
                    <td colspan="4" class="text-center py-4 text-gray-500">Tidak ada data admin.</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $admins->withQueryString()->links() }}
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInputAdmin = document.getElementById('searchInputAdmin');
    const searchFormAdmin = document.getElementById('searchFormAdmin');

    if (searchInputAdmin && searchFormAdmin) {
        searchInputAdmin.addEventListener('input', function () {
            if (this.value.trim() === '') {
                searchFormAdmin.submit();
            }
        });
    }
});

// Fungsi SweetAlert untuk tombol Hapus Admin
function confirmDeleteAdmin(id) {
    Swal.fire({
        title: 'Yakin ingin menghapus admin ini?',
        text: 'Data admin akan dihapus secara permanen',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Hapus',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('delete-admin-' + id).submit();
        }
    });
}
</script>
@endpush
