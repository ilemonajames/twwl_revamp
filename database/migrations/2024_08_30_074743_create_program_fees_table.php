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
        Schema::create('program_fees', function (Blueprint $table) {
            $table->id();
            $table->uuid('program_id')->nullable()->constrained()->onDelete('cascade');
            $table->uuid('service_id')->nullable()->constrained()->onDelete('cascade');
            $table->decimal('consultation_fees', 8, 2);
            $table->decimal('session_fees', 8, 2);
            $table->decimal('program_fees', 8, 2);
            $table->string('duration');
            $table->string('payment_status')->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('program_fees');
    }
};
