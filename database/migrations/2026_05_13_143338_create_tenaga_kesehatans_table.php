<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tenaga_kesehatans', function (Blueprint $table) {
            $table->id();

            // relasi ke akun user
            $table->foreignId('user_id')
                  ->unique()
                  ->constrained('users')
                  ->onDelete('cascade');

            // jenis tenaga kesehatan
            $table->enum('jenis', [
                'dokter',
                'perawat',
                'bidan',
                'lainnya'
            ]);

            // poli bisa kosong
            $table->foreignId('poli_id')
                  ->nullable()
                  ->constrained('polis')
                  ->onDelete('set null');

            // nomor STR
            $table->string('no_str')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tenaga_kesehatans');
    }
};