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
        Schema::create('doctors_info', function (Blueprint $table) {
            $table->id();
            $table->foreignId('doctor_id')->constrained('users');
            $table->decimal('national_id', $precision = 14, $scale = 0)->unique();
            $table->string('avatar_image')->default('default.jpg');
            $table->boolean('is_banned')->default(false);
            $table->foreignId('pharmacy_id')->constrained('pharmacies');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctors_info');
    }
};
