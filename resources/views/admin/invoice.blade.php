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
            /* background-color: #f5f5f5; */
        }
        .container {
            width: 70%;
            margin: auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 2px solid #ddd;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .header img {
            max-width: 120px;
            border-radius: 50%;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            color: #333;
            text-align: right;
        }
        .customer-info, .order-info {
            margin-bottom: 20px;
        }
        .customer-info h3, .order-info h3 {
            margin-bottom: 10px;
            font-size: 18px;
            color: #555;
            border-bottom: 2px solid #ddd;
            padding-bottom: 5px;
        }
        .customer-info p, .order-info p {
            margin: 5px 0;
            font-size: 16px;
        }
        .order-items {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .order-items th, .order-items td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }
        .order-items th {
            background-color: #f4f4f4;
            color: #555;
            font-size: 16px;
        }
        .order-items td {
            font-size: 15px;
        }
        .total {
            text-align: right;
            font-size: 18px;
            font-weight: bold;
        }
        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 16px;
            color: #777;
        }
    </style>
</head>
<body>
<div class="container">
    <!-- Header -->
    <div class="header">
        <!-- Logo bên trái -->
        <img src="https://img.freepik.com/free-vector/100-organic-food-certified-label_1017-19669.jpg" alt="Logo">
        <!-- Tiêu đề hóa đơn bên phải -->
        <h1>HÓA ĐƠN</h1>
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




