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
                        <h5 class="card-title">{{$total}} VNĐ</h5>
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
                {{--                <nav aria-label="Page navigation example">--}}
                {{--                    <ul class="pagination">--}}
                {{--                        <li class="page-item">--}}
                {{--                            <a class="page-link" href="#" aria-label="Previous">--}}
                {{--                                <span aria-hidden="true">Trước</span>--}}
                {{--                                <span class="sr-only">Sau</span>--}}
                {{--                            </a>--}}
                {{--                        </li>--}}
                {{--                        <li class="page-item"><a class="page-link" href="#">1</a></li>--}}
                {{--                        <li class="page-item"><a class="page-link" href="#">2</a></li>--}}
                {{--                        <li class="page-item"><a class="page-link" href="#">3</a></li>--}}
                {{--                        <li class="page-item">--}}
                {{--                            <a class="page-link" href="#" aria-label="Next">--}}
                {{--                                <span aria-hidden="true">&raquo;</span>--}}
                {{--                                <span class="sr-only">Next</span>--}}
                {{--                            </a>--}}
                {{--                        </li>--}}
                {{--                    </ul>--}}
                {{--                </nav>--}}
            </div>
        </div>

    </div>
@endsection
