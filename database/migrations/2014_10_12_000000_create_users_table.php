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
            $table->uuid('id')->primary();
            $table->string('surname');
            $table->string('othernames');
            $table->string('email')->unique();
            $table->string('phoneno')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('referal_code')->nullable();
            $table->string('resident_address')->nullable();
            $table->enum('user_type',['Super Admin','Website Admin','Client']);
            $table->uuid('referer_id')->nullable();

            $table->boolean('dark_mode')->default(false);
            $table->string('profile_photo_path')->default('user.png');
            $table->enum('status',['Pending','Active','Disabled','Deleted'])->default('Pending');
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
