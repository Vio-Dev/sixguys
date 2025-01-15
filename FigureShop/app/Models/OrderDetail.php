<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $table = 'order_detail';

    protected $fillable = [
        'order_id',
        'product_id',
        'product_variant_id',
        'quantity',
        'price',
    ];

    // Define the relationship with the Order model
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    // Define the relationship with the Product model

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    // Define the relationship with the ProductVariant model
    public function productVariant()
    {
        return $this->belongsTo(ProductVariant::class, 'product_variant_id');
    }
}
