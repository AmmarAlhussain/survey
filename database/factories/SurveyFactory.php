<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Survey>
 */
class SurveyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
        'email' => $this->faker->unique()->safeEmail,
        'effective_comm' => $this->faker->randomElement(['yes', 'no']),
        'best_comm' => $this->faker->randomElement(['email', 'whatsapp', 'screens', 'other']),
        'rate_comm_quality' => $this->faker->randomElement(['excellent', 'good', 'average', 'poor']),
        'rate_events' => $this->faker->randomElement(['excellent', 'good', 'average', 'poor']),
        'events_morale' => $this->faker->randomElement(['yes', 'no']),
        'events_culture' => $this->faker->randomElement(['yes', 'no']),
        'events_content' => $this->faker->randomElement(['yes', 'no']),
        'events_interest' => $this->faker->randomElement(['yes', 'no']),
        'events_organize' => $this->faker->randomElement(['excellent', 'good', 'average', 'poor']),
        'culture_env' => $this->faker->randomElement(['yes', 'no']),
        'env_comfort' => $this->faker->randomElement(['yes', 'no']),
        'env_resources' => $this->faker->randomElement(['yes', 'no']),
        'stars' => $this->faker->numberBetween(1, 5),
    ];
    }
}
