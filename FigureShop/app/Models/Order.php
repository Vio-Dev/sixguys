<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'order';

    protected $fillable = [
        'users_id',
        'order_date',
        'total',
        'status',
        'payment_method',
        'note',
        'isDeleted',
        'isPaid'
    ];

    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    // Define the relationship with the OrderDetail model
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'order_id');
    }
}
