<x-app-layout>
    <div class="w-full h-full">
        <div class="w-full bg-no-repeat -my-6 bg-center bg-[url('https://food-03.web4s.vn/uploads/plugin/custom_img/2018-09-10/1536547650-699688875-custom.jpg')]">
            <div class="max-w-6xl mx-auto py-36 text-white text-xl text-center font-semibold">
                <span class=""><a href="" class="">TRANG CHỦ / </a></span>
                <span class="text-yellow-500">THÔNG TIN ĐƠN HÀNG</span>
            </div>
        </div>
        <div class="w-full bg-gray-200 py-8">
            <div class="w-full bg-white">
                <div class="max-w-6xl mx-auto justify-between flex py-6">
                    <div class="flex items-center space-x-3">
                        <div class="bg-blue-700 text-white text-2xl w-10 h-10 rounded-full flex justify-center items-center">1</div>
                        <span class="text-blue-700 font-bold text-sm">THÔNG TIN ĐƠN HÀNG</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <div class="bg-white text-blue-700 border-2 border-blue-700 text-2xl w-10 h-10 rounded-full flex justify-center items-center">2</div>
                        <span class="text-blue-700 font-bold text-sm">XÁC NHẬN</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <div class="bg-white text-blue-700 border-2 border-blue-700 text-2xl w-10 h-10 rounded-full flex justify-center items-center">3</div>
                        <span class="text-blue-700 font-bold text-sm">HOÀN THÀNH</span>
                    </div>
                </div>
            </div>
            <div class="max-w-6xl mx-auto py-8 flex justify-between space-x-4">
                <div class="bg-white py-8 w-full">
                    <div class="flex text-blue-700 font-bold text-base justify-between">
                        <div id="btn_address" class="w-full text-center h-full py-4 cursor-pointer">ĐỊA CHỈ GIAO HÀNG</div>
                        {{--                        <div id="btn_login" class="bg-gray-300 text-black hover:bg-white w-full h-full text-center py-4 cursor-pointer">ĐĂNG NHẬP</div>--}}
                    </div>
                    <div id="address" class="w-full px-9">
                        <form action="/orders" method="POST" class="space-y-6 flex justify-center flex-wrap mt-10">
                            @csrf
                            <div class="w-full gap-12">
                                {{--                                <input type="text" class="px-3 py-2 outline-none border w-full" placeholder="Họ và tên">--}}
                                <input value="{{ old('name') }}" name="name" type="text" class="px-3 py-2 outline-none border w-full" placeholder="Tên">
                                @if ($errors->has('name'))
                                    <span class="error text-red-600">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                            <div class="w-full gap-12">
                                {{--                                <input type="text" class="px-3 py-2 outline-none border w-full" placeholder="Email">--}}
                                <input value="{{ old('address') }}" name="address" type="text" class="px-3 py-2 outline-none border w-full" placeholder="Địa chỉ">
                                @if ($errors->has('address'))
                                    <span class="error text-red-600">{{ $errors->first('address') }}</span>
                                @endif
                            </div>
                            <div class="w-full flex-col space-y-6">
                                <input value="{{ old('email') }}" name="email" type="text" class="w-full px-3 py-2 outline-none border" placeholder="Email">
                                {{--                                <input type="text" class="w-full px-3 py-2 outline-none border" placeholder="Ghi chú">--}}
                                @if ($errors->has('email'))
                                    <span class="error text-red-600">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                            <div class="w-full gap-12">
                                {{--                                <input type="text" class="px-3 py-2 outline-none border w-full" placeholder="Họ và tên">--}}
                                <input value="{{ old('phone') }}" name="phone" type="text" class="px-3 py-2 outline-none border w-full" placeholder="Số điện thoại">
                                @if ($errors->has('phone'))
                                    <span class="error text-red-600">{{ $errors->first('phone') }}</span>
                                @endif
                            </div>
{{--                            <div class="w-full flex-col space-y-6">--}}
{{--                                <input value="{{ old('payment_methods') }}" name="payment_methods" type="text" class="w-full px-3 py-2 outline-none border" placeholder="Phương thức thanh toán">--}}
{{--                                --}}{{--                                <input type="text" class="w-full px-3 py-2 outline-none border" placeholder="Ghi chú">--}}
{{--                                @if ($errors->has('payment_methods'))--}}
{{--                                    <span class="error text-red-600">{{ $errors->first('payment_methods') }}</span>--}}
{{--                                @endif--}}
{{--                            </div>--}}
                            <div class="">
                                <button type="submit" class="bg-blue-600 p-3 px-5 rounded text-white font-normal">Tiếp tục thanh toán <i class="fa-solid fa-arrow-right"></i></button>
                            </div>
                        </form>
                    </div>
                    <div id="login" class="hide w-full px-9">
                        <form action="" method="" class="space-y-6 flex justify-center flex-wrap mt-10">
                            <div class="flex justify-between w-full flex-col space-y-6">
                                <input type="text" class="w-full px-3 py-2 outline-none border" placeholder="Tên đăng nhập hoặc email">
                                <input type="text" class="w-full px-3 py-2 outline-none border" placeholder="Mật khẩu">
                            </div>
                            <div class="">
                                <button type="submit" class="bg-blue-600 p-3 px-5 rounded text-white font-normal"><i class="fa-solid fa-arrow-right"></i> ĐĂNG NHẬP</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="bg-white p-4 py-8 w-1/2">
                    <form class="updateCartForm" action="{{route('update')}}" method="POST">
                        @csrf
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-black font-bold">THÔNG TIN ĐƠN HÀNG</h3>
                            @if(Cart::count())
                                <button type="button" class="updateCart px-4 py-2 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Cập nhật</button>
                            @endif
                        </div>
                        <div id="error-item" class="hidden flex items-center p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                            <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                            </svg>
                            <span class="sr-only">Info</span>
                            <div>
                                <span id="error" class="font-medium"></span>
                            </div>
                        </div>
                    @if(Cart::count())
                            <div class="h-72 overflow-auto">
                                @foreach(Cart::content() as $row)
                                    <div class="cart-item w-full flex space-x-3 mt-5">
                                        <div class="w-1/3">
                                            <a href="{{route('productDetail', ['id' => $row->id])}}" class="">
                                                <img src="{{$row->options->thumbnail}}" alt="" class="">
                                            </a>
                                        </div>
                                        <div class="w-1/2 space-y-2">
                                            <a href="{{route('productDetail', ['id' => $row->id])}}" class="">
                                                <div class="text-blue-500 font-bold">{{number_format($row->options->discount)}}đ
                                                    {{--                                                <span class="mx-2 text-gray-400 line-through">{{number_format($row->price)}}₫</span>--}}
                                                </div>
                                                <div class="text-black font-bold">{{$row->name}}</div>
                                            </a>
                                            <div class="">
                                                <span class="">Số lượng:</span>
                                                <input name="qty[{{$row->rowId}}]" id="" type="number" class="qty w-16 text-center border pl-2 outline-none focus:border-lime-500" placeholder="1" min="1" value="{{$row->qty}}">
                                            </div>
                                        </div>
                                        <div class="cursor-pointer"><a data-row-id="{{$row->rowId}}" class="removeCart text-danger"><i class="fa-solid fa-xmark"></i></a></div>
                                    </div>
                                @endforeach
                            </div>
                            <div id="total" class="space-y-5 mt-4">
                                <div class="flex justify-between">
                                    <span class="text-black font-semibold">Tổng cộng: </span>
                                    <span class="total font-bold">{{Cart::total()}} đ</span>
                                </div>
                                <div class="flex justify-between ">
                                    <span class="text-black font-semibold">Thành tiền: </span>
                                    <span class="total text-blue-500 font-bold">{{Cart::total()}} đ</span>
                                </div>
                            </div>
                        @else
                            <div class="h-72 overflow-auto flex flex-col items-center justify-center space-y-4">
                                <img class="size-20" src="https://salt.tikicdn.com/ts/upload/eb/f3/a3/25b2ccba8f33a5157f161b6a50f64a60.png">
                                <p class="text-center">Chưa Có Sản Phẩm</p>
                            </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>

        <div class=""></div>
        <div class=""></div>
    </div>

    <style>
        .hide {
            display: none;
        }
    </style>
    <script src="{{ asset('js/cart/add.js') }}"></script>
    <script src="{{ asset('js/cart/update.js') }}"></script>
    <script src="{{ asset('js/cart/delete.js') }}"></script>
</x-app-layout>
