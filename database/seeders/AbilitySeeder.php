<?php

namespace Database\Seeders;

use App\Models\Ability;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AbilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Ability::factory()->create(['name' => 'create_user']);
        Ability::factory()->create(['name' => 'read_user']);
        Ability::factory()->create(['name' => 'update_user']);
        Ability::factory()->create(['name' => 'delete_user']);
        Ability::factory()->create(['name' => 'create_news']);
        Ability::factory()->create(['name' => 'read_news']);
        Ability::factory()->create(['name' => 'update_news']);
        Ability::factory()->create(['name' => 'delete_news']);
    }
}
