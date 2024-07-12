<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'title' => "Men",
            'active_status' => '1',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        Category::create([
            'title' => "Women",
            'active_status' => '1',
            'created_at' => now(),
            'updated_at' => now(),

        ]);
        Category::create([
            'title' => "Kids",
            'active_status' => '1',
            'created_at' => now(),
            'updated_at' => now(),

        ]);
    }
}
