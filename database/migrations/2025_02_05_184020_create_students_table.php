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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->integer('grade_id');
            $table->integer('term_id');
            $table->integer('academic_year_id');
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->string('admission_no');
            $table->boolean('medical_condition');
            $table->string('address');
            $table->date('date_of_birth');
            $table->enum('gender', ['M', 'F']);
            $table->string('parent_name');
            $table->string('parent_contact');
            $table->string('parent_email')->nullable();
            $table->string('guardian_name')->nullable();
            $table->string('guardian_contact')->nullable();
            $table->string('guardian_email')->nullable();
            $table->boolean('opt_in_lunch')->default(false);
            $table->boolean('opt_in_tea')->default(false);
            $table->double('term_amount_paid')->default(0);
            $table->double('term_arrears')->default(0);
            $table->double('overpayment')->default(0);
            $table->string('term_status')->default('Pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
