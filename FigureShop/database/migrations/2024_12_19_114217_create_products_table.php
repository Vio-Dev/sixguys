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
            $table->string('name');
            $table->integer('price');
            $table->integer('inStock');
            $table->integer('unit');
            $table->integer('discount')->default(0);
            $table->integer('hasSold')->default(0);
            $table->text('description');
            $table->text('shortDescription');
            $table->string('thumbnail');
            $table->string("status")->default("active");
            $table->boolean("isDeleted")->default(false);
            $table->unsignedBigInteger('category_id');

            $table->foreign('category_id')->references('id')->on('categories');
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
