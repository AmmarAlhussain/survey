<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'employee_code' => $this->faker->unique()->numberBetween(10000000, 99999999),
            'first_name' => $this->faker->firstName(),
            'arabic_name' => $this->faker->optional(0.7)->name(),
        ];
    }
}
