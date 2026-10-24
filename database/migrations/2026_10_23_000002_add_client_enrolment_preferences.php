<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('enrolment_required')->default(false);
            $table->foreignUuid('preferred_service_id')->nullable()->constrained('services')->nullOnDelete();
            $table->foreignUuid('preferred_program_id')->nullable()->constrained('programs')->nullOnDelete();
            $table->timestamp('enrolment_selected_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['preferred_service_id']);
            $table->dropForeign(['preferred_program_id']);
            $table->dropColumn(['enrolment_required', 'preferred_service_id', 'preferred_program_id', 'enrolment_selected_at']);
        });
    }
};
