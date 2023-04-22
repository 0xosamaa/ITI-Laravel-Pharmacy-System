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
        Schema::table('order_details', function (Blueprint $table) {
            $table->foreignId('doctor_id')->nullable()->constrained('users');
            $table->foreignId('pharmacy_id')->constrained('pharmacies');
            $table->enum('status', ['New', 'Confirmed', 'Processing', 'WaitingForUserConfirmation', 'Completed', 'Cancelled']);
            $table->boolean('is_insured');
            $table->string('delivery_address');
            $table->string('creator_type');
            $table->string('transaction_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('order_details', function (Blueprint $table) {
            //
        });
    }
};
