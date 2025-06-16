<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Bidang;

class BidangSeeder extends Seeder
{
    public function run()
    {
        Bidang::create(['nama' => 'DAPODIK']);
        Bidang::create(['nama' => 'PPID']);
        Bidang::create(['nama' => 'Sekretariat']);
        Bidang::create(['nama' => 'Bidang SMA']);
        Bidang::create(['nama' => 'Bidang SMK']);
        Bidang::create(['nama' => 'Bidang PK-PLK']);
        Bidang::create(['nama' => 'Bidang GTK']);
        Bidang::create(['nama' => 'UPT TIKP']);
        Bidang::create(['nama' => 'UPT PTKK']);
    }
}
