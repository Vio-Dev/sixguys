<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    // Các thuộc tính có thể được fill
    protected $fillable = [
        'user_id',
        'post_id',
        'product_id',
        'rating',
        'comment',
        'isHidden',
    ];

    /**
     * Quan hệ: Một rating thuộc về một user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Quan hệ: Một rating thuộc về một bài viết
     */
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    /**
     * Quan hệ: Một rating thuộc về một sản phẩm
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
