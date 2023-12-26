<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrderDetail;
use Illuminate\Http\Request;

class OrderDetailController extends Controller
{
    public function index($orderId) {
        $order_details = OrderDetail::query()->where('order_id', $orderId)->get();
//        dd($order_details);
        return view('admin.list.orderDetail', compact('order_details'));
    }
}
