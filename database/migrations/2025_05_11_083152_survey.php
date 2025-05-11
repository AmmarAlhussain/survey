<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('survey', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->enum('age_range', ['under_18', '18_24', '25_34', '35_44', '45_plus']);
            $table->enum('gender', ['male', 'female']);
            $table->enum('satisfaction', ['very_satisfied', 'satisfied', 'neutral', 'dissatisfied', 'very_dissatisfied']);
            $table->enum('usage_frequency', ['daily', 'weekly', 'monthly', 'rarely', 'never']);
            $table->enum('stars',['1-star','2-star','3-star','4-star','5-star']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('survey');
    }
};
