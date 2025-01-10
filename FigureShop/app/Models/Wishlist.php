<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
    ];

    // Mối quan hệ với User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Mối quan hệ với WishlistItem
    public function items()
    {
        return $this->hasMany(WishlistItem::class);
    }
}
