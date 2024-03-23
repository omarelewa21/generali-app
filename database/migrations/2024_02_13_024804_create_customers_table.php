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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('full_name')->nullable()->index();
            $table->string('country_code')->nullable();
            $table->string('mobile_number')->nullable();
            $table->string('house_phone_number_country_code')->nullable();
            $table->string('house_phone_number')->nullable();
            $table->string('email')->nullable();
            $table->string('country')->nullable();
            $table->string('id_type')->nullable();
            $table->string('id_number')->nullable();
            $table->string('passport_number')->nullable();
            $table->string('birth_cert')->nullable();
            $table->string('police_number')->nullable();
            $table->string('registration_number')->nullable();
            $table->string('gender')->nullable();
            $table->timestamp('dob')->nullable();
            $table->integer('age')->nullable();
            $table->string('habit')->nullable();
            $table->string('education_level')->nullable();
            $table->string('occupation')->nullable();
            $table->string('marital_status')->nullable();
            $table->integer('children')->nullable();
            $table->integer('customer_choice')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
