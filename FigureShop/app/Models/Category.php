<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Category extends Model
{
    // Danh sách các trường cho phép gán giá trị hàng loạt
    protected $fillable = ['name', 'isDeleted'];

    public function product()
    {
        return $this->hasMany(Product::class);
    }

    public $timestamps = true;
}