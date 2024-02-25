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
        Schema::create('discount_cupons', function (Blueprint $table) {
            $table->id();
            $table->string('name', 120)->unique();
            $table->text('description');
            $table->enum('type', ['FIXED_VALUE', 'PERCENTAGE']);
            $table->unsignedFloat('value')->default(0);
            $table->unsignedFloat('min_value')->default(0);
            $table->unsignedInteger('usage_limit')->default(0);
            $table->unsignedInteger('usage')->default(0);
            $table->dateTime('valid_from');
            $table->dateTime('valid_until');
            $table->foreignId('category_id')->nullable()->constrained('categories')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreignId('brand_id')->nullable()->constrained('brands')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreignId('promotion_id')->nullable()->constrained('promotions')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('discount_cupons');
    }
};
