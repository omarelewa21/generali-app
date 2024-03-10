<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('session_storages', function (Blueprint $table) {
            $table->unsignedInteger('transaction_id')->unique()->default(1000)->after('id');
            $table->string('status')->default('draft')->after('data');
            $table->string('customer_id',15)->nullable()->after('status');
            $table->string('customer_name')->nullable()->after('customer_id');
            $table->unsignedBigInteger('agent_id')->nullable()->after('customer_name');
            $table->string('agent_name')->nullable()->after('agent_id');
            $table->string('session_id')->nullable()->after('agent_name');
            $table->softDeletes();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('session_storages', function (Blueprint $table) {
            $table->dropColumn('transaction_id');
            $table->dropColumn('customer_id');
            $table->dropColumn('customer_name');
            $table->dropColumn('agent_id');
            $table->dropColumn('agent_name');
        });
    }
};
