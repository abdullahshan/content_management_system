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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('file_no')->nullable();
            $table->integer('status')->default('0');
            $table->foreignId('book_id');
            $table->integer('no_share')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('date_of_birth')->nullable();
            $table->string('nid_image')->nullable();
            $table->string('nid_no')->nullable();
            $table->string('nationallity')->nullable();
            $table->string('marriage')->nullable();
            $table->string('marriage_status')->nullable();
            $table->string('phone')->nullable();
            $table->string('phone_office')->nullable();
            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('presend_address')->nullable();
            $table->string('permanent_address')->nullable();
            $table->string('image')->nullable();
            $table->string('service')->nullable();
            $table->string('rank')->nullable();
            $table->string('f_pay')->nullable();
            $table->string('applystatus')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
