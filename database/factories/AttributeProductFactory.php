<?php

namespace Database\Factories;

use App\Models\Attribute;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AttributeProduct>
 */
class AttributeProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $products = Product::pluck('id')->toArray();
        $attributes = Attribute::pluck('id')->toArray();

        return [
            'attribute_id' => fake()->randomElement($attributes),
            'product_id' => fake()->randomElement($products),
            'value' => fake()->word,
        ];
    }
}
