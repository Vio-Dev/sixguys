<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    // Các thuộc tính có thể được fill
    protected $fillable = [
        'cart_id',
        'product_id',
        // 'product_variant_id',
        'quantity',
        'price',
    ];

    /**
     * Quan hệ: Một CartItem thuộc về một Cart
     */
    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    /**
     * Quan hệ: Một CartItem liên kết với một sản phẩm
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Quan hệ: Một CartItem có thể liên kết với một ProductVariant (nếu có)
     */
    public function productVariant()
    {
        return $this->belongsTo(ProductVariant::class);
    }
}
