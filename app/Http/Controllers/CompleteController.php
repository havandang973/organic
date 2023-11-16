<?php

namespace App\Http\Controllers;

use App\Mail\OrderShipped;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Mail;

class CompleteController extends Controller
{
    public function index() {
        return view('complete');
    }

    public function store(Request $request) {

        $data = $request->all();
        $order = Order::query()->create($data);
        $carts = Cart::content();

        $email = $order->email;

//        dd($email);
        foreach ($carts as $cart) {
            $data = [
                'order_id' => $order->id,
                'product_id' => $cart->id,
                'qty' => $cart->qty,
                'amount' => $cart->price,
                'total' => $cart->qty * $cart->price,
            ];
        }

        OrderDetail::query()->create($data);

        Cart::destroy();

        Mail::to($email)->send(new OrderShipped());

        return redirect()->route('complete');
    }
}
