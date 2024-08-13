<?php

namespace App\Http\Controllers;

use App\Enums\Status;
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

    public function index(Request $request)
    {
        $id = Auth::user()->id;
        $addresses = $this->addressRepo->getAllAddressByUserId($id);
        $cartItems = Cart::content();

        if ($cartItems->isEmpty()) {
            return view('404-error');
        }

        if (!Auth::check()) {
            return redirect()->route('admin.login');
        }

        foreach ($cartItems as $item) {
            $maxQty = Product::find($item->id)->max_amount;
            if ($item->qty > $maxQty) {
                toastr()->warning('Sản phẩm trong giỏ hàng vượt quá số lượng trong kho.', ['timeOut' => 3000]);
                return view('cart-overview', compact('addresses'));
            }
        }

        return view('checkout', compact('addresses'));
    }

    //    public function store(Request $request) {
    //        $request->validate([
    //            'name' => 'required|',
    //            'address' => 'required|',
    //            'email' => 'required|email:rfc,dns',
    //            'phone' => 'required|numeric|',
    //        ]);
    //
    //        $data = $request->all();
    ////        Order::query()->create($data);
    //        return view('order', compact('data'));
    //    }

    public function showOrder(Request $request)
    {
        $query = Order::query()->where('user_id', auth()->id())->latest('created_at');

        //        dd($query);
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        if ($request->has('start_date') && $request->start_date != '') {
            $query->whereDate('created_at', '>=', $request->start_date);
        }

        if ($request->has('end_date') && $request->end_date != '') {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        $orders = $query->paginate(5);

        return view('order', compact('orders'));
    }

    public function showOrderDetail($orderId)
    {
        $order = Order::with('orderDetail')->where('id', $orderId)->latest('created_at')->firstOrFail();

        return view('order-details', compact('order'));
    }

    public function canceledOrder(Request $request, $orderId)
    {
        $order = Order::query()->where('id', $orderId)->first();

        if ($order->status === Status::PENDING) {
            $order->status = Status::CANCELED;
            $order->save();

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Không thể hủy đơn hàng.']);
    }

    public function checkOrderStatus()
    {
        $orders = Order::query()->where('user_id', auth()->id())->latest('created_at')->get();
        return response()->json(['orders' => $orders]);
    }

    public function checkOrderNew()
    {
        $newOrders = Order::where('created_at', '>', now()->subSecond(20))->count();
        return response()->json(['newOrders' => $newOrders,  'checkedAt' => now()->toDateTimeString()]);
    }
}
