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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('name_nok');
            $table->string('job_title');
            $table->string('spouse')->nullable();
            $table->date('dob');
            $table->string('email');
            $table->text('image_url');
            $table->string('phone_no',50);
            $table->string('phone_no_nok',50);
            $table->enum('department',['data','backend', 'frontend', 'sales']);
            $table->text('address');
            $table->string('location');
            $table->enum('employment_type',['fulltime','contract']);
            $table->timestamp('start_date');
            $table->enum('status', ['active', 'inactive', 'leave', 'onboarding']);
            $table->integer('current_salary');
            $table->enum('manager', ['Mr. Blue', 'Mr. Pink', 'Mr. Brown', 'Mr. Black']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
