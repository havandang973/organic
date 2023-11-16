<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'thumbnail',
        'brand',
        'name',
        'price',
        'discount',
        'amount',
        'describe',
        'color',
        'origin',
        'max_amount'
    ];

    public function description()
    {
        return $this->hasOne(ProductDescription::class);
    }

    public function orderDetail()
    {
        return $this->hasMany(OrderDetail::class, 'product_id', 'id');
    }
}
