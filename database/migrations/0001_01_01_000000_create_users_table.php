<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();

                    // Add new survey-related fields
        $table->enum('age_range', ['under_18', '18_24', '25_34', '35_44', '45_plus'])->nullable();
        $table->enum('gender', ['male', 'female', 'non_binary', 'prefer_not_to_say'])->nullable();
        $table->enum('satisfaction', ['very_satisfied', 'satisfied', 'neutral', 'dissatisfied', 'very_dissatisfied'])->nullable();
        $table->enum('usage_frequency', ['daily', 'weekly', 'monthly', 'rarely', 'never'])->nullable();
        $table->integer('recommendation')->nullable();
        $table->json('features')->nullable();  // Store selected features as a JSON array
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
