<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Attribute>
 */
class AttributeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->randomElement(['Color', 'Size', 'Material', 'Brand', 'Style', 'Model']),
            'type' => fake()->randomElement(['STRING', 'NUMBER', 'LIST', 'DATE']),
            'attribute_order' => fake()->numberBetween(1, 6),
        ];
    }
}
