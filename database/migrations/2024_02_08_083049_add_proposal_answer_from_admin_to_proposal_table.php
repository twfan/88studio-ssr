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
        Schema::table('proposals', function (Blueprint $table) {
            $table->text('scope')->nullable()->after('discount_id');
            $table->date('estimated_start')->nullable()->after('scope');
            $table->date('guaranteed_delivery')->nullable()->after('estimated_start');
            $table->decimal('project_subtotal', 10, 2)->nullable()->after('guaranteed_delivery');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('proposals', function (Blueprint $table) {
            $table->dropColumn('scope');
            $table->dropColumn('estimated_start');
            $table->dropColumn('guaranteed_delivery');
            $table->dropColumn('project_subtotal');
        });
    }
};
