<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->randomElement(['Smartphones', 'Desktops and Notebooks', 'Computer Accessories','Electronics', 'Clothing', 'Books', 'Toys']),
            'image' => fake()->imageUrl(),
        ];
    }
}
