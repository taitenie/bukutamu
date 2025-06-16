<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    public function run()
    {
        Admin::create([
            'name' => 'AdminSatu',  
            'email' => 'dindik@gmail.com',
            'password' => bcrypt('dindikjatim'), // Jangan lupa untuk meng-hash password!
        ]);
    }
}

