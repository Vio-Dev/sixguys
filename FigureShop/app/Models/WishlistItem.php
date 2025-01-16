<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WishlistItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'wishlists_id',
        'product_id',

    ];

    // Mối quan hệ với Wishlist
    public function wishlist()
    {
        return $this->belongsTo(Wishlist::class, 'wishlists_id');
    }

    // Mối quan hệ với Product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Mối quan hệ với ProductVariant
    public function productVariant()
    {
        return $this->belongsTo(ProductVariant::class);
    }
}

