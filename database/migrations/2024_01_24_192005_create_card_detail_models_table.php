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
        Schema::create('card_detail_models', function (Blueprint $table) {
            $table->id();
            $table->integer('userId');
            $table->integer('creditCardNumber');
            $table->date('expirationDate');
            $table->integer('CVC');
            $table->string('billingAddress');
            $table->integer('paymentAmount');
            $table->integer('authorizationCode');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('card_detail_models');
    }
};
