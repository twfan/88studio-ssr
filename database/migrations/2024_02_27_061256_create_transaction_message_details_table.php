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
        Schema::create('transaction_message_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaction_message_id')->constrained('transaction_messages')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->nullable();
            $table->text('message');
            $table->text('attachment');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_message_details');
    }
};
