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
        Schema::create('guarantee', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->timestamps();
        });

        Schema::create('guarantee_insurance', function (Blueprint $table) {
            $table->unsignedBigInteger('insurance_id');
            $table->unsignedBigInteger('guarantee_id');
            $table->foreign('insurance_id')->references('id')->on('insurances');
            $table->foreign('guarantee_id')->references('id')->on('guarantee');
            $table->primary(['insurance_id', 'guarantee_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('garanties');
    }
};
