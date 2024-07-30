@extends('admin.index')

@section('content')
    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header font-weight-bold">
                Danh sách sản phẩm
            </div>
            <div class="card-body">
                <!-- Filter Form -->
                <form method="GET" action="{{ route('list.product') }}" class="form-inline mb-4" id="filterForm">
                    <div class="form-group mr-2">
                        <label for="code" class="mr-2">Mã sản phẩm</label>
                        <input type="text" class="form-control" id="code" name="code" value="{{ request('code') }}">
                    </div>
                    <div class="form-group mr-2">
                        <label for="name" class="mr-2">Tên sản phẩm</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ request('name') }}">
                    </div>
                    <div class="form-group mr-2">
                        <label for="max_amount_min" class="mr-2">Số lượng tối thiểu</label>
                        <input type="number" class="form-control" id="max_amount_min" name="max_amount_min" value="{{ request('max_amount_min') }}">
                    </div>
                    <div class="form-group mr-2">
                        <label for="max_amount_max" class="mr-2">Số lượng tối đa</label>
                        <input type="number" class="form-control" id="max_amount_max" name="max_amount_max" value="{{ request('max_amount_max') }}">
                    </div>
                    <button type="submit" class="btn btn-primary">Lọc</button>
                    <button type="button" class="btn btn-danger ml-2" id="clearAll">Xóa tất cả</button>
                </form>

                @if($lowStockProducts->isNotEmpty())
                    <div class="alert alert-warning">
                        <strong>Các sản phẩm sắp hết hàng:</strong>
                        <button type="button" class="btn btn-link p-0" data-toggle="modal" data-target="#lowStockModal">
                            Xem chi tiết
                        </button>
                    </div>
                @endif

                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">STT</th>
                        <th scope="col">Mã sản phẩm</th>
                        <th scope="col">Ảnh</th>
                        <th scope="col">Tên sản phẩm</th>
                        <th scope="col">Giá</th>
                        <th scope="col">Giảm giá</th>
                        <th scope="col">Ngày tạo</th>
                        <th scope="col">Số lượng</th>
                        <th scope="col">Tác vụ</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $t = ($products->currentPage() - 1) * $products->perPage() + 1; ?>
                    @foreach($products as $product)
                        <tr>
                            <th scope="row">{{$t++}}</th>
                            <th scope="row">{{$product->code}}</th>
                            <td><img class="w-20" src="{{asset($product->thumbnail)}}" alt=""></td>
                            <td>{{$product->name}}</td>
                            <td>{{$product->price}}₫</td>
                            <td>{{$product->discount}}%</td>
                            <td>{{$product->created_at}}</td>
                            <td><span class="badge badge-success">{{$product->max_amount}}</span></td>
                            <td>
                                <a href="{{route('edit.product', $product->name)}}" class="btn bg-green-600 btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                                <a href="{{route('delete.product', $product->name)}}" class="btn bg-red-600 btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{$products->links()}}
            </div>
        </div>
    </div>
    <!-- Low Stock Products Modal -->
    <div class="modal fade" id="lowStockModal" tabindex="-1" role="dialog" aria-labelledby="lowStockModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-warning text-white">
                    <h5 class="modal-title" id="lowStockModalLabel">Các sản phẩm sắp hết hàng</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @if($lowStockProducts->isNotEmpty())
                        <div class="list-group">
                            @foreach($lowStockProducts as $product)
                                <a href="{{route('edit.product', $product->name)}}" class="list-group-item list-group-item-action flex-column align-items-start">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1">Mã sản phẩm: {{$product->code}}</h5>
                                        <small>Số lượng: {{$product->max_amount}}</small>
                                    </div>
                                    <p class="mb-1"><strong>Tên sản phẩm:</strong> {{$product->name}}</p>
                                </a>
                            @endforeach
                        </div>
                    @else
                        <p>Không có sản phẩm sắp hết hàng.</p>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>

    <script src="{{asset('js/admin/index.js')}}"></script>
@endsection
