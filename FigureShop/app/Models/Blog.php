<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $filerable = ['name', 'isDeleted'];
    function user()
    {
        return $this->belongsTo(User::class);
    }
}
