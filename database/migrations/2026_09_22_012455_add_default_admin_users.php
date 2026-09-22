<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    public function up(): void
    {
        // Insert admin user jika belum ada
        DB::table('users')->updateOrInsert(
            ['email' => 'admin@desadigital.id'],
            [
                'name' => 'Administrator Desa Digital',
                'password' => Hash::make('AdminDesa2024!'),
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('users')->updateOrInsert(
            ['email' => 'operator@desadigital.id'],
            [
                'name' => 'Operator Desa',
                'password' => Hash::make('Operator2024!'),
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }

    public function down(): void
    {
        // Optional: hapus user default jika rollback
        DB::table('users')->whereIn('email', [
            'admin@desadigital.id',
            'operator@desadigital.id'
        ])->delete();
    }
};