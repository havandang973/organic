@extends('admin.index')

@section('content')
    <div class="card mb-4">
        <div class="">
            <table class="table">
                <thead>
                <tr>
                    <th class="w-50">Sản phẩm</th>
                    <th class="w-25">Giá</th>
                    <th class="w-25">Số lượng</th>
                    <th class="w-50">Tổng tiền</th>
                </tr>
                </thead>
                <tbody>
                @foreach($order_details as $order_detail)
                    <?php $price = $order_detail->product->price - (($order_detail->product->price * $order_detail->product->discount)/100)  ?>
                    <tr class="even">
                        <td class="sorting_1">
                            <div class="d-flex justify-content-start align-items-center text-nowrap">
                                <div class="avatar-wrapper">
                                    <div class="avatar me-2">
                                        <img src="{{asset($order_detail->product->thumbnail)}}" alt="" class="rounded-2 w-20"></div>
                                </div>
                                <div class="d-flex flex-column"><h6 class="text-body mb-0">{{$order_detail->product->name}}</h6><small
                                        class="text-muted">{{$order_detail->product->name}}</small></div>
                            </div>
                        </td>
                        <td><span>{{$price}}</span></td>
                        <td><span class="text-body">{{$order_detail->qty}}</span></td>
                        <td><h6 class="mb-0 w-20">{{number_format($order_detail->qty * $price, 0, "", ".")}} đ</h6></td>
                    </tr>
                @endforeach

{{--                <tr class="odd">--}}
{{--                    <td class="  control" tabindex="0" style="display: none;"></td>--}}
{{--                    <td class="  dt-checkboxes-cell"><input type="checkbox" class="dt-checkboxes form-check-input"></td>--}}
{{--                    <td class="sorting_1">--}}
{{--                        <div class="d-flex justify-content-start align-items-center text-nowrap">--}}
{{--                            <div class="avatar-wrapper">--}}
{{--                                <div class="avatar me-2"><img src="../../assets/img/products/nikejordan.png"--}}
{{--                                                              alt="product-Nike Jordan" class="rounded-2"></div>--}}
{{--                            </div>--}}
{{--                            <div class="d-flex flex-column"><h6 class="text-body mb-0">Nike Jordan</h6><small--}}
{{--                                    class="text-muted">Size:8UK</small></div>--}}
{{--                        </div>--}}
{{--                    </td>--}}
{{--                    <td><span>$392</span></td>--}}
{{--                    <td><span class="text-body">1</span></td>--}}
{{--                    <td><h6 class="mb-0">$392</h6></td>--}}
{{--                </tr>--}}
{{--                <tr class="even">--}}
{{--                    <td class="  control" tabindex="0" style="display: none;"></td>--}}
{{--                    <td class="  dt-checkboxes-cell"><input type="checkbox" class="dt-checkboxes form-check-input"></td>--}}
{{--                    <td class="sorting_1">--}}
{{--                        <div class="d-flex justify-content-start align-items-center text-nowrap">--}}
{{--                            <div class="avatar-wrapper">--}}
{{--                                <div class="avatar me-2"><img src="../../assets/img/products/facecream.png"--}}
{{--                                                              alt="product-Face cream" class="rounded-2"></div>--}}
{{--                            </div>--}}
{{--                            <div class="d-flex flex-column"><h6 class="text-body mb-0">Face cream</h6><small--}}
{{--                                    class="text-muted">Gender:Women</small></div>--}}
{{--                        </div>--}}
{{--                    </td>--}}
{{--                    <td><span>$813</span></td>--}}
{{--                    <td><span class="text-body">2</span></td>--}}
{{--                    <td><h6 class="mb-0">$1626</h6></td>--}}
{{--                </tr>--}}
                </tbody>
            </table>
            <?php
                $totalAll = 0;
                foreach ($order_details as $order_detail) {
                    $price = $order_detail->product->price - (($order_detail->product->price * $order_detail->product->discount)/100);
                    $total = $order_detail->qty * $price;
                    $totalAll = $totalAll + $total;
                }
            ?>
            <div class="flex justify-between items-center m-3 mb-2 p-1">
                <a href="{{url()->previous()}}" class="text-xs uppercase font-semibold rounded-md border border-transparent text-white px-6 py-2 bg-red-500">Thoát</a>

                <div class="order-calculations">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="w-px-100">Tổng tiền: </span>
                        <span class="text-heading">{{number_format($totalAll, 0, "", ".")}} đ</span>
                    </div>
{{--                    <div class="d-flex justify-content-between mb-2">--}}
{{--                        <span class="w-px-100">Discount:</span>--}}
{{--                        <span class="text-heading mb-0">$22</span>--}}
{{--                    </div>--}}
{{--                    <div class="d-flex justify-content-between mb-2">--}}
{{--                        <span class="w-px-100">Tax:</span>--}}
{{--                        <span class="text-heading">$30</span>--}}
{{--                    </div>--}}
                    <div class="d-flex justify-content-between">
                        <h6 class="w-px-100 mb-0">Thanh toán:</h6>
                        <h6 class="mb-0 ml-4">{{number_format($totalAll, 0, "", ".")}} đ</h6>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
