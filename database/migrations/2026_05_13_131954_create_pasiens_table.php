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
    Schema::create('pasiens', function (Blueprint $table) {
        $table->id();
        $table->string('nama');
        $table->string('nik', 16)->unique();
        $table->integer('umur');
        $table->enum('jenis_kelamin', ['L', 'P']);
        $table->enum('golongan_darah', [
            'A',
            'B',
            'AB',
            'O'
            ])->nullable();
        $table->string('agama');
        $table->text('alamat');
        $table->string('pekerjaan');
        $table->string('no_hp');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pasiens');
    }
};
