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
        Schema::create('existing_policies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained();
            $table->foreignId('transaction_id')->constrained();
            $table->string('role')->nullable();
            $table->string('full_name')->nullable();
            $table->string('company')->nullable();

            $table->string('inception_year')->nullable();
            $table->string('plan_type')->nullable();
            $table->string('maturity_year')->nullable();
            $table->string('premium_mode')->nullable();
            $table->string('premium_contribution')->nullable();
            $table->string('life_coverage_amount')->nullable();
            $table->string('critical_illness_amount')->nullable();
            $table->json('additional_benefit')->nullable();

            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('existing_policies');
    }
};
