<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Shelter;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Dog>
 */
class DogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
    return [
        'name' => fake()->firstName(),
        'breed' => fake()->word(),
        'birth_date' => fake()->date(),
        'status' => 'available', // por defecto
        'shelter_id' => Shelter::factory(), // asignar shelter automáticamente si se quiere
        ];
    }
}
