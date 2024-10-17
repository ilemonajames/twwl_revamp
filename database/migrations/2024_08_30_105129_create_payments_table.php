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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->uuid('user_id')->constrained()->onDelete('cascade');
            $table->uuid('appointment_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('payment_type'); // New field: 'service' or 'program'
            $table->uuid('service_id')->nullable()->constrained()->onDelete('cascade');
            $table->uuid('program_id')->nullable()->constrained()->onDelete('cascade');
            $table->decimal('amount', 8, 2);
            $table->string('payment_status')->default('pending');
            $table->string('payment_method')->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('transaction_status')->nullable();
            $table->string('transaction_currency')->nullable();
            $table->timestamps();
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
