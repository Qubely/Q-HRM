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
        Schema::create('employee_attendance_recons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id');
            $table->foreignId('employee_attendance_id');
            $table->string('in_time',100);
            $table->string('out_time',100);
            $table->string('reason');
            $table->string('status')->default('Pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_attendance_recons');
    }
};
