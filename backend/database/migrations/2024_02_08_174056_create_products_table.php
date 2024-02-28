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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')
                ->constrained('categories')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreignId('brand_id')->constrained('brands')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->string('name', 255);
            $table->integer('stock');
            $table->decimal('price');
            $table->string('slug')->unique();
            $table->decimal('weight');
            $table->decimal('height', 8, 2);
            $table->decimal('width', 8, 2);
            $table->decimal('length', 8, 2);
            $table->string('image');
            $table->decimal('rating', 4, 2);
            $table->integer('reviews')->default(0);
            $table->integer('discount');
            $table->boolean('is_flash_sale')->default(false);
            $table->integer('max_quantity')->default(10);
            $table->string('sku')->default(0);
            $table->integer('sold')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
