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
        Schema::create('lib_inventory_cat_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lib_inventory_cat_id');
            $table->string('name')->nullable();
            $table->string('tag_name');
            $table->string('model')->nullable();
            $table->string('description')->nullable();
            $table->integer('serial');
            $table->foreignId('admin_user_id')->nullable();
            $table->string('status')->default('Available');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lib_inventory_cat_items');
    }
};
