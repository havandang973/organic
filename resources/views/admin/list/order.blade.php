@extends('admin.index')

@section('content')
    <div id="content" class="container-fluid">
        <div id="notification" class="notification hidden">
            <div class="flex justify-center items-center">
                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="40"
                    height="40" x="0" y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512"
                    xml:space="preserve" class="">
                    <g>
                        <path fill="#4bae4f" fill-rule="evenodd"
                            d="M256 0C114.8 0 0 114.8 0 256s114.8 256 256 256 256-114.8 256-256S397.2 0 256 0z"
                            clip-rule="evenodd" opacity="1" data-original="#4bae4f" class=""></path>
                        <path fill="#ffffff"
                            d="M206.7 373.1c-32.7-32.7-65.2-65.7-98-98.4-3.6-3.6-3.6-9.6 0-13.2l37.7-37.7c3.6-3.6 9.6-3.6 13.2 0l53.9 53.9L352.1 139c3.7-3.6 9.6-3.6 13.3 0l37.8 37.8c3.7 3.7 3.7 9.6 0 13.2L219.9 373.1c-3.6 3.7-9.5 3.7-13.2 0z"
                            opacity="1" data-original="#ffffff"></path>
                    </g>
                </svg>
                <span id="notification-message"></span>
            </div>
        </div>
        <div class="card">
            <div class="card-header font-weight-bold">
                Danh sách đơn hàng
            </div>
            <div class="card-body">
                <!-- Filter Form -->
                <form method="GET" action="{{ route('list.order') }}" class="form-inline mb-4" id="filterForm">
                    <!-- Các trường lọc khác -->
            
                    <div class="form-group mb-3 mr-2">
                        <label for="order_code" class="mr-2 font-weight-bold">Mã đơn hàng</label>
                        <input type="text" class="form-control" id="order_code" name="order_code" value="{{ request('order_code') }}">
                    </div>
                    <div class="form-group mb-3 mr-2">
                        <label for="email" class="mr-2 font-weight-bold">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ request('email') }}">
                    </div>
                    <div class="form-group mb-3 mr-2">
                        <label for="name" class="mr-2 font-weight-bold">Tên khách hàng</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ request('name') }}">
                    </div>
                    <div class="form-group mb-3 mr-2">
                        <label for="address" class="mr-2 font-weight-bold">Địa chỉ</label>
                        <input type="text" class="form-control" id="address" name="address" value="{{ request('address') }}">
                    </div>
                    <div class="form-group mb-3 mr-2">
                        <label for="phone" class="mr-2 font-weight-bold">Số điện thoại</label>
                        <input type="text" class="form-control" id="phone" name="phone" value="{{ request('phone') }}">
                    </div>
                    <div class="form-group mb-3 mr-2">
                        <label for="payment_method" class="mr-2 font-weight-bold">Phương thức thanh toán</label>
                        <select class="form-control" id="payment_method" name="payment_method">
                            <option value="">Tất cả</option>
                            @foreach (\App\Enums\Transaction::TRANSACTION as $method)
                                <option value="{{ $method }}" {{ request('payment_method') == $method ? 'selected' : '' }}>
                                    {{ $method }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-3 mr-2">
                        <label for="status" class="mr-2 font-weight-bold">Trạng thái</label>
                        <select class="form-control" id="status" name="status">
                            <option value="">Tất cả</option>
                            @foreach (\App\Enums\Status::STATUS as $value => $label)
                                <option value="{{ $value }}" {{ request('status') == $value ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-3 mr-2">
                        <label for="from_date" class="mr-2 font-weight-bold">Từ ngày</label>
                        <input type="date" class="form-control" id="from_date" name="from_date" value="{{ request('from_date') }}">
                    </div>
                    <div class="form-group mb-3 mr-2">
                        <label for="to_date" class="mr-2 font-weight-bold">Đến ngày</label>
                        <input type="date" class="form-control" id="to_date" name="to_date" value="{{ request('to_date') }}">
                    </div>
            
                    <!-- Các nút chức năng -->
                    <div class="form-group mb-3">
                        <input type="text" class="form-control mr-2" id="customTitle" name="customTitle" placeholder="Nhập tiêu đề in" value="{{ request('customTitle') }}">
                        <button type="submit" class="btn btn-primary mr-2">Lọc</button>
                        <a href="{{ route('order.print', request()->except(['_token', '_method'])) }}" target="_blank" class="btn btn-info mr-2" title="Print">
                            <i class="fa fa-print"></i> In
                        </a>
                        <a href="{{ route('list.order') }}" class="btn btn-danger" title="clearFilter">
                            Xóa lọc
                        </a>
                    </div>
                </form>

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Mã đơn hàng</th>
                            <th scope="col">Thông tin liên hệ</th>
                            <th scope="col">Tổng tiền</th>
                            <th scope="col">Phương thức thanh toán</th>
                            <th scope="col">Trạng thái</th>
                            <th scope="col">Thời gian</th>
                            <th scope="col">Tác vụ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        
                        use App\Enums\Status;
                        
                        $t = ($orders->currentPage() - 1) * $orders->perPage() + 1; ?>
                        @foreach ($orders as $order)
                            <tr>
                                <th scope="row">{{ $t++ }}</th>
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
                                            <li>Phương thức: {{ $paymentMethod['method'] ?? '' }}</li>
                                            <li>Ngân hàng: {!! $paymentMethod['bank'] == 'Lỗi thanh toán' ? "<span class='text-danger'>Lỗi thanh toán</span>" : $paymentMethod['bank'] !!}</li>
                                            <li>Mã thanh toán: {!! $paymentMethod['transaction_code'] == 'Lỗi thanh toán' ? "<span class='text-danger'>Lỗi thanh toán</span>" : $paymentMethod['transaction_code'] !!}</li>
                                            <li>Tổng tiền: {{ $paymentMethod['total'] ?? '' }} VNĐ</li>
                                            <li>Thời gian: {{ $paymentMethod['time'] ?? '' }}</li>
                                        </ul>
                                    @else
                                        {!! $order->payment_method ?? "<span class='text-danger'>Lỗi thanh toán</span>" !!}
                                    @endif
                                    {{-- @if ($order->payment_method === App\Enums\Transaction::CASH)
                                {{ $order->payment_method }}
                            @else
                                @php
                                    $paymentMethod = json_decode($order->payment_method, true);
                                @endphp                            
                                
                            @endif --}}
                                </td>
                                <td>
                                    <form method="POST" action="{{ route('edit.status', $order->id) }}" class="">
                                        @csrf
                                        <select class="form-control status" data-order-id="{{ $order->id }}"
                                            name="status">
                                            @foreach (Status::STATUS as $value => $label)
                                                <option value="{{ $value }}"
                                                    {{ $order->status === $value ? 'selected' : '' }}>
                                                    {{ $label }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </form>
                                </td>
                                <td>{{ $order->created_at }}</td>
                                <td>
                                    <a href="{{ route('list.orderDetail', $order->id) }}"
                                        class="btn bg-green-600 btn-success btn-sm rounded-0 text-white" type="button"
                                        data-toggle="tooltip" data-placement="top" title="Edit"><i
                                            class="fa fa-edit"></i></a>
                                    <a href="{{ route('delete.order', $order->order_code) }}"
                                        class="btn bg-red-500 btn-danger btn-sm rounded-0 text-white" type="button"
                                        data-toggle="tooltip" data-placement="top" title="Delete"><i
                                            class="fa fa-trash"></i></a>
                                    <a href="{{ route('order.invoice', $order->id) }}" target="_blank"
                                        class="btn bg-blue-500 btn-primary btn-sm rounded-0 text-white" type="button"
                                        data-toggle="tooltip" data-placement="top" title="Print"><i
                                            class="fa-solid fa-print"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $orders->links() }}
            </div>
        </div>
    </div>
    <script src="{{ asset('js/admin/status.js') }}"></script>
    <script src="{{ asset('js/admin/index.js') }}"></script>
    <script>
        document.getElementById('printOrders').addEventListener('click', function() {
            var printContents = document.querySelector('.card-body').innerHTML;
            var originalContents = document.body.innerHTML;

            // Thay đổi nội dung của body để chỉ in phần được chọn
            document.body.innerHTML = printContents;

            // Thực hiện in
            window.print();

            // Khôi phục lại nội dung ban đầu của trang sau khi in
            document.body.innerHTML = originalContents;
            location.reload(); // Reload lại trang để khôi phục trạng thái ban đầu
        });
    </script>
@endsection
