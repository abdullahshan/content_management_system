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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id');
            $table->string('installment')->nullable();
            $table->string('description')->nullable();
            $table->string('cheque_ba_cash')->nullable();
            $table->string('cheque_date')->nullable();
            $table->string('receive_data')->nullable();
            $table->string('bank')->nullable();
            $table->string('brance')->nullable();
            $table->integer('memo_no')->nullable();
            $table->integer('amount')->nullable();
            $table->integer('cumulative')->nullable();
            $table->integer('amount_due')->nullable();
            $table->string('pay_by')->nullable();
            $table->string('remarks')->nullable();
            $table->integer('status')->nullable();
            $table->date('date')->nullable();
            $table->integer('due')->nullable();
            $table->integer('last_due')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
