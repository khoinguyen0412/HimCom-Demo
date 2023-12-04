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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('identifier',191);
            $table->string('full_name');
            $table->timestamp('dob');
            $table->enum('gender',['Male','Female']);
            $table->string('hometown');
            $table->string('residence');
            $table->timestamp('issued_date');
            $table->string('issued_place');
            $table->string('phone_number');
            $table->string('address');
            $table->unsignedBigInteger('province_id');
            $table->unsignedBigInteger('district_id');
            $table->integer('height_cm');
            $table->integer('height_m');
            $table->integer('weight');
            $table->unsignedBigInteger('bank_id');
            $table->string('account_number');
            $table->string('bank_branch_name');
            $table->string('contact_full_name');
            $table->string('contact_phone_number');
            $table->unsignedBigInteger('contact_family_relationship_id');
            $table->timestamps();


            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('province_id')->references('id')->on('provinces');
            $table->foreign('district_id')->references('id')->on('districts');
            $table->foreign('bank_id')->references('id')->on('banks');
            $table->foreign('contact_family_relationship_id')
            ->references('id')->on('family_relationships');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
