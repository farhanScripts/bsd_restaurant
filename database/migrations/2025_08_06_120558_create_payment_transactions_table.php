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
        Schema::create('payment_transactions', function (Blueprint $table) {
            $table->id()
                ->comment('Transaction ID');

            $table->foreignId('order_id')
                ->constrained('orders')
                ->onDelete('restrict')
                ->comment('Order reference');

            $table->string('transaction_id', 255)
                ->unique()
                ->comment('Midtrans transaction ID');

            $table->string('payment_method', 50)
                ->comment('Payment method used (credit_card, gopay, bank_transfer, etc.)');

            $table->decimal('amount', 10, 2)
                ->comment('Transaction amount in IDR');

            $table->enum('status', ['pending', 'success', 'failed', 'cancelled', 'expired'])
                ->comment('Transaction status from Midtrans');

            $table->json('midtrans_response')
                ->nullable()
                ->comment('Complete Midtrans response for debugging');

            $table->timestamp('paid_at')
                ->nullable()
                ->comment('Payment completion timestamp');

            $table->timestamp('created_at')
                ->useCurrent()
                ->comment('Transaction creation date');

            $table->timestamp('updated_at')
                ->useCurrent()
                ->useCurrentOnUpdate()
                ->comment('Last update timestamp');

            // Indexes for better query performance
            $table->index('order_id');
            $table->index('transaction_id');
            $table->index(['order_id', 'status'], 'idx_order_payment_status');
            $table->index(['status', 'created_at'], 'idx_payment_status_timeline');
            $table->index('payment_method');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_transactions');
    }
};
