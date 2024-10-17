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
        Schema::create('events', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('event_title');
            $table->text('description');
            $table->string('image');
            $table->string('thumbnail')->nullable();
            $table->string('event_date')->nullable();
            $table->string('event_time')->nullable();
            $table->string('type_of_event');
            $table->boolean('enable_voting')->default(false);
            $table->string('event_location')->nullable();
            $table->string('event_link')->nullable();
            $table->uuid('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
