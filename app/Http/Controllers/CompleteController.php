<?php

namespace App\Http\Controllers;

use App\Mail\OrderShipped;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Repositories\AddressRepository;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\MessageBag;
use function PHPSTORM_META\map;

class CompleteController extends Controller
{
    public function __construct(ProductRepository $productRepo, AddressRepository $addressRepo)
    {
        $this->addressRepo = $addressRepo;
    }

    public function index() {
        return view('complete');
    }

    public function store(Request $request) {
        $data = $request->all();
        $order = Order::query()->create($data);
        $carts = Cart::content();
        $email = $order->email;

//        dd($carts);
        foreach ($carts as $cart) {
            $maxAmount= Product::query()->where('id', '=', $cart->id)->value('max_amount');

            if ($maxAmount < $cart->qty) {
                $id = Auth::user()->id;

                toastr()->warning('Sản phẩm trong giỏ hàng đã hết.', ['timeOut' => 3000]);
                $addresses = $this->addressRepo->getAllAddressByUserId($id);
                return view('cart', compact('addresses'));
            }

            $data = [
                'order_id' => $order->id,
                'product_id' => $cart->id,
                'qty' => $cart->qty,
                'max_amount' => $maxAmount-$cart->qty,
                'price' => $cart->price,
                'total' => $cart->qty * $cart->price,
            ];

            Product::query()->where('id', '=', $cart->id)->update(['max_amount' => $maxAmount-$cart->qty]);
            OrderDetail::query()->create($data);
        }

        $products = OrderDetail::query()->where('order_id', $data['order_id'])->get();

        Mail::to($email)->send(new OrderShipped($products, $order));

        Cart::destroy();

        return redirect()->route('complete');
    }
}
