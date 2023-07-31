<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Doctor>
 */
class DoctorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'specialty' => $this->faker->jobTitle,
            'city_id' => \App\Models\City::factory(), // Cria uma chave estrangeira para uma cidade usando a factory de City
        ];
    }
}
