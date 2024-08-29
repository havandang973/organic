<x-app-layout>
    <!-- HERO SECTION PART START -->
    <div class="hero_section">
        {{-- <div class="png_img"><img class="w-100 img-fluid" src="{{asset('uploads/banner_poster.jpg')}}" alt="" /></div> --}}
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="herosection_content">
                        <h2 style="color: #fff">Giỏ hàng</h2>
                        <a href="/" class="btn border-radius-0 border-transparent">Trang chủ</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- HERO SECTION PART END-->

    <!-- CART OVERVIEW PART START -->
    <div class="cart_overview">
        <div class="container">
            <h2 class="text-center mb-4">Giỏ hàng</h2>
            <div class="row" style="margin-top: 4rem">
                <div class="col-xs-12 col-sm-12 col-md-12 table-responsive">
                    <form class="updateCartForm" action="{{ route('update') }}" method="POST">
                        <table class="table">
                            <thead>
                                <tr class="cartoverview_title">
                                    <th>Hình ảnh</th>
                                    <th>Sản phẩm</th>
                                    <th>Giá</th>
                                    <th>Số lượng</th>
                                    <th>Tổng tiền</th>
                                    <th></th>
                                </tr>
                            </thead>
                            @if (Cart::count())
                                <tbody>
                                    @foreach (Cart::content() as $row)
                                        @php
                                            $product = App\Models\Product::find($row->id);
                                        @endphp

                                        @if (!$product)
                                            {{ Cart::remove($row->rowId) }}
                                        @else
                                            <tr class="cart-item">
                                                <th scope="row">
                                                    <div class="thamnail_img">
                                                        <a href="{{ route('productDetail', ['id' => $row->id]) }}"
                                                            class="">
                                                            <img class="img-fluid" width="155"
                                                                src="{{ $row->options->thumbnail }}" alt="" />
                                                        </a>
                                                    </div>
                                                </th>
                                                <td class="align-middle"><b>{{ $row->name }}</b></td>
                                                <td class="align-middle font-weight-bold">
                                                    {{ number_format($row->price) }}₫</td>

                                                <td class="align-middle">
                                                    <div class="cart d-flex">
                                                        <div class="d-flex">
                                                            <input name="qty[{{ $row->rowId }}]" id=""
                                                                type="number"
                                                                class="qty w-50 text-center font-weight-bold"
                                                                placeholder="1" min="1"
                                                                value="{{ $row->qty }}" style="outline: none">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="align-middle font-weight-bold">
                                                    {{ number_format($row->qty * $row->price) }}₫</td>
                                                <td class="align-middle"><i class="icofont-close text-danger"></i></td>
                                                <td class="text-center" style="cursor: pointer;">
                                                    <a data-row-id="{{ $row->rowId }}"
                                                        class="removeCart text-danger"><i class="fa-solid fa-xmark"
                                                            style="font-size: 20px"></i></a>
                                                </td>
                                            </tr>
                                            @endif
                                    @endforeach
                                </tbody>
                        </table>
                        <button type="button" class="updateCart btn btn-success float-right">Cập nhật</button>
                        <div id="error-item" class="d-none items-center p-4 mb-4 text-sm text-danger" role="alert">
                            <div class="d-flex">
                                <svg class="flex-shrink-0 inline w-4 h-4 me-3" width="16" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                                </svg>
                                <span class="sr-only">Info</span>
                                <div>
                                    <span id="error" class="text-danger font-weight-bold"></span>
                                </div>
                            </div>
                        </div>
                    @else
                        <table class="">
                            <p class="text-center font-weight-bold">Chưa Có Sản Phẩm</p>
                        </table>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- CART OVERVIEW PART END -->

    <!-- COUPON PART START -->

    <div class="coupon_part">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
                    {{--                    <div class="serach_btn"> --}}
                    {{--                        <form action="#"> --}}
                    {{--                            <div class="search_ber"> --}}
                    {{--                                <input type="text" class="form-control search_button" id="serach_button" name="serach_button" value="" placeholder="Apply Coupon" /> --}}
                    {{--                                <div class="coupon_btn"> --}}
                    {{--                                    <a href="#" class="border-radius-0">APPLY COUPON</a> --}}
                    {{--                                </div> --}}
                    {{--                            </div> --}}
                    {{--                        </form> --}}
                    {{--                    </div> --}}
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-3">
                    <div class="order_cardTotal">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col" class="card_total text-uppercase" colspan="2">Thanh toán</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">Tổng tiền:</th>
                                    <td class="total text-right total_num" style="color: #54b215">{{ Cart::total() }} đ
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    @if (Cart::count())
                        <div id="checkout" class="checkout_btn text-right">
                            <a href="/checkout" class="btn border-radius-0 border-transparent">Tiếp tục</a>
                            <input type="hidden" name="total" value="{{ Cart::total() }} đ">
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- COUPON PART END -->

    {{--    <script src="{{ asset('js/cart/add.js') }}"></script> --}}
    <script src="{{ asset('js/cart/update.js') }}"></script>
    <script src="{{ asset('js/cart/delete.js') }}"></script>
</x-app-layout>
