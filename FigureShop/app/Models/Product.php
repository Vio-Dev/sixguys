<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
    protected $fillable = [
        'name',
        'price',
        'inStock',
        'unit',
        'discount',
        'hasSold',
        'description',
        'shortDescription',
        'thumbnail',
        'status',
        'isDeleted',
        'category_id'
    ];

    // Define the relationship with the Category model
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function images()
    {
        return $this->hasMany(Media::class);
    }
    public function subCategory()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }
}
