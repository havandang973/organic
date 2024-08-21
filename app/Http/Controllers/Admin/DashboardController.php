<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Status;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\OrderDetail;
use Carbon\Carbon;
use App\Models\User;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

        $orders = $this->getOrders($start_date, $end_date);
        $qtyOrderComplete = $this->getOrderCount(Status::COMPLETED);
        $qtyOrderPending = $this->getOrderCount(Status::PENDING);
        $qtyOrderCancel = $this->getOrderCount(Status::CANCELED);

        $year_sales = $request->input('year_sales', date('Y'));
        $year_successful = $request->input('year_successful', date('Y'));
        $year_customers = $request->input('year_customers', date('Y'));

        $successfulOrders = $this->getSuccessfulOrdersByMonth($year_successful);
        $sales = $this->getSalesByMonth($year_sales);
        $customerRegistrations = $this->getCustomerRegistrationsByMonth($year_customers);

        $totalFormatted = $this->calculateTotalSales($start_date, $end_date);
        $salesMessage = "Tổng doanh số từ " . ($start_date ?? 'đầu') . " đến " . ($end_date ?? 'nay') . " là: " . $totalFormatted . " VNĐ";

        return view('admin.dashboard', compact(
            'orders', 
            'qtyOrderComplete', 
            'qtyOrderPending', 
            'qtyOrderCancel', 
            'totalFormatted', 
            'salesMessage', 
            'sales', 
            'successfulOrders', 
            'customerRegistrations'
        ));
    }

    private function getOrders($start_date, $end_date)
    {
        $query = Order::query();
        if ($start_date && $end_date) {
            $query->whereBetween('created_at', [$start_date, $end_date]);
        }
        return $query->latest('created_at')->paginate(5);
    }

    private function getOrderCount($status)
    {
        return Order::where('status', $status)->count();
    }

    private function getSuccessfulOrdersByMonth($year)
    {
        $successfulOrders = Order::selectRaw('MONTH(created_at) as month, COUNT(id) as count')
            ->whereYear('created_at', $year)
            ->where('status', 'completed')
            ->groupByRaw('MONTH(created_at)')
            ->pluck('count', 'month')
            ->toArray();

        return $this->fillMissingMonths($successfulOrders);
    }

    private function getSalesByMonth($year)
    {
        $sales = OrderDetail::selectRaw('MONTH(orders.created_at) as month, SUM(order_details.price * order_details.qty) as total_sales')
            ->join('orders', 'order_details.order_id', '=', 'orders.id')
            ->whereYear('orders.created_at', $year)
            ->where('orders.status', 'completed')
            ->groupByRaw('MONTH(orders.created_at)')
            ->pluck('total_sales', 'month')
            ->toArray();

        return $this->fillMissingMonths($sales);
    }

    private function getCustomerRegistrationsByMonth($year)
    {
        $customerRegistrations = User::selectRaw('MONTH(created_at) as month, COUNT(id) as count')
            ->whereYear('created_at', $year)
            ->groupByRaw('MONTH(created_at)')
            ->pluck('count', 'month')
            ->toArray();

        return $this->fillMissingMonths($customerRegistrations);
    }

    private function fillMissingMonths($data)
    {
        $allMonths = range(1, 12);
        foreach ($allMonths as $month) {
            $data[$month] = $data[$month] ?? 0;
        }
        ksort($data);
        return $data;
    }

    private function calculateTotalSales($start_date, $end_date)
    {
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

        return number_format($total, 0, ',', '.');
    }
}
