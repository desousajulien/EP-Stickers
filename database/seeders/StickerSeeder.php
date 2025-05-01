<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Sticker;

class StickerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Sticker::create(['number' => 1, 'category_id' => 1]);
        Sticker::create(['number' => 2, 'category_id' => 1]);
        Sticker::create(['number' => 3, 'category_id' => 2]);
        Sticker::create(['number' => 4, 'category_id' => 2]);
        Sticker::create(['number' => 5, 'category_id' => 2]);
    }
}
