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
        Schema::create('student_term_fees', function (Blueprint $table) {
            $table->id();
            $table->integer('student_id');
            $table->integer('term_id');
            $table->double('amount');
            $table->date('payment_date');
            $table->string('receipt_number')->nullable();
            $table->string('payment_mode');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_term_fees');
    }
};
