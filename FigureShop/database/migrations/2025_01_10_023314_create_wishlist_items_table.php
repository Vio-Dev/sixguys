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
        Schema::create('wishlist_items', function (Blueprint $table) {
           $table->id();
            $table->unsignedBigInteger('wishlist_id'); // Liên kết với giỏ hàng
            $table->unsignedBigInteger('product_id'); // Liên kết sản phẩm (sản phẩm chính)
            $table->unsignedBigInteger('product_variant_id')->nullable(); // Liên kết biến thể sản phẩm (nếu có)
            $table->timestamps();

            $table->foreign('wishlist_id')->references('id')->on('wishlists')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('product_variant_id')->references('id')->on('product_variants')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wishlist_items');
    }
};
