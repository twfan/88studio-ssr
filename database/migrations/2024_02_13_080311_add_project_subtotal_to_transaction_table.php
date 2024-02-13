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
            $table->decimal('proposal_project_subtotal', 10, 2)->default(0)->after('grand_total');
            $table->decimal('proposal_project_discount', 10, 2)->default(0)->after('proposal_project_subtotal');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropColumn('proposal_project_subtotal');
            $table->dropColumn('proposal_project_discount');
        });
    }
};
