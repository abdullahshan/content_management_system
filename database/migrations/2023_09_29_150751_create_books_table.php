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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id');
            $table->foreignId('road_id');
            $table->integer('plot_num');
            $table->string('name')->nullable();
            $table->integer('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('address')->nullable();
            $table->longText('message')->nullable();
            $table->integer('status')->nullable();
            $table->string('type')->nullable();
            $table->integer('price')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
