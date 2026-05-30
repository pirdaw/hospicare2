<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void
  {
    Schema::create('pemeriksaans', function (Blueprint $table) {

      $table->id();

      $table->foreignId('kunjungan_id')
        ->constrained('kunjungans')
        ->onDelete('cascade');

      $table->foreignId('tenaga_kesehatan_id')
        ->constrained('tenaga_kesehatans')
        ->onDelete('cascade');

      // nullable() harus SETELAH constrained() agar tidak error di beberapa driver
      $table->foreignId('poli_id')
        ->nullable()
        ->constrained('polis')
        ->nullOnDelete();

      $table->text('subjective')->nullable();
      $table->text('objective')->nullable();

      $table->float('suhu')->nullable();
      $table->string('tensi')->nullable();
      $table->integer('nadi')->nullable();
      $table->integer('respirasi')->nullable();

      $table->text('assessment')->nullable();
      $table->text('plan')->nullable();

      $table->dateTime('tanggal_pemeriksaan');

      $table->timestamps();
    });
  }

  public function down(): void
  {
    Schema::dropIfExists('pemeriksaans');
  }
};
