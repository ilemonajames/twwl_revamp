<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private array $relations = [
        ['appointments', 'user_id', 'users'], ['appointments', 'service_id', 'services'],
        ['appointments', 'program_id', 'programs'], ['program_fees', 'program_id', 'programs'],
        ['payments', 'user_id', 'users'], ['payments', 'appointment_id', 'appointments'],
        ['payments', 'service_id', 'services'], ['payments', 'program_id', 'programs'],
    ];

    public function up(): void
    {
        if (DB::getDriverName() !== 'mysql') {
            return;
        }
        // Refuse lossy conversion or orphan cleanup. Resolve these records explicitly before deployment.
        if (DB::table('payments')->whereNotNull('appointment_id')->whereRaw("CAST(appointment_id AS CHAR) NOT REGEXP '^[0-9]+$'")->exists()) {
            throw new RuntimeException('payments.appointment_id contains nonnumeric values; reconcile them before migrating.');
        }
        foreach ($this->relations as [$table, $column, $parent]) {
            $orphans = DB::table($table.' as child')->leftJoin($parent.' as parent', 'child.'.$column, '=', 'parent.id')
                ->whereNotNull('child.'.$column)->whereNull('parent.id')->count();
            if ($orphans) {
                throw new RuntimeException($table.'.'.$column.' contains '.$orphans.' orphan references. Reconcile them before migrating.');
            }
        }
        $appointmentForeign = DB::selectOne("SELECT COUNT(*) AS total FROM information_schema.KEY_COLUMN_USAGE WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'payments' AND COLUMN_NAME = 'appointment_id' AND REFERENCED_TABLE_NAME IS NOT NULL");
        if (! $appointmentForeign->total) {
            DB::statement('ALTER TABLE payments MODIFY appointment_id BIGINT UNSIGNED NULL');
        }
        foreach ($this->relations as [$table, $column, $parent]) {
            $existing = DB::selectOne('SELECT COUNT(*) AS total FROM information_schema.KEY_COLUMN_USAGE WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = ? AND COLUMN_NAME = ? AND REFERENCED_TABLE_NAME IS NOT NULL', [$table, $column]);
            if (! $existing->total) {
                Schema::table($table, fn (Blueprint $blueprint) => $blueprint->foreign($column, 'integrity_'.$table.'_'.$column)->references('id')->on($parent)->restrictOnDelete());
            }
        }
    }

    public function down(): void
    {
        if (DB::getDriverName() !== 'mysql') {
            return;
        }
        foreach ($this->relations as [$table, $column, $parent]) {
            $name = 'integrity_'.$table.'_'.$column;
            $existing = DB::selectOne('SELECT COUNT(*) AS total FROM information_schema.TABLE_CONSTRAINTS WHERE CONSTRAINT_SCHEMA = DATABASE() AND TABLE_NAME = ? AND CONSTRAINT_NAME = ?', [$table, $name]);
            if ($existing->total) {
                Schema::table($table, fn (Blueprint $blueprint) => $blueprint->dropForeign($name));
            }
        }
        // Preserve the corrected integer key type when rolling back.
    }
};
