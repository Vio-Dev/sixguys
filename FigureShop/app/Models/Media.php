<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $fillable = ['product_id', 'url_img', 'alt_img', 'number'];

    function product()
    {
        return $this->belongsTo(Product::class);
    }
}