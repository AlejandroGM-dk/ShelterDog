<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Adoptions>
 */
class AdoptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
    return [
        'dog_id' => 1, // se reemplaza manualmente en el seeder
        'adopter_id' => 1, // se reemplaza manualmente en el seeder
        'adoption_date' => fake()->date(),
        'fee_paid' => fake()->randomFloat(2, 50, 500),
        ];
    }
}
