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
        Schema::create('permanent_employees', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('organization_id');
            $table->timestamp('start_date');
            $table->unsignedBigInteger('workshifts');
            $table->unsignedBigInteger('province_id');
            $table->unsignedBigInteger('chain_id');
            $table->unsignedBigInteger('chain_location_id');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('organization_id')->references('id')->on('organizations');
            $table->foreign('province_id')->references('id')->on('provinces');
            $table->foreign('workshifts')->references('id')->on('organization_workshifts');
            $table->foreign('chain_id')->references('id')->on('chains');
            $table->foreign('chain_location_id')->references('id')->on('chain_locations');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permanent_employees');
    }
};
