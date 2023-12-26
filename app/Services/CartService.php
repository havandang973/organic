<?php

namespace App\Services;

use Gloudemans\Shoppingcart\Facades\Cart;
use App\Repositories\ProductRepository;

/**
 * Class CartService.
 */
class CartService
{

//    public function __construct(
//        protected ProductRepository $products,
//    ) {}

    public function addProductCart($product, $amount)
    {
        return Cart::add([
            'id' => $product->id,
            'name' => $product->name,
            'qty' => $amount,
            'price' => $product->price - (($product->price * $product->discount)/100),
            'options' => ['thumbnail' => $product->thumbnail, 'discount' => $product->price - (($product->price * $product->discount)/100)]
        ]);
    }


}
