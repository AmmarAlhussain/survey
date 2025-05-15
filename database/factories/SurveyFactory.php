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
        'email' => $this->faker->unique()->userName . '@' . $this->faker->randomElement(['almosafer.com', 'lumi.com', 'seera.com']),
        'effective_comm' => $this->faker->randomElement(['yes', 'no']),
        'best_comm' => $this->faker->randomElement(['email', 'whatsapp', 'screens', 'X','facebook','snapchat']),
        'rate_comm_quality' => $this->faker->numberBetween(1, 5),
        'rate_events' => $this->faker->numberBetween(1, 5),
        'events_morale' => $this->faker->randomElement(['yes', 'no']),
        'events_culture' => $this->faker->randomElement(['yes', 'no']),
        'events_content' => $this->faker->randomElement(['yes', 'no']),
        'events_interest' => $this->faker->randomElement(['yes', 'no']),
        'events_organize' => $this->faker->numberBetween(1, 5),
        'culture_env' => $this->faker->randomElement(['yes', 'no']),
        'env_comfort' => $this->faker->randomElement(['yes', 'no']),
        'env_resources' => $this->faker->randomElement(['yes', 'no']),
    ];
    }
}
