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
            $table->foreign('doctor_id')->references('id')->on('users');
            $table->decimal('national_id', $precision = 14, $scale = 0)->unique();
            $table->string('avatar_image')->default('default.jpg');
            $table->boolean('is_banned')->default(false);
            $table->foreign('pharmacy_id')->references('id')->on('pharmacies');
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
