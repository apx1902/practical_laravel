<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SubCategory>
 */
class SubCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categoryIds = Category::inRandomOrder()->first();
        // $categoryIds = Category::inRandomOrder()->pluck('id')->first();

        return [
            'sub_category_name' => fake()->name(),
            'category_id' => $categoryIds->id
        ];
    }
}
