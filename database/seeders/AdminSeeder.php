<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@desadigital.id'],
            [
                'name' => 'Admin',
                'password' => 'admin1234',
                'email_verified_at' => now(),
            ]
        );
    }
}