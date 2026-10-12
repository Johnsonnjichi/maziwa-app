<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex(['role', 'branch_id']);
        });

        DB::statement('ALTER TABLE users DROP COLUMN role');
        DB::statement('ALTER TABLE users ADD COLUMN role VARCHAR(255) DEFAULT "worker"');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex(['role', 'branch_id']);
        });

        DB::statement('ALTER TABLE users DROP COLUMN role');
        DB::statement('ALTER TABLE users ADD COLUMN role VARCHAR(255) DEFAULT "worker"');
    }
};
