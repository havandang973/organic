<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Status;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\OrderDetail;

class DashboardController extends Controller
{
    public function index() {
        $orders = Order::query()->latest('created_at')->paginate(5);

        $qtyOrderComplete = Order::query()->where('status', Status::COMPLETED)->count();
        $qtyOrderPending = Order::query()->where('status', Status::PENDING)->count();
        $qtyOrderCancel = Order::query()->where('status', Status::CANCELED)->count();

        $orderCompletes = Order::query()->where('status', Status::COMPLETED)->get();
        $productCompletes = OrderDetail::whereIn('order_id', $orderCompletes->pluck('id'))->get();

        $total = 0;
        foreach ($productCompletes as $productComplete) {
            $total = $productComplete->total + $total;
        }

        $total = number_format($total, 0, ',', '.');

        return view('admin.dashboard', compact('orders', 'qtyOrderComplete', 'qtyOrderPending', 'qtyOrderCancel', 'total'));
    }
}
