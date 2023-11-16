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
                        <div class="bg-white border-2 border-blue-700 text-blue-700 text-2xl w-10 h-10 rounded-full flex justify-center items-center">2</div>
                        <span class="text-blue-700 font-bold text-sm">XÁC NHẬN</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <div class="bg-blue-700 text-white border-2 border-blue-700 text-2xl w-10 h-10 rounded-full flex justify-center items-center">3</div>
                        <span class="text-blue-700 font-bold text-sm">HOÀN THÀNH</span>
                    </div>
                </div>
            </div>
            <div class="max-w-6xl mx-auto py-8 flex justify-between space-x-4">
                <div class="bg-white py-8 w-full">
                    <div class="flex text-blue-700 font-bold text-base justify-between">
                        {{--                        <div id="btn_address" class="w-full text-center h-full py-4 cursor-pointer">Xác nhận</div>--}}
                    </div>
                    <div id="address" class="w-full px-9">
                        Đặt hàng thành công
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
                    <h3 class="text-black font-bold">THÔNG TIN ĐƠN HÀNG</h3>
{{--                    <div class="h-72 overflow-auto">--}}
{{--                        @foreach($carts as $cart)--}}
{{--                            <div class="w-full flex space-x-3 mt-5">--}}
{{--                                <div class="w-1/3">--}}
{{--                                    <a href="{{route('productDetail', ['id' => $cart->product_id])}}" class="">--}}
{{--                                        <img src="{{$cart->product->thumbnail}}" alt="" class="">--}}
{{--                                    </a>--}}
{{--                                </div>--}}
{{--                                <div class="w-1/2 space-y-2">--}}
{{--                                    <a href="{{route('productDetail', ['id' => $cart->product_id])}}" class="">--}}
{{--                                        <div class="text-blue-500 font-bold">{{number_format($cart->product->price * $cart->amount)}}₫</div>--}}
{{--                                        <div class="text-black font-bold">{{$cart->product->name}}</div>--}}
{{--                                    </a>--}}
{{--                                    <div class="">--}}
{{--                                        <span class="">Số lượng:</span>--}}
{{--                                        <input type="number" class="pointer-events-none w-12 text-center border pl-2 outline-none focus:border-lime-500" placeholder="1" min="1" value="{{$cart->amount}}">--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <form action="{{route('remove_cart', ['id' => $cart->product_id])}}" method="POST">--}}
{{--                                    @method('delete')--}}
{{--                                    <button type="submit">--}}
{{--                                        <i class="fa-solid fa-xmark"></i>--}}
{{--                                    </button>--}}
{{--                                </form>--}}
{{--                            </div>--}}
{{--                        @endforeach--}}
{{--                    </div>--}}
{{--                    <div class="space-y-5 mt-4">--}}
{{--                        <div class="flex justify-between">--}}
{{--                            <span class="text-black font-semibold">Tổng cộng: </span>--}}
{{--                            <span class="font-bold">{{number_format($sum)}}</span>--}}
{{--                        </div>--}}
{{--                        <div class="flex justify-between ">--}}
{{--                            <span class="text-black font-semibold">Thành tiền: </span>--}}
{{--                            <span class="text-blue-500 font-bold">{{number_format($sum)}}</span>--}}
{{--                        </div>--}}
{{--                    </div>--}}
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
