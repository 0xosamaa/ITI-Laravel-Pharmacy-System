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
        Schema::create('user_addresses', function (Blueprint $table) {
            $table->id();
            $table->integer('flat_number')->nullable();
            $table->integer('floor_number')->nullable();
            $table->integer('building_number')->nullable();
            $table->string('street_name')->nullable();
            $table->string('area_id')->nullable();
            $table->boolean('is_main')->default(false)->nullable();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('governorate_id')->constrained('governorates');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_addresses');
    }
};
