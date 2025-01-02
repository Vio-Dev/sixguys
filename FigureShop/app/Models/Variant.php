<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variant extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'isDeleted'];

public function values()
{
    return $this->hasMany(VariantValue::class)->where('isDeleted', 0);
}

public function deletedValues()
{
    return $this->hasMany(VariantValue::class)->where('isDeleted', 1);
}
   public function variantValue()
    {
        return $this->belongsTo(VariantValue::class);
    }

}
