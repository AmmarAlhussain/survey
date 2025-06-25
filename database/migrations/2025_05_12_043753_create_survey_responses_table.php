<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('employee_code')->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('arabic_name');
            $table->boolean('is_head_office')->default(true);
        });

        Schema::create('surveys', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained('employees')->onDelete('cascade');
            $table->enum('work_environment_satisfaction', ['very_satisfied', 'satisfied', 'neutral', 'unsatisfied']);
            $table->enum('work_entertainment_balance', ['yes', 'neutral', 'no']);
            $table->enum('activities_help_routine', ['yes', 'neutral', 'no']);
            $table->text('activities_suggestions')->nullable();
            $table->enum('events_variety_satisfaction', ['satisfied', 'neutral', 'unsatisfied']);
            $table->enum('employee_experience_satisfaction', ['satisfied', 'neutral', 'unsatisfied']);
            $table->enum('communication_channels_satisfaction', ['satisfied', 'neutral', 'unsatisfied']);
            $table->text('communication_suggestions')->nullable();
            $table->enum('content_design_satisfaction', ['satisfied', 'neutral', 'unsatisfied']);
            $table->enum('response_time_satisfaction', ['satisfied', 'neutral', 'unsatisfied']);
            $table->text('communication_improvement_suggestions')->nullable();
            $table->text('work_environment_improvement_suggestions')->nullable();
            $table->text('events_improvement_suggestions')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('surveys');
        Schema::dropIfExists('employees');
    }
};
