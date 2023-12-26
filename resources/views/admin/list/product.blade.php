@extends('admin.index')

@section('content')
    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header font-weight-bold">
                Danh sách sản phẩm
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">STT</th>
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
