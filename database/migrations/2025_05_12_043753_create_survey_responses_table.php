<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('survey', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->enum('effective_comm', ['yes', 'no']);
            $table->enum('best_comm', ['email', 'whatsapp', 'screens', 'other']);
            $table->enum('rate_comm_quality', ['excellent', 'good', 'average', 'poor']);
            $table->enum('rate_events', ['excellent', 'good', 'average', 'poor']);
            $table->enum('events_morale', ['yes', 'no']);
            $table->enum('events_culture', ['yes', 'no']);
            $table->enum('events_content', ['yes', 'no']);
            $table->enum('events_interest', ['yes', 'no']);
            $table->enum('events_organize', ['excellent', 'good', 'average', 'poor']);
            $table->enum('culture_env', ['yes', 'no']);
            $table->enum('env_comfort', ['yes', 'no']);
            $table->enum('env_resources', ['yes', 'no']);
            $table->integer('stars');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('survey');
    }
};
