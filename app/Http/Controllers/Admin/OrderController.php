<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Transaction;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\App;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::query();

        if ($request->filled('order_code')) {
            $query->where('order_code', 'like', '%' . $request->order_code . '%');
        }

        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->email . '%');
        }

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->filled('address')) {
            $query->where('address', 'like', '%' . $request->address . '%');
        }

        if ($request->filled('phone')) {
            $query->where('phone', 'like', '%' . $request->phone . '%');
        }

        if ($request->filled('payment_method')) {
            $query->whereRaw(
                'JSON_UNQUOTE(JSON_EXTRACT(payment_method, "$.method")) = ?',
                [$request->payment_method]
            );
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('from_date')) {
            try {
                $query->whereDate('created_at', '>=', $request->from_date);
            } catch (\Exception $e) {
                // handle exception if from_date is not a valid date
            }
        }

        if ($request->filled('to_date')) {
            try {
                $query->whereDate('created_at', '<=', $request->to_date);
            } catch (\Exception $e) {
                // handle exception if to_date is not a valid date
            }
        }

        $orders = $query->latest('created_at')->paginate(5);

        foreach ($orders as $order) {
            $order_details = OrderDetail::query()
            ->where('order_id', $order->id)
            ->with(['product' => function($query) {
                $query->withTrashed(); // Bao gồm sản phẩm đã bị xóa mềm
            }])
            ->get();

            // dd($order_details);
            $order->payment_method === Transaction::ONLINE ? $order->payment_method = json_decode($order->payment_method, true) : '';

            $totalAll = 0;
            foreach ($order_details as $order_detail) {
                $price = $order_detail->product->price - (($order_detail->product->price * $order_detail->product->discount) / 100);
                $total = $order_detail->qty * $price;
                $totalAll += $total;
            }
            $order->total_amount = $totalAll;
        }

        return view('admin.list.order', compact('orders'));
    }

    public function delete(Request $request, $orderCode)
    {
        $order = Order::query()->where('order_code', $orderCode)->first();

        $order->delete();

        return redirect()->back()->with('success', 'Xóa đơn hàng thành công');
    }

    public function edit(Request $request, $orderId)
    {
        $order = Order::query()->findOrFail($orderId);
        $order->status = $request->input('status');
        $order->save();

        return response()->json(['message' => 'Trạng thái đơn hàng đã được cập nhật thành công.']);
    }

    public function generateInvoice($id)
    {
        $order = Order::findOrFail($id);
        $pdf = PDF::loadView('admin.invoice', compact('order', 'order'));

        return $pdf->stream();
        //        return $pdf->download('invoice.pdf');
    }

    public function orderPrint(Request $request)
    {   
        $query = Order::query();

        if ($request->filled('order_code')) {
            $query->where('order_code', 'like', '%' . $request->order_code . '%');
        }

        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->email . '%');
        }

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->filled('address')) {
            $query->where('address', 'like', '%' . $request->address . '%');
        }

        if ($request->filled('phone')) {
            $query->where('phone', 'like', '%' . $request->phone . '%');
        }

        if ($request->filled('payment_method')) {
            $query->whereRaw(
                'JSON_UNQUOTE(JSON_EXTRACT(payment_method, "$.method")) = ?',
                [$request->payment_method]
            );        
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('from_date')) {
            try {
                $query->whereDate('created_at', '>=', $request->from_date);
            } catch (\Exception $e) {
                // handle exception if from_date is not a valid date
            }
        }

        if ($request->filled('to_date')) {
            try {
                $query->whereDate('created_at', '<=', $request->to_date);
            } catch (\Exception $e) {
                // handle exception if to_date is not a valid date
            }
        }

        $orders = $query->latest('created_at')->get();

        foreach ($orders as $order) {
            $order_details = OrderDetail::query()
            ->where('order_id', $order->id)
            ->with(['product' => function($query) {
                $query->withTrashed(); // Bao gồm sản phẩm đã bị xóa mềm
            }])
            ->get();

            // dd($order_details);
            $order->payment_method === Transaction::ONLINE ? $order->payment_method = json_decode($order->payment_method, true) : '';

            $totalAll = 0;
            foreach ($order_details as $order_detail) {
                $price = $order_detail->product->price - (($order_detail->product->price * $order_detail->product->discount) / 100);
                $total = $order_detail->qty * $price;
                $totalAll += $total;
            }
            $order->total_amount = $totalAll;
        }

        $title = $request->customTitle ? $request->customTitle : 'Danh sách';
        $pdf = PDF::loadView('admin.report', compact('orders', 'title'));
        return $pdf->stream();
    }
}
