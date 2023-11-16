<?php

namespace App\Http\Controllers;

//use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;
class CartController extends Controller
{
    public function add(Request $request, $id)
    {
//        Cart::destroy();
        $product = Product::find($id);

        Cart::add([
            'id' => $product->id,
            'name' => $product->name,
            'qty' => $product->amount,
            'price' => $product->price - (($product->price * $product->discount)/100),
            'options' => ['thumbnail' => $product->thumbnail, 'discount' => $product->price - (($product->price * $product->discount)/100)]
        ]);

        return redirect('cart');
    }

    public function delete($rowId)
    {
        Cart::remove($rowId);
        return redirect()->back();
    }

    public function update(Request $request)
    {
        $data = $request->input('qty');

        foreach ($data as $k=>$v) {
            Cart::update($k, $v);
        }
        return redirect('cart');
    }


}
