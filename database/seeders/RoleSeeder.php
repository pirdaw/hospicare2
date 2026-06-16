<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\TenagaKesehatan;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // Buat 4 role
        $roles = [
            ['nama_role' => 'admin'],
            ['nama_role' => 'petugas_pendaftaran'],
            ['nama_role' => 'tenaga_kesehatan'],
            ['nama_role' => 'kepala_rm'],
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate(['nama_role' => $role['nama_role']]);
        }

        // Akun default per role
        $accounts = [
            [
                'role' => 'admin',
                'nama' => 'Administrator',
                'email' => 'admin@hospicare.id',
                'password' => 'admin123',
            ],
            [
                'role' => 'petugas_pendaftaran',
                'nama' => 'Petugas Pendaftaran',
                'email' => 'petugas@hospicare.id',
                'password' => 'petugas123',
            ],
            [
                'role' => 'tenaga_kesehatan',
                'nama' => 'Tenaga Kesehatan',
                'email' => 'nakes@hospicare.id',
                'password' => 'nakes123',
            ],
            [
                'role' => 'kepala_rm',
                'nama' => 'Kepala Rekam Medis',
                'email' => 'kepalarm@hospicare.id',
                'password' => 'kepalarm123',
            ],
        ];

        foreach ($accounts as $acc) {
            $role = Role::where('nama_role', $acc['role'])->first();

            User::firstOrCreate(
                ['email' => $acc['email']],
                [
                    'nama' => $acc['nama'],
                    'password' => Hash::make($acc['password']),
                    'role_id' => $role->id,
                ]
            );
        }

        // Buat record tenaga_kesehatans untuk user nakes jika belum ada
        $nakesUser = User::where('email', 'nakes@hospicare.id')->first();
        if ($nakesUser) {
            TenagaKesehatan::firstOrCreate(
                ['user_id' => $nakesUser->id],
                [
                    'jenis' => 'dokter',
                    'poli_id' => null,
                    'no_str' => null,
                ]
            );
        }

        $this->command->info('Roles dan akun default berhasil dibuat:');
        $this->command->table(
            ['Role', 'Email', 'Password'],
            [
                ['Admin', 'admin@hospicare.id', 'admin123'],
                ['Petugas Pendaftaran', 'petugas@hospicare.id', 'petugas123'],
                ['Tenaga Kesehatan', 'nakes@hospicare.id', 'nakes123'],
                ['Kepala RM', 'kepalarm@hospicare.id', 'kepalarm123'],
            ]
        );
    }
}