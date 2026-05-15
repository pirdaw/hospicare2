<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PoliSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('polis')->insert([
            [
                'nama_poli' => 'Poli Umum',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_poli' => 'Poli Gigi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_poli' => 'Poli Anak',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_poli' => 'Poli Kandungan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}