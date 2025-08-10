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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id()
                ->comment('Item ID');

            $table->foreignId('order_id')
                ->constrained('orders')
                ->onDelete('cascade')
                ->comment('Order reference');

            $table->foreignId('menu_item_id')
                ->constrained('menu_items')
                ->onDelete('restrict')
                ->comment('Menu item reference');

            $table->string('name', 255)
                ->comment('Item name (snapshot for order history)');

            $table->integer('quantity')
                ->default(1)
                ->comment('Ordered quantity');

            $table->decimal('unit_price', 10, 2)
                ->comment('Price per unit (before variants)');

            $table->decimal('total_price', 10, 2)
                ->comment('Line total (unit_price × quantity, before variants)');

            $table->text('special_instructions')
                ->nullable()
                ->comment('Item-specific notes or requests');

            $table->timestamp('created_at')
                ->useCurrent()
                ->comment('Creation date');

            $table->timestamp('updated_at')
                ->useCurrent()
                ->useCurrentOnUpdate()
                ->comment('Last update');

            // Indexes for better query performance
            $table->index('order_id');
            $table->index('menu_item_id');
            $table->index(['order_id', 'menu_item_id'], 'idx_order_menu_item');

            // Check constraints for business rules
            // $table->check('quantity > 0', 'chk_positive_quantity');
            // $table->check('unit_price >= 0', 'chk_non_negative_unit_price');
            // $table->check('total_price >= 0', 'chk_non_negative_total_price');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
