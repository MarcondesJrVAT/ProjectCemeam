<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         \App\Models\User::factory()->create([
             'name' => 'Super',
             'email' => 'super@admin.com',
         ]);
        \App\Models\User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
        ]);
        \App\Models\User::factory()->create([
            'name' => 'Usuário',
            'email' => 'user@user.com',
        ]);
        \App\Models\User::factory(100)->create();
    }
}
