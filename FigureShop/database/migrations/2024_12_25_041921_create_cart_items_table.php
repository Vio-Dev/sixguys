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
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cart_id'); // Liên kết với giỏ hàng
            $table->unsignedBigInteger('product_id'); // Liên kết sản phẩm (sản phẩm chính)
            $table->unsignedBigInteger('product_variant_id')->nullable(); // Liên kết biến thể sản phẩm (nếu có)
            $table->integer('quantity'); // Số lượng
            $table->decimal('price', 11, 2); // Giá tại thời điểm thêm vào giỏ
            $table->timestamps();

            $table->foreign('cart_id')->references('id')->on('carts')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('product_variant_id')->references('id')->on('product_variants')->onDelete('cascade');
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
