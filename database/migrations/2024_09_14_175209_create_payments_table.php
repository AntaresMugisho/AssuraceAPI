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
            $table->foreignId("subscription_id");
            $table->float("amount");
            $table->timestamp("payment_date")->default(now());
            $table->string("payment_method"); // credit_card, bank_transfer, mobile_money
            $table->string("transaction_id")->unique();
            $table->string("status")->default("success"); // success, failed
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
