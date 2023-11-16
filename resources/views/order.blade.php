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
                        <div class="bg-white border-2 border-blue-700 text-blue-700 text-2xl w-10 h-10 rounded-full flex justify-center items-center">1</div>
                        <span class="text-blue-700 font-bold text-sm">THÔNG TIN ĐƠN HÀNG</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <div class="bg-blue-700 text-white border-2 border-blue-700 text-2xl w-10 h-10 rounded-full flex justify-center items-center">2</div>
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
                        <div id="btn_address" class="w-full text-center h-full py-4 cursor-pointer">XÁC NHẬN</div>
                    </div>
                    <div id="address" class="w-full px-9 space-y-6 flex justify-center flex-wrap mt-10">
                        <form action="/completes" method="POST" class="space-y-6 flex justify-center flex-wrap mt-10">
                            @csrf
                            <div class="w-full gap-12">
                                {{--                                <input type="text" class="px-3 py-2 outline-none border w-full" placeholder="Họ và tên">--}}
                                <input value="{{ $data['name'] }}" name="name" type="text" class="px-3 py-2 outline-none border w-full" placeholder="Tên">
                            </div>
                            <div class="w-full gap-12">
                                {{--                                <input type="text" class="px-3 py-2 outline-none border w-full" placeholder="Email">--}}
                                <input value="{{ $data['address'] }}" name="address" type="text" class="px-3 py-2 outline-none border w-full" placeholder="Địa chỉ">
                            </div>
                            <div class="w-full flex-col space-y-6">
                                <input value="{{ $data['email'] }}" name="email" type="text" class="w-full px-3 py-2 outline-none border" placeholder="Email">
                            </div>
                            <div class="w-full gap-12">
                                {{--                                <input type="text" class="px-3 py-2 outline-none border w-full" placeholder="Họ và tên">--}}
                                <input value="{{ $data['phone'] }}" name="phone" type="text" class="px-3 py-2 outline-none border w-full" placeholder="Số điện thoại">
                            </div>
                            {{--                            <div class="w-full flex-col space-y-6">--}}
                            {{--                                <input value="{{ old('payment_methods') }}" name="payment_methods" type="text" class="w-full px-3 py-2 outline-none border" placeholder="Phương thức thanh toán">--}}
                            {{--                                --}}{{--                                <input type="text" class="w-full px-3 py-2 outline-none border" placeholder="Ghi chú">--}}
                            {{--                                @if ($errors->has('payment_methods'))--}}
                            {{--                                    <span class="error text-red-600">{{ $errors->first('payment_methods') }}</span>--}}
                            {{--                                @endif--}}
                            {{--                            </div>--}}
                            <div class="">
                                <button type="submit" class="bg-blue-600 p-3 px-5 rounded text-white font-normal">Xác nhận <i class="fa-solid fa-arrow-right"></i></button>
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
{{--                    <form action="{{route('update')}}" method="POST">--}}
{{--                        @csrf--}}
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-black font-bold">THÔNG TIN ĐƠN HÀNG</h3>
{{--                            <button type="submit" class="px-4 py-2 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Cập nhật</button>--}}
                        </div>
                        <div class="h-72 overflow-auto">
                            @foreach(Cart::content() as $row)
                                <div class="w-full flex space-x-3 mt-5">
                                    <div class="w-1/3">
                                        <a href="{{route('productDetail', ['id' => $row->id])}}" class="">
                                            <img src="{{$row->options->thumbnail}}" alt="" class="">
                                        </a>
                                    </div>
                                    <div class="w-1/2 space-y-2">
                                        <a href="{{route('productDetail', ['id' => $row->id])}}" class="">
                                            <div class="text-blue-500 font-bold">{{number_format($row->options->discount)}}đ <span class="mx-2 text-gray-400 line-through">{{number_format($row->price)}}₫</span></div>
                                            <div class="text-black font-bold">{{$row->name}}</div>
                                        </a>
                                        <div class="">
                                            <span class="">Số lượng:</span>
                                            <input disabled name="qty[{{$row->rowId}}]" type="number" class="w-12 text-center border pl-2 outline-none focus:border-lime-500" placeholder="1" min="1" value="{{$row->qty}}">
                                        </div>
                                    </div>
{{--                                    <div><a href="{{route('remove', $row->rowId)}}" class="text-danger"><i class="fa-solid fa-xmark"></i></a></div>--}}
                                </div>
                            @endforeach
                        </div>
{{--                    </form>--}}
                    <div class="space-y-5 mt-4">
                        <div class="flex justify-between">
                            <span class="text-black font-semibold">Tổng cộng: </span>
                            <span class="font-bold">{{Cart::total()}} đ</span>
                        </div>
                        <div class="flex justify-between ">
                            <span class="text-black font-semibold">Thành tiền: </span>
                            <span class="text-blue-500 font-bold">{{Cart::total()}} đ</span>
                        </div>
                    </div>
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
</x-app-layout>






