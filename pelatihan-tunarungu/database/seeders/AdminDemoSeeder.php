<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminDemoSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'admin',
                'password' => Hash::make('Admin12345!'),
                'role' => 'admin',
            ]
        );

        $this->command->info('Admin berhasil dibuat!');
        $this->command->info('Username: admin');
        $this->command->info('Email: admin@gmail.com');
        $this->command->info('Password: Admin12345!');
    }
}

