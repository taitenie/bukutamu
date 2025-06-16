<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('buku_tamus', function (Blueprint $table) {
            // Drop foreign key lama (pastikan nama FK sesuai jika kamu rename)
            $table->dropForeign(['rekomendasi_id']);

            // Tambahkan foreign key yang benar
            $table->foreign('rekomendasi_id')->references('id')->on('rekomendasi');
        });
    }

    public function down(): void
    {
        Schema::table('buku_tamus', function (Blueprint $table) {
            $table->dropForeign(['rekomendasi_id']);
            $table->foreign('rekomendasi_id')->references('id')->on('rekomendasis');
        });
    }
};

