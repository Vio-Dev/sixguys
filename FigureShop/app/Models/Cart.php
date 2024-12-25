<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    // Các thuộc tính có thể được fill
    protected $fillable = [
        'user_id',
        'status',
    ];

    /**
     * Quan hệ: Một giỏ hàng có nhiều CartItem
     */
    public function items()
    {
        return $this->hasMany(CartItem::class);
    }

    /**
     * Quan hệ: Một giỏ hàng thuộc về một người dùng
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
