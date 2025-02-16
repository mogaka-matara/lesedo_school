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
        Schema::create('fee_components', function (Blueprint $table) {
            $table->id();
            $table->foreignId('grade_id');
            $table->foreignId('term_id');
            $table->decimal('tuition_fee', 8, 2)->nullable();
            $table->decimal('lunch_fee', 8, 2)->nullable();
            $table->decimal('tea_fee', 8, 2)->nullable();
            $table->decimal('total_fee', 8, 2)->nullable(); // Calculated field
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fee_components');
    }
};
