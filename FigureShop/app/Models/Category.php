<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Category extends Model
{
    // Danh sách các trường cho phép gán giá trị hàng loạt
    protected $fillable = ['name', 'isDeleted', 'parent_id'];

    public function product()
    {
        return $this->hasMany(Product::class);
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    // Quan hệ danh mục con
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public $timestamps = true;
}
