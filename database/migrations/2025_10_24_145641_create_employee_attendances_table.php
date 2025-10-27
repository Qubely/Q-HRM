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
        Schema::create('employee_attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id');
            $table->date('att_date');
            $table->string('in_time',100)->nullable();
            $table->string('out_time',100)->nullable();
            $table->string('device_id')->nullable();
            $table->string('status')->default('absent');
            $table->string('att_remarks')->nullable();
            $table->string('in_image')->nullable();
            $table->string('out_image')->nullable();
            $table->string('longitude_in')->nullable();
            $table->string('latitude_in')->nullable();
            $table->string('longitude_out')->nullable();
            $table->string('latitude_out')->nullable();
            $table->string('sent_sms')->default('no');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_attendances');
    }
};
