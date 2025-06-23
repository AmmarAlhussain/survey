<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Employee;
use App\Models\Survey;

class SurveySeeder extends Seeder
{
    public function run(): void
    {
        $employees = Employee::all();

        foreach ($employees as $employee) {
            Survey::factory()->create([
                'employee_id' => $employee->id
            ]);
        }
    }
}
