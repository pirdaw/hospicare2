<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kunjungans', function (Blueprint $table) {
            $table->id();

            // relasi pasien
            $table->foreignId('pasien_id')
                  ->constrained('pasiens')
                  ->onDelete('cascade');

            // relasi poli
            $table->foreignId('poli_id')
                  ->constrained('polis')
                  ->onDelete('cascade');

            // petugas input
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->onDelete('cascade');

            $table->date('tanggal_kunjungan');

            $table->text('keluhan');

            $table->enum('jenis_pembayaran', [
                'umum',
                'bpjs',
                'swasta'
            ]);

            $table->string('rujukan_dari')->nullable();

            $table->enum('status', [
                'menunggu',
                'diperiksa',
                'selesai'
            ]);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kunjungans');
    }
};