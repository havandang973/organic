<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Status;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\OrderDetail;

class DashboardController extends Controller
{
    public function index(Request $request) {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

        $query = Order::query();

        if ($start_date && $end_date) {
            $query->whereBetween('created_at', [$start_date, $end_date]);
        }

        $orders = $query->latest('created_at')->paginate(5);

        $qtyOrderComplete = Order::where('status', Status::COMPLETED)->count();
        $qtyOrderPending = Order::where('status', Status::PENDING)->count();
        $qtyOrderCancel = Order::where('status', Status::CANCELED)->count();

        // Tính toán doanh số trong khoảng thời gian đã chọn
        $orderCompletes = Order::where('status', Status::COMPLETED);
        if ($start_date && $end_date) {
            $orderCompletes->whereBetween('created_at', [$start_date, $end_date]);
        }
        $orderCompletes = $orderCompletes->get();

        $productCompletes = OrderDetail::whereIn('order_id', $orderCompletes->pluck('id'))->get();

        $total = 0;
        foreach ($productCompletes as $productComplete) {
            $total += $productComplete->total;
        }

        $totalFormatted = number_format($total, 0, ',', '.');

        // Tạo thông báo doanh số
        $salesMessage = "Tổng doanh số từ " . ($start_date ?? 'đầu') . " đến " . ($end_date ?? 'nay') . " là: " . $totalFormatted . " VNĐ";

        return view('admin.dashboard', compact('orders', 'qtyOrderComplete', 'qtyOrderPending', 'qtyOrderCancel', 'totalFormatted', 'salesMessage'));
    }
}
