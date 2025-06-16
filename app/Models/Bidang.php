<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bidang extends Model
{
    use HasFactory;

    protected $table = 'bidangs'; // ini sudah benar
    protected $fillable = ['nama']; // ini WAJIB agar mass assignment bisa dilakukan
    public function bukuTamus()
{
    return $this->hasMany(BukuTamu::class, 'bidang_id');
}

}

