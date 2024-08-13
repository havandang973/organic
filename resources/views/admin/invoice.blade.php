{{--<!DOCTYPE html>--}}
{{--<html>--}}
{{--<head>--}}
{{--    <title>Hóa đơn</title>--}}
{{--    <style>--}}
{{--        body {--}}
{{--            font-family: DejaVu Sans, sans-serif;--}}
{{--            margin: 0;--}}
{{--            padding: 0;--}}
{{--            background: #f4f4f4;--}}
{{--        }--}}
{{--        .invoice-container {--}}
{{--            width: 80%;--}}
{{--            margin: 0 auto;--}}
{{--            background: #fff;--}}
{{--            padding: 20px;--}}
{{--            border: 1px solid #ccc;--}}
{{--            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);--}}
{{--        }--}}
{{--        h1, h2, h3, p {--}}
{{--            margin: 0 0 10px 0;--}}
{{--            padding: 0;--}}
{{--            color: #333;--}}
{{--        }--}}
{{--        h1 {--}}
{{--            font-size: 24px;--}}
{{--            text-align: center;--}}
{{--            margin-bottom: 20px;--}}
{{--        }--}}
{{--        h2 {--}}
{{--            font-size: 20px;--}}
{{--            border-bottom: 1px solid #ccc;--}}
{{--            padding-bottom: 5px;--}}
{{--            margin-bottom: 10px;--}}
{{--        }--}}
{{--        h3 {--}}
{{--            font-size: 18px;--}}
{{--            margin-top: 20px;--}}
{{--        }--}}
{{--        p {--}}
{{--            font-size: 16px;--}}
{{--        }--}}
{{--        .customer-info p {--}}
{{--            margin: 5px 0;--}}
{{--        }--}}
{{--        table {--}}
{{--            width: 100%;--}}
{{--            border-collapse: collapse;--}}
{{--            margin-top: 20px;--}}
{{--        }--}}
{{--        th, td {--}}
{{--            border: 1px solid #ddd;--}}
{{--            padding: 10px;--}}
{{--            text-align: left;--}}
{{--        }--}}
{{--        th {--}}
{{--            background: #f0f0f0;--}}
{{--            font-weight: normal;--}}
{{--        }--}}
{{--        td {--}}
{{--            font-weight: normal;--}}
{{--        }--}}
{{--        .total-amount {--}}
{{--            text-align: right;--}}
{{--            margin-top: 20px;--}}
{{--            font-size: 18px;--}}
{{--            font-weight: bold;--}}
{{--            color: #333;--}}
{{--        }--}}
{{--    </style>--}}
{{--</head>--}}
{{--<body>--}}
{{--<div class="invoice-container">--}}
{{--    <h1>Hóa đơn thanh toán</h1>--}}
{{--    <div class="customer-info">--}}
{{--        <p>Mã đơn hàng: <strong>{{ $order->order_code }}</strong></p>--}}
{{--        <p>Khách hàng: <strong>{{ $order->name }}</strong></p>--}}
{{--        <p>Số điện thoại: <strong>{{ $order->phone }}</strong></p>--}}
{{--        <p>Email: <strong>{{ $order->email }}</strong></p>--}}
{{--        <p>Địa chỉ nhận hàng: <strong>{{ $order->address }}</strong></p>--}}
{{--        <p>Phương thức thanh toán: <strong>{{ $order->payment_method }}</strong></p>--}}
{{--        <p>Ngày đặt hàng: <strong>{{ $order->created_at }}</strong></p>--}}
{{--        <p>Ghi chú: <strong>{{ $order->note ? $order->note : 'Không có' }}</strong></p>--}}
{{--    </div>--}}
{{--    <h2>Chi tiết hóa đơn</h2>--}}
{{--    <table>--}}
{{--        <thead>--}}
{{--        <tr>--}}
{{--            <th>Sản phẩm</th>--}}
{{--            <th>SL</th>--}}
{{--            <th>Giá</th>--}}
{{--            <th>Tổng tiền</th>--}}
{{--        </tr>--}}
{{--        </thead>--}}
{{--        <tbody>--}}
{{--        @foreach ($order->orderDetail as $detail)--}}
{{--            <tr>--}}
{{--                <td>{{ $detail->product->name }}</td>--}}
{{--                <td>{{ $detail->qty }}</td>--}}
{{--                <td>{{ number_format($detail->price, 0, "", ".") }} vnđ</td>--}}
{{--                <td>{{ number_format($detail->qty * $detail->price, 0, "", ".") }} vnđ</td>--}}
{{--            </tr>--}}
{{--        @endforeach--}}
{{--        </tbody>--}}
{{--    </table>--}}
{{--    <?php--}}
{{--    $totalAll = 0;--}}
{{--    foreach ($order->orderDetail as $detail) {--}}
{{--        $price = $detail->product->price - (($detail->product->price * $detail->product->discount)/100);--}}
{{--        $total = $detail->qty * $price;--}}
{{--        $totalAll += $total;--}}
{{--    }--}}
{{--    ?>--}}
{{--    <div class="total-amount">--}}
{{--        <p>Thanh toán: {{ number_format($totalAll, 0, "", ".") }} VNĐ</p>--}}
{{--    </div>--}}
{{--</div>--}}
{{--</body>--}}
{{--</html>--}}


<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hóa Đơn</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
        }
        .container {
            width: 80%;
            margin: auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #f9f9f9;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header img {
            max-width: 150px;
        }
        .header h1 {
            margin: 0;
        }
        .customer-info, .order-info {
            margin-bottom: 20px;
        }
        .customer-info p, .order-info p {
            margin: 5px 0;
        }
        .order-items {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .order-items th, .order-items td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        .order-items th {
            background-color: #f2f2f2;
        }
        .total {
            text-align: right;
        }
        .footer {
            margin-top: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
<div class="container">
    <!-- Header -->
    <div class="header">
        <h2>HÓA ĐƠN</h2>
    </div>

    <!-- Thông tin khách hàng -->
    <div class="customer-info">
        <h3>Thông Tin Khách Hàng</h3>
        <p><strong>Tên:</strong> {{ $order->name }}</p>
        <p><strong>Địa chỉ:</strong> {{ $order->address }}</p>
        <p><strong>Số điện thoại:</strong> {{ $order->phone }}</p>
        <p><strong>Ghi chú:</strong> {{ $order->note }}</p>
    </div>

    <!-- Thông tin đơn hàng -->
    <div class="order-info">
        <h3>Thông Tin Đơn Hàng</h3>
        <p><strong>Mã đơn hàng:</strong> {{ $order->order_code }}</p>
        <p><strong>Giao từ:</strong> Vĩnh Phúc</p>
        <p><strong>Ngày đặt hàng:</strong> {{ $order->created_at }}</p>
    </div>

    <!-- Danh sách sản phẩm -->
    <table class="order-items">
        <thead>
        <tr>
            <th>Tên sản phẩm</th>
            <th>Số lượng</th>
            <th>Giá</th>
            <th>Tổng</th>
        </tr>
        </thead>
        <tbody>
        <?php
            $totalAll = 0;
            foreach ($order->orderDetail as $detail) {
                $price = $detail->product->price - (($detail->product->price * $detail->product->discount)/100);
                $total = $detail->qty * $price;
                $totalAll += $total;
            }
        ?>
        @foreach ($order->orderDetail as $detail)
            <tr>
                <td>{{ $detail->product->name }}</td>
                <td>{{ $detail->qty }}</td>
                <td>{{ number_format($detail->price, 0, "", ".") }} đ</td>
                <td>{{ number_format($detail->qty * $detail->price, 0, "", ".") }} đ</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <!-- Tóm tắt đơn hàng -->
    <div class="total">
        <p><strong>Tổng thanh toán:</strong> {{ number_format($totalAll, 0, "", ".") }} VNĐ</p>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p>Cảm ơn bạn đã mua hàng!</p>
    </div>
</div>
</body>
</html>


