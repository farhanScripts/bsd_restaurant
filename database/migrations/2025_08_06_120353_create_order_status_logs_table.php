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
        Schema::create('order_status_logs', function (Blueprint $table) {
            $table->id()
                ->comment('Log ID');

            $table->foreignId('order_id')
                ->constrained('orders')
                ->onDelete('cascade')
                ->comment('Order reference');

            $table->string('status_from', 50)
                ->nullable()
                ->comment('Previous status (null for initial status)');

            $table->string('status_to', 50)
                ->comment('New status');

            $table->foreignId('updated_by')
                ->constrained('users')
                ->onDelete('restrict')
                ->comment('Staff who updated the status');

            $table->text('notes')
                ->nullable()
                ->comment('Additional notes about the status change');

            $table->timestamp('created_at')
                ->useCurrent()
                ->comment('Status change timestamp');

            // Indexes for better query performance
            $table->index('order_id');
            $table->index('updated_by');
            $table->index(['order_id', 'created_at'], 'idx_order_status_timeline');
            $table->index(['status_to', 'created_at'], 'idx_status_timeline');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_status_logs');
    }
};
