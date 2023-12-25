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
        Schema::create('shairs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('customers')->onDelete('cascade');
            $table->string('name');
            $table->string('email');
            $table->string('nid_image')->nullable();
            $table->string('nid_number');
            $table->string('phone');
            $table->string('nationality');
            $table->date('barth_date');
            $table->date('marriage_date')->nullable();
            $table->string('marriage_status')->nullable();
            $table->string('address');
            $table->string('permanent_address');
            $table->string('father');
            $table->string('mother');
            $table->string('service')->nullable();
            $table->string('rank')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shairs');
    }
};
