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
        Schema::table('transaction_messages', function (Blueprint $table) {
            $table->boolean('seen_customer')->default(false)->after('channel');
            $table->boolean('seen_admin')->default(false)->after('seen_customer');
            $table->string('last_chat_from')->nullable()->after('seen_admin');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transaction_messages', function (Blueprint $table) {
            $table->dropColumn('seen_customer');
            $table->dropColumn('seen_admin');
            $table->dropColumn('last_chat_from');
        });
    }
};
