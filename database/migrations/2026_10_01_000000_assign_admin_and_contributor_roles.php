<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('users')->where('email', 'admin@desadigital.id')->update(['role' => 'admin']);
        DB::table('users')->where('email', 'operator@desadigital.id')->update(['role' => 'kontributor']);
    }

    public function down(): void
    {
        DB::table('users')->whereIn('email', [
            'admin@desadigital.id',
            'operator@desadigital.id',
        ])->update(['role' => 'user']);
    }
};