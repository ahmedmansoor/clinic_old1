<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('nid')->unique()->nullable();
            $table->string('address')->nullable();
            $table->string('island')->nullable();
            $table->string('atoll')->nullable();
            $table->string('country')->nullable();
            $table->unsignedBigInteger('marital_status')->nullable();
            $table->string('drug_allergies')->nullable();
            $table->string('food_allergies')->nullable();
            $table->string('emergency_name')->nullable();
            $table->string('emergency_mobile')->nullable();
            $table->string('mobile')->unique()->nullable();
            $table->string('email')->unique()->nullable();
            $table->date('dob')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patients');
    }
};