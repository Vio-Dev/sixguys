<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    // Các thuộc tính có thể được fill
    protected $fillable = [
        'user_id',
        'content',
        'post_id',
        'product_id',
        'parent_id',
        'isHidden',
    ];

    /**
     * Quan hệ: Một comment thuộc về một user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Quan hệ: Một comment thuộc về một bài viết
     */
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    /**
     * Quan hệ: Một comment thuộc về một sản phẩm
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Quan hệ: Một comment có thể có nhiều replies (comment con)
     */
    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }

    /**
     * Quan hệ: Một comment có thể thuộc về một comment cha
     */
    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }
}
