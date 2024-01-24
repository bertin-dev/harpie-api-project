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
        Schema::create('bank_detail', function (Blueprint $table) {
            $table->id();
            $table->integer('userId');
            $table->string('bankName');
            $table->string('holderName');
            $table->integer('accountNumber');
            $table->integer('routingNumber');
            $table->integer('paymentAmount');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bank_account_models');
    }
};
