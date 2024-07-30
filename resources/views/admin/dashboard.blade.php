@extends('admin.index')

@section('content')
    <div class="container-fluid py-5">
        <div class="row">
            <div class="col">
                <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                    <div class="card-header">ĐƠN HÀNG THÀNH CÔNG</div>
                    <div class="card-body">
                        <h5 class="card-title">{{$qtyOrderComplete}}</h5>
                        <p class="card-text">Đơn hàng giao dịch thành công</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card text-white bg-danger mb-3" style="max-width: 18rem;">
                    <div class="card-header">ĐANG XỬ LÝ</div>
                    <div class="card-body">
                        <h5 class="card-title">{{$qtyOrderPending}}</h5>
                        <p class="card-text">Số lượng đơn hàng đang xử lý</p>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
                    <div class="card-header">DOANH SỐ</div>
                    <div class="card-body">
                        <h5 class="card-title">{{$totalFormatted}} VNĐ</h5>
                        <p class="card-text">Doanh số hệ thống</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card text-white bg-dark mb-3" style="max-width: 18rem;">
                    <div class="card-header">ĐƠN HÀNG HỦY</div>
                    <div class="card-body">
                        <h5 class="card-title">{{$qtyOrderCancel}}</h5>
                        <p class="card-text">Số đơn bị hủy trong hệ thống</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- end analytic  -->

        <!-- Form lọc theo thời gian -->
        <div class="card mb-4">
            <div class="card-header">
                Lọc doanh số
            </div>
            <div class="card-body">
                <form action="{{ route('admin.dashboard') }}" method="GET">
                    <div class="form-row">
                        <div class="col">
                            <label for="start_date">Ngày bắt đầu</label>
                            <input type="date" class="form-control" id="start_date" name="start_date" value="{{ request('start_date') }}">
                        </div>
                        <div class="col">
                            <label for="end_date">Ngày kết thúc</label>
                            <input type="date" class="form-control" id="end_date" name="end_date" value="{{ request('end_date') }}">
                        </div>
                        <div class="col align-self-end">
                            <button type="submit" class="btn btn-primary">Lọc</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Hiển thị thông báo doanh số -->
        @if(request('start_date') && request('end_date'))
            <div class="alert alert-info">
                {{ $salesMessage }}
            </div>
        @endif

        <div class="card">
            <div class="card-header font-weight-bold">
                ĐƠN HÀNG MỚI
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Khách hàng</th>
                        <th scope="col">Địa chỉ</th>
                        <th scope="col">Email</th>
                        <th scope="col">Số điện thoại</th>
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
                            <td>{{$order->name}}</td>
                            <td>{{$order->address}}</td>
                            <td>{{$order->email}}</td>
                            <td>{{$order->phone}}</td>
                            <td>
                                <span class="inline-block rounded-lg text-white px-2 py-1 text-xs font-bold mr-3
                                        @if($order->status === Status::CANCELED)
                                            bg-red-500
                                        @elseif($order->status === Status::COMPLETED)
                                            bg-green-500
                                        @elseif($order->status === Status::DELIVERY)
                                            bg-blue-500
                                        @else
                                            bg-yellow-500
                                        @endif">{{$order->status}}
                                </span>
                            </td>
                            <td>{{$order->created_at}}</td>
                            <td>
                                <a href="{{route('list.orderDetail', $order->id)}}" class="btn bg-green-600 btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                                {{--                                <a href="{{route('delete.order', $order->id)}}" class="btn bg-red-500 btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>--}}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{$orders->links()}}
            </div>
        </div>
    </div>
@endsection
