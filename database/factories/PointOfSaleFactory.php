<?php

namespace Database\Factories;

use App\Models\PointOfSale;
use Illuminate\Database\Eloquent\Factories\Factory;

class PointOfSaleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PointOfSale::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => fake()->word,
            'warehouse_id' =>  fake()->numberBetween(1, 10),
        ];
    }
}
