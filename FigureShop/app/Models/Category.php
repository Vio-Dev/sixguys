<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Category extends Model
{
    protected $filerable = ['name', 'shortDecription', "description", "status", "isDeleted", "thumbnail", "user_id"];
    public function product()
    {
        return $this->hasMany(Product::class);
    }
    public $timestamps = false;
}
