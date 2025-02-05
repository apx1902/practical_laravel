<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // SubCategory::factory(10)->create();

        // for each category seed 2 subcategories
        Category::all()->each(function ($category){
            SubCategory::factory(2)->create([
                'category_id'=>$category->id,
            ]);
        });
    }
}
