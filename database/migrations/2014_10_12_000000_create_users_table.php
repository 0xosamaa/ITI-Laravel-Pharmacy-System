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
            $table->enum('gender', ['male', 'female'])->default('male');
            $table->string('password');
            $table->date('date_of_birth')->nullable();
            $table->string('mobile_number')->nullable();
            $table->dateTime('last_loggedIn_time')->nullable();
            $table->decimal('national_id', $precision = 14, $scale = 0)->unique()->nullable();
            $table->string('profile_image_path')->nullable()->default('../default.jpg');

            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
