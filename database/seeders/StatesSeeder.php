<?php

namespace Database\Seeders;

use App\Models\States;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        States::create(['name' => "Manquant"]);
        States::create(['name' => "Possédé"]);
        States::create(['name' => "Double"]);
    }
}
