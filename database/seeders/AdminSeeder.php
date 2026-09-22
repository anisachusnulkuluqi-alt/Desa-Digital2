<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // updateOrCreate artinya: jika email sudah ada, update passwordnya. Jika belum, buat baru.
        User::updateOrCreate(
            ['email' => 'admin@desadigital.id'], 
            [
                'name' => 'Admin Desa Digital',
                'password' => Hash::make('admin1234'), // Ganti password sesuka Anda
                'email_verified_at' => now(),
            ]
        );
    }
}