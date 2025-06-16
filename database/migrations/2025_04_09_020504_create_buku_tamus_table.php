<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBukuTamusTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('buku_tamus', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('nik');
            $table->string('phone');
            $table->string('pekerjaan');
            $table->text('keperluan');
            $table->string('alamat');
            $table->enum('gender', ['Laki-laki', 'Perempuan']);
            $table->enum('identitas', ['KTP', 'SIM', 'Paspor']);
            $table->unsignedBigInteger('bidang_id');
            $table->unsignedBigInteger('rekomendasi_id')->nullable();
            $table->string('foto'); // lokasi file foto
            $table->timestamps();

            $table->foreign('bidang_id')->references('id')->on('bidangs');
            $table->foreign('rekomendasi_id')->references('id')->on('rekomendasis');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('buku_tamus');
    }
}