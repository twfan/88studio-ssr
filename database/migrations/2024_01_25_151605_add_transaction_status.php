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
        Schema::table('transactions', function (Blueprint $table) {
            $table->string('payment')->default('unpaid')->after('payment_method');
            $table->enum('status',['new', 'ready', 'wip', 'waitlist', 'client_to_do', 'paused', 'completed', 'archived'])->default('new')->after('payment_url');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            // $table->dropColumn('payment');
            $table->dropColumn('status');
        });
    }
};
