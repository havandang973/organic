<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::paginate(5);
        return view('admin.list.order', compact('orders'));
    }

    public function delete(Request $request, $orderId)
    {
        $order = Order::query()->find($orderId)->first();

        $order->delete();

        toastr()->success('Xóa đơn hàng thành công', ['timeOut' => 2000]);
        return redirect()->back();
    }
}
