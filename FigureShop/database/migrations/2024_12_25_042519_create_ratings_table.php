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
        Schema::create('ratings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Người dùng thực hiện đánh giá
            $table->unsignedBigInteger('post_id')->nullable(); // Liên kết đến bài đăng (nếu đánh giá bài viết)
            $table->unsignedBigInteger('product_id')->nullable(); // Liên kết đến sản phẩm (nếu đánh giá sản phẩm)
            $table->integer('rating')->default(1); // Điểm đánh giá (1-5 sao)
            $table->text('comment')->nullable(); // Bình luận kèm theo đánh giá (nếu có)
            $table->boolean('isHidden')->default(false); // Trạng thái duyệt đánh giá
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ratings');
    }
};
