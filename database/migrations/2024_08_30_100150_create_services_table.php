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
    Schema::create('services', function (Blueprint $table) {
        $table->uuid('id')->primary();
        $table->string('service_icon')->nullable();
        $table->string('service_image');
        $table->string('service_title');
        $table->text('service_description');
        $table->decimal('price', 8, 2)->default(0.0);
        $table->boolean('is_featured')->default(false); // Add this line
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
