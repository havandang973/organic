<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

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
            $query->where('payment_method', $request->payment_method);
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

        return view('admin.list.order', compact('orders'));
    }

    public function delete(Request $request, $orderId)
    {
        $order = Order::query()->find($orderId)->first();

        $order->delete();

        toastr()->success('Xóa đơn hàng thành công', ['timeOut' => 2000]);
        return redirect()->back();
    }

    public function edit(Request $request, $orderId)
    {
        $order = Order::query()->findOrFail($orderId);
        $order->status = $request->input('status');
        $order->save();

        return response()->json(['message' => 'Trạng thái đơn hàng đã được cập nhật thành công.']);
    }
}
