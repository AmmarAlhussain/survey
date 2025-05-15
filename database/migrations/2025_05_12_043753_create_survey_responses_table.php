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
            $table->string('best_comm');
            $table->integer('rate_comm_quality' );
            $table->integer('rate_events' );
            $table->enum('events_morale', ['yes', 'no']);
            $table->enum('events_culture', ['yes', 'no']);
            $table->enum('events_content', ['yes', 'no']);
            $table->enum('events_interest', ['yes', 'no']);
            $table->integer('events_organize');
            $table->enum('culture_env', ['yes', 'no']);
            $table->enum('env_comfort', ['yes', 'no']);
            $table->enum('env_resources', ['yes', 'no']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('survey');
    }
};
