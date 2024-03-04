<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cart_id')->constrained('carts', 'id')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreignId('product_id')->constrained('products', 'id')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->unsignedTinyInteger('quantity');
            $table->unsignedDecimal('item_price')->nullable();
            $table->foreignId('discount_cupon_id')->nullable()->constrained('discount_cupons', 'id')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart_items');
    }
};
