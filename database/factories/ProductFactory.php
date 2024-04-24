<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
            return [
                'code' => fake()->unique()->randomNumber(5),
                'name' => fake()->word,
                'description' => fake()->sentence,
                'category_id' => rand(1, 5),
                'unit_id' => rand(1, 5),
                'cost_price' => fake()->randomFloat(2, 10, 100),
            ];
    }
}
