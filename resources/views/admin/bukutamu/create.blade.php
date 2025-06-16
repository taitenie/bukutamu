@extends('layouts.app')

@section('content')
    <div class="p-6 bg-white rounded shadow-md max-w-7xl mx-auto mt-6">
        <h1 class="text-2xl font-bold mb-4">Tambah Tamu Baru</h1>

        <form action="{{ route('bukutamu.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="name" class="block text-sm font-semibold">Nama</label>
                    <input type="text" name="name" id="name" class="border rounded-lg w-full px-4 py-2" required>
                </div>

                <div>
                    <label for="nik" class="block text-sm font-semibold">NIK</label>
                    <input type="text" name="nik" id="nik" class="border rounded-lg w-full px-4 py-2" required>
                </div>

                <div>
                    <label for="pekerjaan" class="block text-sm font-semibold">Pekerjaan</label>
                    <input type="text" name="pekerjaan" id="pekerjaan" class="border rounded-lg w-full px-4 py-2" required>
                </div>

                <div>
                    <label for="phone" class="block text-sm font-semibold">No. Telp</label>
                    <input type="text" name="phone" id="phone" class="border rounded-lg w-full px-4 py-2" required>
                </div>

                <div>
                    <label for="alamat" class="block text-sm font-semibold">Alamat</label>
                    <textarea name="alamat" id="alamat" class="border rounded-lg w-full px-4 py-2" required></textarea>
                </div>

                <div>
                    <label for="keperluan" class="block text-sm font-semibold">Keperluan</label>
                    <textarea name="keperluan" id="keperluan" class="border rounded-lg w-full px-4 py-2" required></textarea>
                </div>

                <div>
                    <label for="gender" class="block text-sm font-semibold">Jenis Kelamin</label>
                    <select name="gender" id="gender" class="border rounded-lg w-full px-4 py-2" required>
                        <option value="" disabled selected>Pilih Jenis Kelamin</option>
                        <option value="L">Laki-laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                </div>


                <div>
                    <label for="identitas" class="block text-sm font-semibold">Identitas (Opsional)</label>
                    <input type="text" name="identitas" id="identitas" class="border rounded-lg w-full px-4 py-2">
                </div>

                {{-- Bidang --}}
                <div>
                    <label for="bidang" class="block text-sm font-semibold">Bidang</label>
                    <select name="bidang" id="bidang" class="border rounded-lg w-full px-4 py-2" required>
                        @foreach($bidangs as $bidang)
                            <option value="{{ $bidang->id }}">{{ $bidang->nama }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Rekomendasi --}}
                <div>
                    <label for="rekomendasi" class="block text-sm font-semibold">Rekomendasi (Opsional)</label>
                    <select name="rekomendasi" id="rekomendasi" class="border rounded-lg w-full px-4 py-2">
                        <option value="">Tidak ada</option>
                        @foreach($rekomendasi as $item)
                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
                        @endforeach
                    </select>
                </div>


                <div>
                    <label for="foto" class="block text-sm font-semibold">Foto Identitas (Opsional)</label>
                    <input type="file" name="foto" id="foto" class="border rounded-lg w-full px-4 py-2">
                </div>
            </div>

            <div class="mt-4">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg">Simpan</button>
                <a href="{{ route('bukutamu.index') }}" class="bg-gray-300 text-gray-700 px-6 py-2 rounded-lg">Kembali</a>
            </div>
        </form>
    </div>
@endsection
