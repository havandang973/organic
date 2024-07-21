<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'email',
        'phone',
        'status',
        'payment_method',
        'note'
    ];

    public function orderDetail() {
        return $this->hasMany(OrderDetail::class, 'order_id', 'id');
    }
}
