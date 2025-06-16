<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BukuTamu extends Model
{
    protected $table = 'buku_tamus';

    protected $fillable = [
    'name', 'nik', 'phone', 'pekerjaan', 'keperluan', 'alamat',
    'gender', 'identitas', 'bidang_id', 'rekomendasi_id', 'foto'
];

    public function bidang()
{
    return $this->belongsTo(Bidang::class, 'bidang_id');
}


    public function rekomendasi()
    {
        return $this->belongsTo(Rekomendasi::class);
    }
}
