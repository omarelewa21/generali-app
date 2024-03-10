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
        Schema::create('spouses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained();
            $table->string('relation')->nullable();
            $table->string('title')->nullable();
            $table->string('full_name')->nullable()->index();
            $table->string('country')->nullable();
            $table->string('id_type')->nullable();
            $table->string('id_number')->nullable();
            $table->string('passport_number')->nullable();
            $table->string('birth_cert')->nullable();
            $table->string('police_number')->nullable();
            $table->string('registration_number')->nullable();
            $table->string('dob')->nullable();
            $table->integer('age')->nullable();   
            $table->string('gender')->nullable();
            $table->string('habit')->nullable();
            $table->string('occupation')->nullable();
            $table->string('marital_status')->nullable();
            $table->integer('children')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spouses');
    }
};
