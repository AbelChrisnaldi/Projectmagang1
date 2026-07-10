<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Fresh SQLite databases already receive VARCHAR(100) from the table's
        // create migration. MySQL still needs this migration for older installs.
        if (DB::getDriverName() === 'sqlite') {
            return;
        }

        DB::statement('ALTER TABLE dosen_riib MODIFY sub_kk VARCHAR(100) NULL');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (DB::getDriverName() === 'sqlite') {
            return;
        }

        DB::statement('ALTER TABLE dosen_riib MODIFY sub_kk VARCHAR(10) NULL');
    }
};
