<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Character>
 */
class CharacterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'status' => fake()->word(),
            'species' => fake()->word(),
            'type' => fake()->word(),
            'gender' => fake()->word(),
            'url' => fake()->url(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
