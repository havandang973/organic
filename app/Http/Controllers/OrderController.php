<?php

namespace App\Http\Controllers;

use App\Mail\OrderShipped;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Services\CartService;
use Illuminate\Support\Facades\Auth;
use App\Repositories\AddressRepository;
use App\Repositories\ProductRepository;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    private $addressRepo;

    public function __construct(ProductRepository $productRepo, AddressRepository $addressRepo)
    {
        $this->productRepo = $productRepo;
        $this->addressRepo = $addressRepo;
    }

    public function index(Request $request) {
        if (!Auth::check()) {
            return redirect()->route('admin.login');
        }

        $id = Auth::user()->id;
        $addresses = $this->addressRepo->getAllAddressByUserId($id);
        $cartItems = Cart::content();

        foreach ($cartItems as $item) {
            $maxQty = Product::find($item->id)->max_amount;
            if ($item->qty > $maxQty) {
                toastr()->warning('Sản phẩm trong giỏ hàng vượt quá số lượng trong kho.', ['timeOut' => 3000]);
                return view('cart-overview', compact('addresses'));
            }
        }

        return view('checkout', compact('addresses'));
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|',
            'address' => 'required|',
            'email' => 'required|email:rfc,dns',
            'phone' => 'required|numeric|',
        ]);

        $data = $request->all();
//        Order::query()->create($data);
        return view('order', compact('data'));
    }
}
