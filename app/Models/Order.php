<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_code',
        'name',
        'address',
        'email',
        'phone',
        'status',
        'payment_method',
        'note',
        'user_id'
    ];

    public function orderDetail() {
        return $this->hasMany(OrderDetail::class, 'order_id', 'id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
