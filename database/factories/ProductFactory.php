<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(3),
            'sale_price' => $this->faker->randomFloat(2, 100, 1000),
            'cost_price' => $this->faker->randomFloat(2, 100, 1000),
            'description' => $this->faker->paragraph(3),
        ];
    }
}
