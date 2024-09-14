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
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id");
            $table->foreignId("plan_id");
            $table->timestamp("start_date");
            $table->timestamp("end_date");
            $table->string("status")->default("active"); // active, expired, canceled, upgraded, renewed
            $table->string("payment_status")->default("unpaid"); // unpaid, paid
            $table->foreignId("upgrade_from")->nullable();
            $table->foreignId("renewal_of")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
