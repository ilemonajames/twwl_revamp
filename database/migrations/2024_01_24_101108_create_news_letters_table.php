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
        Schema::create('news_letters', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title');
            $table->text('description');
            $table->string('image')->nullable();
            $table->string('file')->nullable();
            $table->uuid('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            // $table->uuid('id')->primary();
            // $table->string('email')->unique(); // Email address is unique
            // $table->timestamp('subscription_date')->default(now()); // Subscription date with default value as current timestamp
            // $table->enum('status', ['active', 'unsubscribed'])->default('active'); // Subscription status
            $table->timestamps(); // Laravel's default created_at and updated_at timestamps
            // $table->timestamp('unsubscribe_date')->nullable(); // Nullable timestamp for when a subscriber unsubscribes
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news_letters');
    }
};
