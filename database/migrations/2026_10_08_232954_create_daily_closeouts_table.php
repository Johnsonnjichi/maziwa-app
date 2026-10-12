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
        Schema::create('daily_closeouts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('branch_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->date('closeout_date');
            $table->decimal('total_sales', 10, 2);
            $table->decimal('cash_on_hand', 10, 2);
            $table->decimal('total_expenses', 10, 2);
            $table->decimal('net_cash', 10, 2);
            $table->decimal('expected_cash', 10, 2);
            $table->decimal('variance', 10, 2);
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->index(['branch_id', 'closeout_date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daily_closeouts');
    }
};
