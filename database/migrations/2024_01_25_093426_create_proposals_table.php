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
        Schema::create('proposals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('transaction_id')->nullable();
            $table->text('social_media')->nullable();
            $table->string('use_for')->nullable();
            $table->string('use_for_other')->nullable();
            $table->string('reference')->nullable();
            $table->string('date')->nullable();
            $table->string('previous_work')->nullable();
            $table->foreignId('discount_id')->nullable();
            $table->enum('status', ['declined', 'accepted', 'pending', 'archived'])->default('pending');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proposals');
    }
};
