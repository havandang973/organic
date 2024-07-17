<div class="w-full h-auto">
    <div class="">
        <div class="w-full bg-lime-500 py-1 text-white">
            <div class="max-w-7xl px-10 mx-auto flex justify-between items-center">
                <div class="">
                    <p>FREE SHIPPING ON EVERY DEMESTIC ORDER OF $40 OR MORE!</p>
                </div>
                @if(\Illuminate\Support\Facades\Auth::check())
                <!-- Settings Dropdown -->
                <div class="hidden sm:flex sm:items-center sm:ms-6">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 rounded-md text-white dark:text-gray-400 dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                                <div>{{ Auth::user()->name }}</div>

                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                                 onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
                <!-- Hamburger -->
                <div class="-me-2 flex items-center sm:hidden">
                    <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <!-- Responsive Navigation Menu -->
                <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
                    <div class="pt-2 pb-3 space-y-1">
                        <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                            {{ __('Dashboard') }}
                        </x-responsive-nav-link>
                    </div>

                    <!-- Responsive Settings Options -->
                    <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
                        <div class="px-4">
                            <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                            <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                        </div>

                        <div class="mt-3 space-y-1">
                            <x-responsive-nav-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-responsive-nav-link>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-responsive-nav-link :href="route('logout')"
                                                       onclick="event.preventDefault();
                                        this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-responsive-nav-link>
                            </form>
                        </div>
                    </div>
                </div>
                @else
                    @if (Route::has('login'))
                        <div class="flex">
                            <div class="border-r pr-4">
                                <a href="{{ route('login') }}" class="text-white hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">Đăng nhập</a>
                            </div>
                    @endif

                    @if (Route::has('register'))
                                <div class="pl-4">
                                    <a href="{{ route('register') }}" class="text-white hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">Đăng kí tài khoản</a>
                                </div>
                        </div>
                    @endif
                @endif
            </div>
        </div>
        <div class="max-w-7xl px-10 mx-auto grid grid-cols-3 items-center my-8 space-x-6">
            <div class="col-span-1">
                <img src="https://food-03.web4s.vn/uploads/plugin/setting/3/1566437894-1150892441-organic.png" alt="">
            </div>
            <div class="w-fit border-4 border-double p-4 text-center col-span-1">
                <h5 class="font-medium">New Daily Holiday Deals</h5>
                <h6 class="text-gray-500">24 Hours Only - Ends Midnight!</h6>
                <h6 class="text-gray-500">No Promo code Required</h6>
            </div>
            <div class="space-y-3 col-span-1">
                <div class="flex justify-between flex-wrap">
                    <div class="flex items-center space-x-1">
                        <span class="text-lime-500"><i class="fa-solid fa-phone"></i></span>
                        <span class="">(+84)1234-5678</span>
                    </div>
                    <div class="flex items-center space-x-1">
                        <span class="text-lime-500"><i class="fa-solid fa-envelope"></i></span>
                        <span class="">contact@yourdomain.com</span>
                    </div>
                </div>
                <div class="grid grid-cols-12 items-center">
                    <input class="outline-none border-none bg-gray-200 py-2 px-4 col-span-10" type="text" placeholder="Từ khóa tìm kiếm">
                    <div class="bg-lime-400 col-span-2 justify-content-center items-center">
                        <button type="submit" class="py-2 px-4"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="border-t">
            <div class="max-w-7xl px-10 mx-auto flex justify-between items-center py-3">
                <div class="">
                    <ul class="flex space-x-10 text-gray-600 font-semibold">
                        <li class="hover:text-lime-500"><a href="/">TRANG CHỦ</a></li>
                        <li class="hover:text-lime-500"><a href="#">CỬA HÀNG</a></li>
                        <li class="hover:text-lime-500"><a href="#">TIN TỨC</a></li>
                        <li class="hover:text-lime-500"><a href="#">GIỚI THIỆU</a></li>
                        <li class="hover:text-lime-500"><a href="#">LIÊN HỆ</a></li>
                    </ul>
                </div>
                <div class="space-x-6 text-xl flex relative">
                    <a href="{{route('address')}}"><i class="fa-solid fa-house"></i></a>
                    <a href="#" class=""><i class="fa-solid fa-code-compare"></i></a>
                    <div class="group">
                        <a href="/cart" class="">
                            <div class="relative">
                                <i class="fa-solid fa-cart-shopping"></i>
                                <div id="cartItemCount" class="absolute -top-2 -right-2 w-5 h-5 text-white text-xs font-semibold rounded-full bg-lime-500 flex justify-center items-center">
                                    {{{Cart::count()}}}</div>
                            </div>
                            @if(!request()->is('cart'))
                                <div class="hidden group-hover:block w-96 shadow top-7 right-0 absolute z-[1000] bg-white p-4 py-8">
                                <form class="updateCartForm" action="{{route('update')}}" method="POST">
                                    @csrf
                                    <div class="flex justify-between items-center mb-4">
                                        <h4 class="text-black font-semibold text-lg">THÔNG TIN ĐƠN HÀNG</h4>
{{--                                        @if(Cart::count())--}}
{{--                                            <button type="button" class="updateCart px-4 py-2 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Cập nhật</button>--}}
{{--                                        @endif--}}
                                    </div>

                                        <div>
                                            <div id="cartItemsContainer" class="h-72 overflow-auto">
                                                @if(Cart::count())
                                                    @foreach(Cart::content() as $row)
                                                    <div class="cart-item w-full flex mt-5 text-sm">
                                                        <div class="w-1/3">
                                                            <a href="{{route('productDetail', ['id' => $row->id])}}" class="">
                                                                <img src="{{$row->options->thumbnail}}" alt="" class="">
                                                            </a>
                                                        </div>
                                                        <div class="w-1/2 space-y-2 ml-3">
                                                            <a href="{{route('productDetail', ['id' => $row->id])}}" class="">
                                                                <div class="text-blue-500 font-bold">{{number_format($row->options->discount)}}đ
                                                                    <span class="mx-2 text-gray-400 line-through">{{number_format($row->price)}}₫</span>
                                                                </div>
                                                                <div class="text-black font-bold">{{$row->name}}</div>
                                                            </a>
                                                            <div class="">
                                                                <span class="">Số lượng:</span>
                                                                <input name="qty[{{$row->rowId}}]" disabled type="number" class="border-none w-16 h-7 text-center border pl-2 outline-none focus:border-lime-500" placeholder="1" min="1" value="{{$row->qty}}">
                                                            </div>
                                                        </div>
{{--                                                        <div class="ml-3 cursor-pointer"><a data-row-id="{{$row->rowId}}" class="removeCart text-danger"><i class="fa-solid fa-xmark"></i></a></div>--}}
                                                    </div>
                                                    @endforeach
                                            </div>
                                            <div class="space-y-5 mt-4 text-base">
                                                <div class="flex justify-between">
                                                    <span class="text-black font-semibold">Tổng cộng: </span>
                                                    <span class="total font-bold">{{Cart::total()}} đ</span>
                                                </div>
                                                <div class="flex justify-between text-base">
                                                    <span class="text-black font-semibold">Thành tiền: </span>
                                                    <span class="total text-blue-500 font-bold">{{Cart::total()}} đ</span>
                                                </div>
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
                            @endif
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/cart/add.js') }}"></script>
<script src="{{ asset('js/cart/update.js') }}"></script>
<script src="{{ asset('js/cart/delete.js') }}"></script>


