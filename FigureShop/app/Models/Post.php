<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'name',
        'shortDecription',
        'description',
        'status',
        'user_id',
        'thumbnail',
        'isDeleted',
    ];
    function user()
    {
        return $this->belongsTo(User::class);
    }
   public $timestamps = true;
}
