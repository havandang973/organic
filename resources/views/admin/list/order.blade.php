@extends('admin.index')

@section('content')
    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header font-weight-bold">
                Danh sách đơn hàng
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
{{--                            <td><span class="badge badge-warning">Đang xử lý</span></td>--}}
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
    <script src="{{ asset('js/status.js') }}"></script>

@endsection
