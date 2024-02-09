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
            $table->text('order_id_paypall')->nullable()->after('payment_url');
            $table->text('payer_id_paypall')->nullable()->after('order_id_paypall');
            $table->text('payment_id_paypall')->nullable()->after('payer_id_paypall');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropColumn('order_id_paypall');
            $table->dropColumn('payer_id_paypall');
            $table->dropColumn('payment_id_paypall');
        });
    }
};
