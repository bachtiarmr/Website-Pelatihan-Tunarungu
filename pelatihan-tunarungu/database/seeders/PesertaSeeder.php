<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class PesertaSeeder extends Seeder
{
    public function run(): void
    {
        $peserta = [
            [
                'name' => 'Danilo',
                'email' => 'danilo@gmail.com',
                'nomor_hp' => '081234567890',
                'password' => Hash::make('peserta123'),
                'role' => 'peserta',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Deankt',
                'email' => 'dean@gmail.com',
                'nomor_hp' => '081234567891',
                'password' => Hash::make('peserta123'),
                'role' => 'peserta',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Paler',
                'email' => 'paler@gmail.com',
                'nomor_hp' => '081234567892',
                'password' => Hash::make('peserta123'),
                'role' => 'peserta',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Danil Akbar',
                'email' => 'danil@gmail.com',
                'nomor_hp' => '081234567893',
                'password' => Hash::make('peserta123'),
                'role' => 'peserta',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($peserta as $data) {
            DB::table('users')->updateOrInsert(
                ['email' => $data['email']],
                $data
            );
        }
    }
}