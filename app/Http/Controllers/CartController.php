<?php

namespace App\Http\Controllers;

//use App\Models\Cart;
use App\Models\Product;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Services\CartService;
class CartController extends Controller
{

    public function __construct(ProductRepository $productRepo)
    {
        $this->productRepo = $productRepo;
    }

    public function add(Request $request, $id)
    {
//        dd($request);
//        Cart::destroy();
        $amount = $request->input('amount');

        $product = $this->productRepo->getProductById($id);

        (new CartService())->addProductCart($product, $amount);

        $cartCount = Cart::count();

        $cartContent = Cart::content();

        return response()->json(['cartCount' => $cartCount, 'cartContent' => $cartContent]);

//        return redirect()->back();

//        $product = Product::find($id);
//        Cart::add([
//            'id' => $product->id,
//            'name' => $product->name,
//            'qty' => $product->amount,
//            'price' => $product->price - (($product->price * $product->discount)/100),
//            'options' => ['thumbnail' => $product->thumbnail, 'discount' => $product->price - (($product->price * $product->discount)/100)]
//        ]);

//        foreach(Cart::content() as $row) {
//            dd($row->options->discount);
//        }
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

        toastr()->success('Cập nhật giỏ hàng thành công', ['timeOut' => 2000]);
        return redirect('cart');
    }


}
