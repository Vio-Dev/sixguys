<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    public $filerable = [
        'url_img',
        'alt_img',
        'number',
        'product_id'
    ];
    function product()
    {
        return $this->belongsTo(Product::class);
    }
}
