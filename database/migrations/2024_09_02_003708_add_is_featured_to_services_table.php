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
        // Check if the 'is_featured' column doesn't exist before adding
        if (!Schema::hasColumn('services', 'is_featured')) {
            Schema::table('services', function (Blueprint $table) {
                $table->boolean('is_featured')->default(0)->after('price');
            });
        }
    }

public function down()
{
    Schema::table('services', function (Blueprint $table) {
        $table->dropColumn('is_featured');
    });
}

};
