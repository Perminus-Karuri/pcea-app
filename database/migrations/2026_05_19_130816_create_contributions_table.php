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
        Schema::create('contributions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('contribution_type_id')->constrained()->cascadeOnDelete();
            $table->string('phone');
            $table->decimal('amount', 10, 2);
            $table->string('status')->default('pending');
            $table->string('mpesa_receipt_number')->nullable();
            $table->string('checkout_request_id')->nullable();
            $table->timestamp('transaction_date')->nullabe();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contributions');
    }
};
