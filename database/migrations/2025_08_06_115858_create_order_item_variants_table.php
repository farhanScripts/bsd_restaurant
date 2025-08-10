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
        Schema::create('order_item_variants', function (Blueprint $table) {
            $table->id()
                ->comment('Record ID');

            $table->foreignId('order_item_id')
                ->constrained('order_items')
                ->onDelete('cascade')
                ->comment('Order item reference');

            $table->foreignId('variant_id')
                ->constrained('menu_item_variants')
                ->onDelete('restrict')
                ->comment('Variant reference');

            $table->string('variant_name', 255)
                ->comment('Variant name (snapshot for order history)');

            $table->string('variant_type', 50)
                ->comment('Variant type (snapshot - size, crust, extras, etc.)');

            $table->decimal('price_modifier', 8, 2)
                ->comment('Price adjustment (snapshot for order history)');

            $table->timestamp('created_at')
                ->useCurrent()
                ->comment('Creation date');

            // Indexes for better query performance
            $table->index('order_item_id');
            $table->index('variant_id');
            $table->index(['order_item_id', 'variant_type'], 'idx_order_item_variant_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_item_variants');
    }
};
