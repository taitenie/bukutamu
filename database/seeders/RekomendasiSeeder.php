<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Rekomendasi;

class RekomendasiSeeder extends Seeder
{
    public function run()
    {
        Rekomendasi::create(['nama' => 'Cabdin Wilayah Pasuruan']);
        Rekomendasi::create(['nama' => 'Cabdin Wilayah Probolinggo']);
        Rekomendasi::create(['nama' => 'Cabdin Wilayah Bondowoso']);
        Rekomendasi::create(['nama' => 'Cabdin Wilayah Jember']);
        Rekomendasi::create(['nama' => 'Cabdin Kabupaten Banyuwangi']);
        Rekomendasi::create(['nama' => 'Cabdin Kabupaten Malang']);
        Rekomendasi::create(['nama' => 'Cabdin Kota Malang']);
        Rekomendasi::create(['nama' => 'Cabdin Wilayah Blitar']);
        Rekomendasi::create(['nama' => 'Cabdin Wilayah Tulungagung']);
        Rekomendasi::create(['nama' => 'Cabdin Wilayah Kediri']);
        Rekomendasi::create(['nama' => 'Cabdin Kabupaten Nganjuk']);
        Rekomendasi::create(['nama' => 'Cabdin Wilayah Madiun']);
        Rekomendasi::create(['nama' => 'Cabdin Wilayah Ponorogo']);
        Rekomendasi::create(['nama' => 'Cabdin Kabupaten Pacitan']);
        Rekomendasi::create(['nama' => 'Cabdin Wilayah Bojonegoro']);
        Rekomendasi::create(['nama' => 'Cabdin Kabupaten Lamongan']);
        Rekomendasi::create(['nama' => 'Cabdin Kabupaten Gresik']);
        Rekomendasi::create(['nama' => 'Cabdin Wilayah Sidoarjo']);
        Rekomendasi::create(['nama' => 'Cabdin Kabupaten Jombang']);
        Rekomendasi::create(['nama' => 'Cabdin Kabupaten dan Kota Mojokerto']);
        Rekomendasi::create(['nama' => 'Cabdin Kabupaten Bangkalan']);
        Rekomendasi::create(['nama' => 'Cabdin Kabupaten Sampang']);
        Rekomendasi::create(['nama' => 'Cabdin Kabupaten Pamekasan']);
        Rekomendasi::create(['nama' => 'Cabdin Kabupaten Sumenep']);
    }
}

