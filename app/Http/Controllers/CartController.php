<?php

namespace App\Http\Controllers;

//use App\Models\Cart;
use App\Models\Product;
use App\Repositories\AddressRepository;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Services\CartService;
class CartController extends Controller
{

    public function __construct(ProductRepository $productRepo, AddressRepository $addressRepo)
    {
        $this->productRepo = $productRepo;
        $this->addressRepo = $addressRepo;
    }

    public function index() {
        if (!Auth::check()) {
            return view('auth.login');
        }

        $id = Auth::user()->id;
        $addresses = $this->addressRepo->getAllAddressByUserId($id);
        return view('cart', compact('addresses'));
    }

    public function add(Request $request, $id)
    {
        $product = $this->productRepo->getProductById($id);

        $messages = [
            'amount.required' => 'Vui lòng nhập số lượng.',
            'amount.min' => 'Số lượng nhỏ nhất là 1.',
            'amount.numeric' => 'Số lượng phải là số.',
            'amount.max' => 'Số lượng tối đa là :max.'
        ];

        $request->validate([
            'amount' => ['required', 'min:1', 'numeric', 'max:' . $product->max_amount],
        ], $messages);

        $amount = $request->input('amount');

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

        $request->validate([
            'qty.*' => 'numeric|min:1|max:20',
        ]);

        foreach ($data as $rowId=>$value) {
            (new CartService())->updateProduct($rowId, $value);
        }
        return response()->json(['cartCount' => Cart::count(), 'total' => Cart::total()]);
    }
}
