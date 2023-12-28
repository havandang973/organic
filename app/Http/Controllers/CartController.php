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
        $amount = $request->input('amount');

        $product = $this->productRepo->getProductById($id);

        (new CartService())->addProductCart($product, $amount);

        return response()->json(['cartCount' => Cart::count(), 'cartContent' => Cart::content(), 'total' => Cart::total()]);
    }

    public function delete($rowId)
    {
        (new CartService())->deleteProduct($rowId);
        return response()->json(['cartCount' => Cart::count(), 'total' => Cart::total()]);
    }

    public function update(Request $request)
    {
        $data = $request->input('qty');

        foreach ($data as $rowId=>$value) {
            (new CartService())->updateProduct($rowId, $value);
        }
        return response()->json(['cartCount' => Cart::count(), 'total' => Cart::total()]);


    }


}
