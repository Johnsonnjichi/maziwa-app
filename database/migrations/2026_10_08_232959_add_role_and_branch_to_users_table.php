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
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['admin', 'manager', 'worker'])->default('worker')->after('email');
            $table->foreignId('branch_id')->nullable()->constrained()->onDelete('set null')->after('role');
            $table->index(['role', 'branch_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['branch_id']);
            $table->dropIndex(['role', 'branch_id']);
            $table->dropColumn(['role', 'branch_id']);
        });
    }
};
