@extends('admin.index')

@section('content')
    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header font-weight-bold">
                Danh sách đơn hàng
            </div>
            <div class="card-body">
                <!-- Filter Form -->
                <form method="GET" action="{{ route('list.order') }}" class="form-inline mb-4" id="filterForm">
                    <div class="form-group mb-3 mr-2">
                        <label for="order_code" class="mr-2">Mã đơn hàng</label>
                        <input type="text" class="form-control" id="order_code" name="order_code" value="{{ request('order_code') }}">
                    </div>
                    <div class="form-group mb-3 mr-2">
                        <label for="email" class="mr-2">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ request('email') }}">
                    </div>
                    <div class="form-group mb-3 mr-2">
                        <label for="name" class="mr-2">Tên khách hàng</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ request('name') }}">
                    </div>
                    <div class="form-group mb-3 mr-2">
                        <label for="address" class="mr-2">Địa chỉ</label>
                        <input type="text" class="form-control" id="address" name="address" value="{{ request('address') }}">
                    </div>
                    <div class="form-group mb-3 mr-2">
                        <label for="phone" class="mr-2">Số điện thoại</label>
                        <input type="text" class="form-control" id="phone" name="phone" value="{{ request('phone') }}">
                    </div>
                    <div class="form-group mb-3 mr-2">
                        <label for="payment_method" class="mr-2">Phương thức thanh toán</label>
                        <select class="form-control" id="payment_method" name="payment_method">
                            <option value="">Tất cả</option>
                            <option value="Credit Card" {{ request('payment_method') == 'Credit Card' ? 'selected' : '' }}>Credit Card</option>
                            <option value="Cash" {{ request('payment_method') == 'Cash' ? 'selected' : '' }}>Cash</option>
                            <option value="Bank Transfer" {{ request('payment_method') == 'Bank Transfer' ? 'selected' : '' }}>Bank Transfer</option>
                            <!-- Thêm các phương thức thanh toán khác nếu có -->
                        </select>
                    </div>
                    <div class="form-group mb-3 mr-2">
                        <label for="status" class="mr-2">Trạng thái</label>
                        <select class="form-control" id="status" name="status">
                            <option value="">Tất cả</option>
                            <option value="{{ \App\Enums\Status::PENDING }}" {{ request('status') == \App\Enums\Status::PENDING ? 'selected' : '' }}>{{ \App\Enums\Status::PENDING }}</option>
                            <option value="{{ \App\Enums\Status::CANCELED }}" {{ request('status') == \App\Enums\Status::CANCELED ? 'selected' : '' }}>{{ \App\Enums\Status::CANCELED }}</option>
                            <option value="{{ \App\Enums\Status::COMPLETED }}" {{ request('status') == \App\Enums\Status::COMPLETED ? 'selected' : '' }}>{{ \App\Enums\Status::COMPLETED }}</option>
                            <option value="{{ \App\Enums\Status::DELIVERY }}" {{ request('status') == \App\Enums\Status::DELIVERY ? 'selected' : '' }}>{{ \App\Enums\Status::DELIVERY }}</option>
                        </select>
                    </div>
                    <div class="form-group mb-3 mr-2">
                        <label for="from_date" class="mr-2">Từ ngày</label>
                        <input type="date" class="form-control" id="from_date" name="from_date" value="{{ request('from_date') }}">
                    </div>
                    <div class="form-group mb-3 mr-2">
                        <label for="to_date" class="mr-2">Đến ngày</label>
                        <input type="date" class="form-control" id="to_date" name="to_date" value="{{ request('to_date') }}">
                    </div>
                    <button type="submit" class="btn btn-primary">Lọc</button>
                    <button type="button" class="btn btn-danger ml-2" id="clearAll">Xóa tất cả</button>
                </form>

                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Mã đơn hàng</th>
                        <th scope="col">Khách hàng</th>
                        <th scope="col">Địa chỉ</th>
                        <th scope="col">Email</th>
                        <th scope="col">Số điện thoại</th>
                        <th scope="col">Phương thức thanh toán</th>
                        <th scope="col">Trạng thái</th>
                        <th scope="col">Thời gian</th>
                        <th scope="col">Tác vụ</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php use App\Enums\Status; $t = ($orders->currentPage() - 1) * $orders->perPage() + 1; ?>
                    @foreach($orders as $order)
                        <tr>
                            <th scope="row">{{$t++}}</th>
                            <td>{{$order->order_code}}</td>
                            <td>{{$order->name}}</td>
                            <td>{{$order->address}}</td>
                            <td>{{$order->email}}</td>
                            <td>{{$order->phone}}</td>
                            <td>{{$order->payment_method}}</td>
                            <td>
                                <form method="POST" action="{{route('edit.status', $order->id)}}" class="">
                                    @csrf
                                    <select class="form-control status" data-order-id="{{ $order->id }}" name="status">
                                        <option value="{{ Status::PENDING }}" {{ $order->status === Status::PENDING ? 'selected' : '' }}>
                                            {{ Status::PENDING }}
                                        </option>
                                        <option value="{{ Status::CANCELED }}" {{ $order->status === Status::CANCELED ? 'selected' : '' }}>
                                            {{ Status::CANCELED }}
                                        </option>
                                        <option value="{{ Status::COMPLETED }}" {{ $order->status === Status::COMPLETED ? 'selected' : '' }}>
                                            {{ Status::COMPLETED }}
                                        </option>
                                        <option value="{{ Status::DELIVERY }}" {{ $order->status === Status::DELIVERY ? 'selected' : '' }}>
                                            {{ Status::DELIVERY }}
                                        </option>
                                    </select>
                                </form>
                            </td>
                            <td>{{$order->created_at}}</td>
                            <td>
                                <a href="{{route('list.orderDetail', $order->id)}}" class="btn bg-green-600 btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                                <a href="{{route('delete.order', $order->id)}}" class="btn bg-red-500 btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{$orders->links()}}
            </div>
        </div>
    </div>
    <script src="{{ asset('js/status.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{asset('js/admin/index.js')}}"></script>
@endsection
