<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory;

   // Model Admin menggunakan tabel 'admins'
   protected $table = 'admins';  

   // Jika Anda ingin menggunakan email dan password untuk autentikasi
   protected $fillable = [
       'name','email', 'password',
   ];

   // Untuk memastikan Laravel mengenali bahwa password menggunakan hash
   protected $hidden = [
       'password', 'remember_token',
   ];
}
