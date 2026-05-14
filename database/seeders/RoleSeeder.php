<?php

namespace Database\Seeders;

use App\Models\Role;
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

        // Buat akun admin default
        $adminRole = Role::where('nama_role', 'admin')->first();

        User::firstOrCreate(
            ['email' => 'admin@hospicare.id'],
            [
                'nama' => 'Administrator',
                'password' => Hash::make('admin123'),
                'role_id' => $adminRole->id,
            ]
        );

        $this->command->info('✅ Roles dan akun admin berhasil dibuat.');
        $this->command->info('   Email   : admin@hospicare.id');
        $this->command->info('   Password: admin123');
    }
}
