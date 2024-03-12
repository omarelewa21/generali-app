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
        Schema::create('customer_needs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained();
            $table->string('type')->nullable();
            $table->string('relationship')->nullable();
            $table->string('child_name')->nullable();
            $table->timestamp('child_dob')->nullable();
            $table->string('spouse_name')->nullable();
            $table->timestamp('spouse_dob')->nullable();
            $table->float('covered_amount')->nullable();
            $table->float('covered_amount_monthly')->nullable();
            $table->integer('supporting_year')->nullable();
            $table->bigInteger('goals_amount')->nullable();
            $table->float('total_needed')->nullable();
            $table->string('existing_policy')->nullable();
            $table->float('existing_amount')->nullable();
            $table->bigInteger('existing_fund')->nullable();
            $table->string('existing_debt')->nullable();
            $table->float('insurance_amount')->nullable();
            $table->float('fund_percentage')->nullable();
            $table->string('ideal_retirement')->nullable();
            $table->integer('retirement_age')->nullable();
            $table->integer('remaining_year')->nullable();
            $table->string('other_source')->nullable();
            $table->string('other_sources_custom')->nullable();
            $table->integer('goal')->nullable();
            $table->bigInteger('goal_amount')->nullable();
            $table->json('goal_target')->nullable();
            $table->integer('annual_return')->nullable();
            $table->bigInteger('annual_return_amount')->nullable();
            $table->string('risk_profile')->nullable();
            $table->string('potential_return')->nullable();
            $table->integer('selection')->nullable();
            $table->string('critical_illness_plan')->nullable();
            $table->string('medical_care_plan')->nullable();
            $table->boolean('critical_illness')->nullable();
            $table->boolean('health_care')->nullable();
            $table->string('hospital')->nullable();
            $table->string('room')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_needs');
    }
};
