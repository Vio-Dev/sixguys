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
        Schema::create('posts', function (Blueprint $table) {
            $table->id(); // Tạo một cột ID tự tăng
            $table->string('name', 100)->unique();
            $table->string('shortDecription', 150);
            $table->text('description');
            $table->unsignedBigInteger('user_id');
            $table->string('status');
            $table->string('thumbnail')->nullable();
            $table->string('isDeleted')->default(false);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
