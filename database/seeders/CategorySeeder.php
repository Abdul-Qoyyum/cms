<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            'personal',
            'work',
            'family',
            'friends'
        ];

        foreach ($categories as $category){
            Category::query()->firstOrCreate([
                'name' => $category
            ],[
                'name' => $category
            ]);
        }
    }
}
