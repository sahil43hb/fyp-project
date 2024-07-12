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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('sku')->unique();
            $table->integer('price');
            $table->integer('size_no');
            $table->foreignId('category_id')->constrained('categories');
            $table->foreignId('sub_categories_id')->constrained('sub_categories');
            $table->foreignId('brands_id')->constrained('brands');
            $table->enum('sale', ['0', '1'])->default('0');
            $table->enum('new_collection', ['0', '1'])->default('0');
            $table->enum('seasonability', ['winter', 'summer', 'yearly'])->default('yearly');
            $table->string('description', 1024)->nullable();
            $table->integer('discount')->nullable();
            $table->string('product_image');
            $table->integer('quantity')->default(3);
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
