<x-app-layout>
    <!-- HERO SECTION PART START -->
    <div class="hero_section">
        <div class="png_img"><img class="img-fluid" src="img/leaf.png" alt="" /></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="herosection_content">
                        <h2>Cart Overview</h2>
                        <a href="index.html" class="btn border-radius-0 border-transparent">Home - Pages</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- HERO SECTION PART END -->

    <!-- ORDER PART STRAT -->
    <div class="order_part">
        <div class="container">
            <div class="">
                <div class="col-12">
                    <div class="billing_content">
                        <div class="billing_head text-uppercase mb-4">
                            <h2>Các địa chỉ đã lưu</h2>
                            <div class="row g-2">
                                @foreach($addresses as $address)
                                    <div class="address col-md-6 col-lg-4 mb-2" style="cursor: pointer">
                                        <div class="card p-3" onclick="showAddressInfo(this)">
                                            <span class="email d-none">{{auth()->user()->email}}</span>
                                            <div class="d-flex align-items-center mb-2">
                                                <i class="fa-regular fa-user me-2"></i>
                                                <span class="name text-sm">{{$address->name}}</span>
                                            </div>
                                            <div class="d-flex align-items-center mb-2">
                                                <i class="fa-solid fa-location-dot me-2"></i>
                                                <span class="address-detail text-sm">{{$address->address}}</span>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <i class="fa-solid fa-phone-volume me-2"></i>
                                                <span class="telephone text-sm">{{$address->telephone}}</span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="billing_head text-uppercase mb-4">
                            <h2>Hóa đơn chi tiết</h2>
                            <div class="billing_form">
                                <form action="/completes" method="POST">
                                    @csrf
                                    <div class="mb-4">
                                        <table class="table font-weight-normal">
                                            <thead>
                                            <tr>
                                                <th scope="col" class="text-uppercase" colspan="2">Phương thức thanh toán</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="payment_method" id="banking" value="Thanh toán online" checked />
                                                        <label class="form-check-label" for="banking">Thanh toán online</label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="payment_method" id="money" value="Thanh toán khi nhận hàng"/>
                                                        <label class="form-check-label" for="money">Thanh toán khi nhận hàng</label>
                                                    </div>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="row g-2">
                                        <div class="col-md-6 mb-3">
                                            <input value="{{ old('name') }}" type="text" class="form-control border-radius-0" id="checkout_name" name="name" placeholder="Họ tên" />
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <input value="{{ old('address') }}" name="address" type="text" class="form-control border-radius-0" placeholder="Địa chỉ">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <input value="{{ old('email') }}" name="email" type="text" class="form-control border-radius-0" placeholder="Email">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <input value="{{ old('phone') }}" name="phone" type="text" class="form-control border-radius-0" placeholder="Số điện thoại">
                                        </div>
                                        <div class="col-12 mb-3">
                                            <textarea class="form-control border-radius-0" id="checkout_billing_textarea" name="note" rows="2" placeholder="Ghi chú (Nếu có) :"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-12 col-lg-4">
                                        <div class="order_content">
                                            <div class="order_cardTotal pt-4">
                                                <table class="table">
                                                    <thead>
                                                    <tr>
                                                        <th scope="col" class="text-uppercase text-center" colspan="2">Thanh toán</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                        <th>Tổng tiền:</th>
                                                        <td class="text-end">{{Cart::total()}} đ</td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="checkout_btn text-end mt-3">
                                                <button type="submit" class="btn border-radius-0 border-transparent">Thanh toán</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- ORDER PART END -->

    <style>
        .hide {
            display: none;
        }
        .border-blue-600 { border: 2px solid #1E40AF; }
        .bg-sky-100 { background-color: #E0F2FE; }
    </style>
    <script src="{{ asset('js/cart/add.js') }}"></script>
    <script src="{{ asset('js/cart/update.js') }}"></script>
    <script src="{{ asset('js/cart/delete.js') }}"></script>
    <script src="{{ asset('js/address.js') }}"></script>
</x-app-layout>
