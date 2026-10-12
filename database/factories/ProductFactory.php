<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->randomElement(['Whole Milk', 'Skimmed Milk', 'Yoghurt Plain', 'Yoghurt Strawberry', 'Yoghurt Vanilla', 'Flavored Milk']),
            'sku' => 'MILK-'.fake()->unique()->numberBetween(1000, 9999),
            'price' => fake()->randomFloat(2, 50, 200),
            'unit' => 'liters',
            'category' => fake()->randomElement(['milk', 'yoghurt', 'flavored']),
            'description' => fake()->sentence(),
            'is_active' => true,
        ];
    }
}
