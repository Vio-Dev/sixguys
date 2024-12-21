<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['name', 'isDeleted', 'user_id', 'shortDecription', 'description', 'status', 'thumbnail'];
    function user()
    {
        return $this->belongsTo(User::class);
    }
    public $timestamps = true;
}