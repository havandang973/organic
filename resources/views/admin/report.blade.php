<!DOCTYPE html>
<html>
<head>
    <title>{{$title}}</title>
    <style>
        @page {
            size: A4;
        }
        body {
            font-family: 'DejaVu Sans', sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
            line-height: 1.6;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 18pt;
            page-break-before: avoid; /* Avoid page break before */
            page-break-after: avoid;  /* Avoid page break after */
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 10px 0;
            page-break-inside: auto;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
            font-size: 10pt;
        }
        th {
            background-color: #f4f4f4;
            color: #333;
            font-weight: bold;
        }
        tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tbody tr:hover {
            background-color: #f1f1f1;
        }
        ul {
            margin: 0;
            padding: 0;
            list-style-type: none;
        }
        ul li {
            margin-bottom: 4px;
        }
        .text-center {
            text-align: center;
        }
        .text-danger {
            color: #e74c3c;
        }
        /* Ensure that tables and other elements do not overflow the page */
        .no-break {
            page-break-inside: avoid;
        }
    </style>
</head>
<body>
    <h1>{{$title}}</h1>
    <table class="no-break">
        <thead>
            <tr>
                <th scope="col">STT</th>
                <th scope="col">Mã đơn hàng</th>
                <th scope="col">Thông tin liên hệ</th>
                <th scope="col">Tổng tiền</th>
                <th scope="col">Phương thức thanh toán</th>
                <th scope="col">Trạng thái</th>
                <th scope="col">Thời gian</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
                @php
                    $paymentMethod = json_decode($order->payment_method, true);
                @endphp
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $order->order_code }}</td>
                    <td>
                        <ul class="list-disc">
                            <li>{{ $order->name }}</li>
                            <li>{{ $order->email }}</li>
                            <li>{{ $order->phone }}</li>
                            <li>{{ $order->address }}</li>
                        </ul>
                    </td>
                    <td>{{ number_format($order->total_amount, 0, ',', '.') }} VNĐ</td>
                    <td>
                        @php
                            $paymentMethod = json_decode($order->payment_method, true);
                        @endphp
                        @if ($paymentMethod)
                            <ul class="list-disc">
                                <li>{{ $paymentMethod['method'] ?? '' }}</li>
                                <li>{{ $paymentMethod['bank'] ?? '' }}</li>
                                <li>{{ $paymentMethod['transaction_code'] ?? '' }}</li>
                                <li>{{ $paymentMethod['total'] ?? '' }} VNĐ</li>
                                <li>{{ $paymentMethod['time'] ?? '' }}</li>
                            </ul>
                        @else
                            {!! $order->payment_method ?? "<span class='text-danger'>Lỗi thanh toán</span>" !!}
                        @endif
                    </td>
                    <td>{{ $order->status }}</td>
                    <td>{{ $order->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
