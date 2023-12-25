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
        Schema::create('plots', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id');
            $table->foreignId('road_id');
            $table->integer('plot_num');
            $table->integer('plot_size');
            $table->string('plot_type');
            $table->string('facing');
            $table->integer('per_plot_price');
            $table->integer('plot_price');
            $table->integer('status')->default('1');
            $table>
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plots');
    }
};
