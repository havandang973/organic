<x-app-layout>
    <div class="w-full h-full">
        <div class="w-full bg-no-repeat -my-6 bg-center bg-[url('https://food-03.web4s.vn/uploads/plugin/custom_img/2018-09-10/1536547650-699688875-custom.jpg')]">
            <div class="max-w-6xl mx-auto py-36 text-white text-xl text-center font-semibold">
                <span class=""><a href="" class="">TRANG CHỦ / </a></span>
                <span class="text-yellow-500">THÔNG TIN ĐƠN HÀNG</span>
            </div>
        </div>
        <div class="w-full bg-gray-200 py-8">
            <div class="max-w-6xl mx-auto py-8 flex justify-between space-x-4">
                <div class="bg-white py-8 w-full">
                    <div class="flex text-blue-700 font-bold text-base justify-between">
                        <div id="btn_address" class="w-full text-center h-full py-4 cursor-pointer">ĐỊA CHỈ GIAO HÀNG</div>
                        {{--                        <div id="btn_login" class="bg-gray-300 text-black hover:bg-white w-full h-full text-center py-4 cursor-pointer">ĐĂNG NHẬP</div>--}}
                    </div>
                    <div id="address" class="w-full px-9">
                        <div class="w-full grid grid-cols-4 gap-4">
                            @foreach($addresses as $address)
                                <div class="w-full flex flex-col bg-gray-100 rounded-lg space-y-2 p-5 relative">
                                    <a class="mx-5 px-2 right-0 cursor-pointer block absolute rounded-lg border border-gray-600 hover:bg-gray-300" href="{{route('delete.address', $address->id)}}"><i class="text-xs block fa-solid fa-xmark"></i></a>
                                    <div class="flex items-center space-x-1">
                                        <i class="fa-regular fa-user"></i>
                                        <span class="text-sm">{{$address->name}}</span>
                                    </div>
                                    <div class="flex items-center space-x-1">
                                        <i class="fa-solid fa-location-dot"></i>
                                        <span class="text-sm">{{$address->address}}</span>
                                    </div>
                                    <div class="flex items-center space-x-1">
                                        <i class="fa-solid fa-phone-volume"></i>
                                        <span class="text-sm">{{$address->telephone}}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <form action="/address" method="POST" class="space-y-6 flex justify-center flex-wrap mt-10">
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
{{--                            <div class="w-full flex-col space-y-6">--}}
{{--                                <input value="{{ old('email') }}" name="email" type="text" class="w-full px-3 py-2 outline-none border" placeholder="Email">--}}
{{--                                --}}{{--                                <input type="text" class="w-full px-3 py-2 outline-none border" placeholder="Ghi chú">--}}
{{--                                @if ($errors->has('email'))--}}
{{--                                    <span class="error text-red-600">{{ $errors->first('email') }}</span>--}}
{{--                                @endif--}}
{{--                            </div>--}}
                            <div class="w-full gap-12">
                                {{--                                <input type="text" class="px-3 py-2 outline-none border w-full" placeholder="Họ và tên">--}}
                                <input value="{{ old('telephone') }}" name="telephone" type="text" class="px-3 py-2 outline-none border w-full" placeholder="Số điện thoại">
                                @if ($errors->has('telephone'))
                                    <span class="error text-red-600">{{ $errors->first('telephone') }}</span>
                                @endif
                            </div>
                            <div class="w-full flex-col space-y-6">
                                <input value="{{ old('payment_methods') }}" name="payment_methods" type="text" class="w-full px-3 py-2 outline-none border" placeholder="Phương thức thanh toán">
{{--                                <input type="text" class="w-full px-3 py-2 outline-none border" placeholder="Ghi chú">--}}
                                @if ($errors->has('payment_methods'))
                                    <span class="error text-red-600">{{ $errors->first('payment_methods') }}</span>
                                @endif
                            </div>
                            <input type="hidden" class="" name="user_id" value="{{ Auth::user()->id }}">
                            <div class="text-center">
                                <button type="submit" class="px-12 bg-indigo-600 hover:bg-indigo-500 text-white font-semibold py-3 rounded-lg">
                                    Lưu
                                </button>
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
