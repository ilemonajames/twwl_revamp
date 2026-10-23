<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // These legacy columns were required even for guest/program-only bookings.
        if (DB::getDriverName() === 'mysql') {
            DB::statement('ALTER TABLE appointments MODIFY user_id CHAR(36) NULL, MODIFY service_id CHAR(36) NULL, MODIFY program_id CHAR(36) NULL');
        }
        Schema::table('appointments', function (Blueprint $table) {
            $table->text('comment')->nullable();
            $table->unsignedBigInteger('amount_minor')->default(0);
            $table->timestamp('reserved_until')->nullable();
            $table->index(['appointment_date', 'appointment_time']);
        });
        Schema::create('booking_calendar_locks', function (Blueprint $table) {
            $table->date('date')->primary();
        });
        Schema::create('orders', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('name');
            $table->string('email');
            $table->text('address');
            $table->json('items');
            $table->unsignedBigInteger('amount_minor');
            $table->string('currency', 3);
            $table->string('status')->default('pending');
            $table->timestamps();
        });
        Schema::create('payment_attempts', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignId('appointment_id')->nullable()->constrained()->restrictOnDelete();
            $table->foreignUuid('order_id')->nullable()->constrained()->restrictOnDelete();
            $table->unsignedBigInteger('amount_minor');
            $table->string('currency', 3);
            $table->string('source_hash', 64)->nullable();
            $table->string('provider_id')->nullable()->unique();
            $table->string('status')->default('pending')->index();
            $table->timestamps();
        });
        Schema::create('payment_webhook_events', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->timestamp('created_at');
        });
        Schema::create('jobs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('queue')->index();
            $table->longText('payload');
            $table->unsignedTinyInteger('attempts');
            $table->unsignedInteger('reserved_at')->nullable();
            $table->unsignedInteger('available_at');
            $table->unsignedInteger('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payment_webhook_events');
        Schema::dropIfExists('payment_attempts');
        Schema::dropIfExists('orders');
        Schema::dropIfExists('booking_calendar_locks');
        Schema::dropIfExists('jobs');
        Schema::table('appointments', function (Blueprint $table) {
            $table->dropIndex(['appointment_date', 'appointment_time']);
            $table->dropColumn(['comment', 'amount_minor', 'reserved_until']);
        });
        // Preserve nullable legacy relations; reverting them could discard guest data.
    }
};
