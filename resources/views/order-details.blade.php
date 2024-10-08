
<x-app-layout>
    <div class="container" style="margin-top: 9.5rem">
        <h2 class="text-center mb-4">Chi Tiết Đơn Hàng</h2>
        <div class="card">
            <?php
            $totalAll = 0;
            foreach ($order->orderDetail as $order_detail) {
                $price = $order_detail->product->price - (($order_detail->product->price * $order_detail->product->discount)/100);
                $total = $order_detail->qty * $price;
                $totalAll = $totalAll + $total;
            }
            ?>
            <div class="card-header" style="font-weight: 600">
                <p>Mã Đơn Hàng:  {{$order->order_code}}</p>
                <p>Ngày Đặt: {{$order->created_at}} </p>
                <p>Tổng Số Tiền: <span class="text-success">{{number_format($totalAll, 0, "", ".")}} VNĐ</span></p>
                <p>Trạng thái:
                    <span id="order-status"
                        class="order-status {{ $order->status === 'CONFIRMED'
                            ? 'text-info'
                            : ($order->status === 'PENDING'
                                ? 'text-warning'
                                : ($order->status === 'CANCELED'
                                    ? 'text-danger'
                                    : ($order->status === 'COMPLETED' || $order->status === 'PAID'
                                        ? 'text-success'
                                        : ($order->status === 'DELIVERY'
                                            ? 'text-primary'
                                            : '')))) }}">
                        {{ [
                            'PENDING' => 'Đang xử lý',
                            'CANCELED' => 'Đã hủy',
                            'COMPLETED' => 'Đã hoàn thành',
                            'DELIVERY' => 'Đang giao hàng',
                            'CONFIRMED' => 'Đã xác nhận',
                            'PAID' => 'Đã thanh toán',
                        ][$order->status] ?? $order->status }}
                    </span>
                </p>

            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Tên Sản Phẩm</th>
                        <th>Số Lượng</th>
                        <th>Giá</th>
                        <th>Tổng</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($order->orderDetail as $order_detail)
                            <?php $price = $order_detail->product->price - (($order_detail->product->price * $order_detail->product->discount)/100)  ?>
                            <tr class="table-light">
                                <td>
                                    <div class="d-flex justify-content-start align-items-center text-nowrap">
                                        <div class="avatar-wrapper">
                                            <div class="avatar me-2" style="width: 80px;">
                                                <img src="{{ asset($order_detail->product->thumbnail) }}" alt="" class="rounded-2">
                                            </div>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <h6 class="text-body mb-0">{{ $order_detail->product->name }}</h6>
                                            <small class="text-muted">{{ $order_detail->product->name }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td><span>{{ number_format($price, 0, "", ".") }} đ</span></td>
                                <td><span class="text-body">{{ $order_detail->qty }}</span></td>
                                <td><h6 class="mb-0">{{ number_format($order_detail->qty * $price, 0, "", ".") }} đ</h6></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
