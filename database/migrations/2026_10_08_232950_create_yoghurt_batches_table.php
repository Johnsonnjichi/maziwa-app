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
        Schema::create('yoghurt_batches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('batch_number')->unique();
            $table->decimal('milk_quantity_liters', 10, 2);
            $table->string('flavor')->nullable();
            $table->enum('status', ['preparing', 'fermenting', 'ready', 'completed'])->default('preparing');
            $table->date('production_date');
            $table->decimal('yield_quantity_liters', 10, 2)->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->index(['status', 'production_date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('yoghurt_batches');
    }
};
