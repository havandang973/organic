<x-app-layout>
    <div class="container" style="padding: 9.5rem 0 3rem 0;">
        <h2 class="text-center mb-4">Đơn Hàng</h2>

        <!-- Form lọc trạng thái và ngày -->
        <div class="mb-4">
            <form method="GET" action="{{ route('orders') }}">
                <div class="row mb-3">
                    <div class="col-md-3 mb-2">
                        <select name="status" class="form-select" aria-label="Lọc trạng thái" style="height: 100%; font-weight:500">
                            <option value="">Tất cả trạng thái</option>
                            <option value="{{\App\Enums\Status::PENDING}}" {{ request('status') == 'PENDING' ? 'selected' : '' }}>Đang xử lý</option>
                            <option value="{{\App\Enums\Status::DELIVERY}}" {{ request('status') == 'DELIVERY' ? 'selected' : '' }}>Đang giao hàng</option>
                            <option value="{{\App\Enums\Status::COMPLETED}}" {{ request('status') == 'COMPLETED' ? 'selected' : '' }}>Đã hoàn thành</option>
                            <option value="{{\App\Enums\Status::CANCELED}}" {{ request('status') == 'CANCELED' ? 'selected' : '' }}>Đã hủy</option>
                        </select>
                    </div>
                    <div class="col-md-3 mb-2">
                        <input type="date" name="start_date" class="form-control" placeholder="Ngày bắt đầu" value="{{ request('start_date') }}">
                    </div>
                    <div class="col-md-3 mb-2">
                        <input type="date" name="end_date" class="form-control" placeholder="Ngày kết thúc" value="{{ request('end_date') }}">
                    </div>
                    <div class="col-md-3 d-flex align-items-center justify-content-center mb-2">
                        <button class="btn btn-primary btn-sm text-white w-50" type="submit">Lọc</button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Danh sách đơn hàng -->
        <div class="d-none d-lg-block">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Mã đơn hàng</th>
                    <th>Khách hàng</th>
                    <th>Địa chỉ</th>
                    <th>Email</th>
                    <th>Số điện thoại</th>
                    <th>Phương thức thanh toán</th>
                    <th>Trạng thái</th>
                    <th>Ngày Đặt</th>
                    <th>Chi tiết</th>
                    <th>Hủy đơn hàng</th>
                </tr>
                </thead>
                <tbody>
                @if($orders->isEmpty())
                    <tr style="font-family: math;">
                        <td colspan="9">Chưa có đơn hàng.</td>
                    </tr>
                @endif
                @foreach($orders as $order)
                    <form action="{{route('canceled.order', $order->id)}}" method="POST" data-order-id="{{ $order->id }}">
                        @csrf
                        <tr style="font-family: math;" data-order-id="{{ $order->id }}">
                            <td class="font-weight-bold">{{$order->order_code}}</td>
                            <td>{{$order->name}}</td>
                            <td>{{$order->address}}</td>
                            <td>{{$order->email}}</td>
                            <td>{{$order->phone}}</td>
                            <td>{{$order->payment_method}}</td>
                            <td class="order-status {{ $order->status === 'PENDING' ? 'text-warning' : ($order->status === 'CANCELED' ? 'text-danger' : ($order->status === 'COMPLETED' ? 'text-success' : ($order->status === 'DELIVERY' ? 'text-primary' : ''))) }}">
                                {{ $order->status }}
                            </td>
                            <td>{{$order->created_at}}</td>
                            <td>
                                <a href="{{route('order.detail', $order->id)}}" class="btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                            </td>
                            @if($order->status === 'PENDING')
                                <td>
                                    <button type="submit" class="cancel-button btn-danger btn-sm rounded-0 text-white">
                                        Hủy
                                        <input type="hidden" name="order-id" value="{{$order->id}}">
                                    </button>
                                </td>
                            @endif
                        </tr>
                    </form>
                @endforeach
                </tbody>
            </table>
        </div>

        <!-- Danh sách đơn hàng cho điện thoại và iPad -->
        <div class="d-block d-lg-none">
            @if($orders->isEmpty())
                <div class="text-center" style="font-family: math;">Chưa có đơn hàng.</div>
            @endif
            @foreach($orders as $order)
                <div class="card mb-3">
                    <div class="card-header">
                        <strong>Mã Đơn Hàng: </strong>{{$order->name}}
                    </div>
                    <div class="card-body">
                        <p><strong>Địa chỉ: </strong>{{$order->address}}</p>
                        <p><strong>Email: </strong>{{$order->email}}</p>
                        <p><strong>Số điện thoại: </strong>{{$order->phone}}</p>
                        <p><strong>Phương thức thanh toán: </strong>{{$order->payment_method}}</p>
                        <p><strong>Trạng thái: </strong>
                            <span id="order-status" class="{{ $order->status === 'PENDING' ? 'text-warning' : ($order->status === 'CANCELED' ? 'text-danger' : ($order->status === 'COMPLETED' ? 'text-success' : ($order->status === 'DELIVERY' ? 'text-primary' : ''))) }}">
                                {{ $order->status }}
                            </span>
                        </p>
                        <p><strong>Ngày Đặt: </strong>{{$order->created_at}}</p>
                        <a href="{{route('order.detail', $order->id)}}" class="btn btn-success btn-sm rounded-0 text-white mb-2" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i> Chi tiết</a>
                        @if($order->status === 'PENDING')
                            <form action="{{route('canceled.order', $order->id)}}" method="POST" class="d-inline">
                                <button type="button" id="cancel-button" class="btn btn-danger btn-sm rounded-0 text-white" data-toggle="tooltip" data-placement="top" title="Hủy đơn hàng">
                                    <i class="fa fa-trash"></i> Hủy
                                    <input type="hidden" name="order_id" value="{{$order->id}}">
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        {{ $orders->links('pagination.bootstrap') }}
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
</x-app-layout>

<style>
    .hide {
        display: none;
    }
</style>
