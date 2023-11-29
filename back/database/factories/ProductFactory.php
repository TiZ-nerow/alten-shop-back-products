<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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
            'code'            => fake()->unique()->name(),
            'name'            => fake()->name(),
            'description'     => fake()->sentence(),
            'price'           => fake()->randomNumber(2, false),
            'quantity'        => fake()->randomNumber(2, false),
            'category'        => fake()->name(),
            'image'           => null,
            'rating'          => fake()->numberBetween(0, 5),
        ];
    }
}
