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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Người dùng thực hiện bình luận
            $table->text('content'); // Nội dung bình luận
            $table->unsignedBigInteger('post_id')->nullable(); // Liên kết đến bài đăng (nếu là bình luận bài viết)
            $table->unsignedBigInteger('product_id')->nullable(); // Liên kết đến sản phẩm (nếu là bình luận sản phẩm)
            $table->unsignedBigInteger('parent_id')->nullable(); // Liên kết đến bình luận cha (dành cho bình luận lồng nhau)
            $table->boolean('isHidden')->default(false); // Trạng thái duyệt bình luận
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('parent_id')->references('id')->on('comments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
