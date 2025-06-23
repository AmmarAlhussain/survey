<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Survey>
 */
class SurveyFactory extends Factory
{
    public function definition(): array
    {
        return [
            // Placeholder, will be overridden in the seeder
            'employee_id' => null,

            'work_environment_satisfaction' => $this->faker->randomElement(['very_satisfied', 'satisfied', 'neutral', 'unsatisfied']),
            'work_entertainment_balance' => $this->faker->randomElement(['yes', 'neutral', 'no']),
            'activities_help_routine' => $this->faker->randomElement(['yes', 'neutral', 'no']),
            'activities_suggestions' => $this->faker->optional(0.3)->sentence(10),
            'events_variety_satisfaction' => $this->faker->randomElement(['satisfied', 'neutral', 'unsatisfied']),
            'employee_experience_satisfaction' => $this->faker->randomElement(['satisfied', 'neutral', 'unsatisfied']),
            'communication_channels_satisfaction' => $this->faker->randomElement(['satisfied', 'neutral', 'unsatisfied']),
            'communication_suggestions' => $this->faker->optional(0.3)->sentence(10),
            'content_design_satisfaction' => $this->faker->randomElement(['satisfied', 'neutral', 'unsatisfied']),
            'response_time_satisfaction' => $this->faker->randomElement(['satisfied', 'neutral', 'unsatisfied']),
            'communication_improvement_suggestions' => $this->faker->optional(0.2)->sentence(15),
            'work_environment_improvement_suggestions' => $this->faker->optional(0.2)->sentence(15),
            'events_improvement_suggestions' => $this->faker->optional(0.2)->sentence(15),
        ];
    }
}
