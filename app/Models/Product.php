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
        'brand_id',
        'name',
        'price',
        'discount',
        'amount',
        'describe',
        'color',
        'origin',
        'max_amount',
        'category_id'
    ];

    public function description()
    {
        return $this->hasOne(ProductDescription::class);
    }

    public function orderDetail()
    {
        return $this->hasMany(OrderDetail::class, 'product_id', 'id');
    }

    public function compareProducts()
    {
        return $this->hasMany(CompareProduct::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
