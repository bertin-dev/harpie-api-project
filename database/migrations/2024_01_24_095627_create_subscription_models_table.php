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
            $table->integer('userId');
            $table->string('firstName');
            $table->string('middleName');
            $table->string('lastName');
            $table->tinyInteger('gender');
            $table->integer('phoneNumber');
            $table->integer('countryCode');
            $table->string('email');
            $table->string('personalAddress');
            $table->string('vehicleMake');
            $table->string('vehicleModel');
            $table->string('vehicleIdentificationNumber');
            $table->date('yearOfManuficature');
            $table->string('plateNumber');
            $table->integer('currentMileage');
            $table->datetime('policyStartDate');
            $table->integer('coverageAmount');
            $table->integer('deductibleAmount');
            $table->string('driverLicenseNumber');
            $table->integer('yearOfDrivingExperience');
            $table->integer('annualMileage');
            $table->string('vehicleUsage');
            $table->string('paymentMethod');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscription_models');
    }
};
