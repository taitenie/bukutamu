@extends('layouts.app')

@section('content')
<div class="p-6 bg-white rounded shadow-md max-w-7xl mx-auto mt-6">
    <h1 class="text-2xl font-bold mb-4">Edit Tamu</h1>

    <form action="{{ route('bukutamu.update', $guest->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="name" class="block text-sm font-semibold">Nama</label>
                <input type="text" name="name" id="name" class="border rounded-lg w-full px-4 py-2" value="{{ old('name', $guest->name) }}" required>
            </div>

            <div>
                <label for="nik" class="block text-sm font-semibold">NIK</label>
                <input type="text" name="nik" id="nik" class="border rounded-lg w-full px-4 py-2" value="{{ old('nik', $guest->nik) }}" required>
            </div>

            <div>
                <label for="pekerjaan" class="block text-sm font-semibold">Pekerjaan</label>
                <input type="text" name="pekerjaan" id="pekerjaan" class="border rounded-lg w-full px-4 py-2" value="{{ old('pekerjaan', $guest->pekerjaan) }}">
            </div>

            <div>
                <label for="phone" class="block text-sm font-semibold">No. Telp</label>
                <input type="text" name="phone" id="phone" class="border rounded-lg w-full px-4 py-2" value="{{ old('phone', $guest->phone) }}">
            </div>

            <div>
                <label for="alamat" class="block text-sm font-semibold">Alamat</label>
                <textarea name="alamat" id="alamat" class="border rounded-lg w-full px-4 py-2">{{ old('alamat', $guest->alamat) }}</textarea>
            </div>

            <div>
                <label for="keperluan" class="block text-sm font-semibold">Keperluan</label>
                <textarea name="keperluan" id="keperluan" class="border rounded-lg w-full px-4 py-2">{{ old('keperluan', $guest->keperluan) }}</textarea>
            </div>

            <div>
                <label for="gender" class="block text-sm font-semibold">Jenis Kelamin</label>
                <select name="gender" id="gender" class="border rounded-lg w-full px-4 py-2" required>
                    <option value="L" {{ old('gender', $guest->gender) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="P" {{ old('gender', $guest->gender) == 'P' ? 'selected' : '' }}>Perempuan</option>
                </select>
            </div>

            <div>
                <label for="identitas" class="block text-sm font-semibold">Jenis Identitas</label>
                <input type="text" name="identitas" id="identitas" class="border rounded-lg w-full px-4 py-2" value="{{ old('identitas', $guest->identitas) }}">
            </div>

            <div>
                <label for="bidang" class="block text-sm font-semibold">Bidang</label>
                <select name="bidang" id="bidang" class="border rounded-lg w-full px-4 py-2" required>
                    @foreach($bidangs as $bidang)
                        <option value="{{ $bidang->id }}" {{ old('bidang', $guest->bidang_id) == $bidang->id ? 'selected' : '' }}>
                            {{ $bidang->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="rekomendasi" class="block text-sm font-semibold">Rekomendasi</label>
                <select name="rekomendasi" id="rekomendasi" class="border rounded-lg w-full px-4 py-2">
                    <option value="">-</option>
                    @foreach($rekomendasi as $rek)
                        <option value="{{ $rek->id }}" {{ old('rekomendasi', $guest->rekomendasi_id) == $rek->id ? 'selected' : '' }}>
                            {{ $rek->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="md:col-span-2">
                <label for="foto" class="block text-sm font-semibold">Foto Identitas (upload baru jika ingin mengganti)</label>

                <!-- Input file untuk upload -->
                <input type="file" id="foto-input" class="border rounded-lg w-full px-4 py-2" accept="image/*">

                <!-- Hidden input untuk base64 -->
                <input type="hidden" name="foto" id="foto-base64">

                <!-- Preview gambar -->
                <div class="mt-3">
                    @if($guest->foto)
                        <p class="text-sm mb-2">Foto saat ini:</p>
                        <img src="{{ asset('storage/' . $guest->foto) }}"
                             id="current-foto"
                             class="w-32 h-32 object-cover rounded shadow border"
                             alt="Foto Identitas">
                    @endif

                    <!-- Preview foto baru -->
                    <div id="new-foto-preview" class="hidden mt-2">
                        <p class="text-sm mb-2">Preview foto baru:</p>
                        <img id="new-foto-img" class="w-32 h-32 object-cover rounded shadow border" alt="Preview">
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-6 flex gap-4">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition duration-200">
                Update
            </button>
            <a href="{{ route('bukutamu.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-2 rounded-lg transition duration-200">
                Kembali
            </a>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const fileInput = document.getElementById('foto-input');
    const base64Input = document.getElementById('foto-base64');
    const previewContainer = document.getElementById('new-foto-preview');
    const previewImage = document.getElementById('new-foto-img');
    const currentFoto = document.getElementById('current-foto');

    fileInput.addEventListener('change', function (e) {
        const file = e.target.files[0];

        if (!file) return;

        if (!file.type.startsWith('image/')) {
            alert('Hanya file gambar yang diperbolehkan!');
            return;
        }

        if (file.size > 5 * 1024 * 1024) {
            alert('Ukuran maksimal 5MB!');
            return;
        }

        const reader = new FileReader();
        reader.onload = function (event) {
            const base64 = event.target.result;
            base64Input.value = base64;

            previewImage.src = base64;
            previewContainer.classList.remove('hidden');

            if (currentFoto) {
                currentFoto.style.opacity = '0.4';
            }
        };
        reader.readAsDataURL(file);
    });
});
</script>
@endpush
