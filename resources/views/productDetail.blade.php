<x-app-layout>
    <div class="w-full h-full">
        <div class="w-full bg-no-repeat bg-center bg-[url('https://food-03.web4s.vn/uploads/plugin/custom_img/2018-09-10/1536547650-699688875-custom.jpg')]">
            <div class="max-w-6xl mx-auto py-36 text-white text-xl text-center font-semibold">
                <span class=""><a href="" class="">TRANG CHỦ / </a></span>
                <span class=""><a href="" class="">RAU - CỦ - QUẢ / </a></span>
                <span class=""><a href="" class="">TRÁI CÂY / </a></span>
                <span class="text-yellow-500">{{$product->name}}</span>
            </div>
        </div>
        <div class="w-full">
            <div class="max-w-6xl mx-auto flex justify-between space-x-6 py-8">
                <div class="w-4/5">
                    <div class="flex space-x-6">
                        <div class="space-y-6">
                            <div class="">
                                <img class="w-80 border border-gray-300" src="{{$product->thumbnail}}" alt="">
                            </div>
                            <div class="flex space-x-6">
                                <img class="w-24 block border border-gray-300" src="{{$product->thumbnail}}" alt="">
                                <img class="w-24 block border border-gray-300" src="{{$product->thumbnail}}" alt="">
                            </div>
                        </div>
                        <div class="space-y-8 w-3/5 py-2">
                            <div class="space-y-3 border-b pb-3">
                                <h2 class="text-2xl font-bold">{{$product->name}}</h2>
                                <div class="text-sm space-x-4">
                                    <span class="">Mã sản phẩm: <strong>{{$product->code}}</strong></span>
                                    <span class="">Thương hiệu: <strong>{{$product->brand}}</strong></span>
                                </div>
                            </div>
                            <div class="">
                                <div class="flex space-x-4">
                                    <div class="">
                                        <div class="font-bold text-orange-400 text-2xl">{{number_format($product->price - (($product->price * $product->discount)/100))}} ₫</div>
                                        <div class="text-gray-400 line-through">{{number_format($product->price)}} ₫</div>
                                    </div>
                                    <div class="bg-gray-900 text-sm px-4 text-white w-fit h-fit p-1 rounded-3xl">Giảm giá {{$product->discount}} %</div>
                                </div>
                                <div class="mt-2 space-y-8">
                                    <p class="text-sm">{{$product->describe}}</p>
                                    <div class="text-sm">
                                        <div class="">
                                            <span class="">Màu sắc: <strong>{{$product->color}}</strong></span>
                                        </div>
                                        <div class="">
                                            <span class="">Xuất xứ: <strong>{{$product->origin}}</strong></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <form action="/carts" method="POST">
                                <input type="number" name="amount" value="1" class="w-20 text-center border outline-none p-2 focus:border-lime-500" placeholder="1" required min="1" max="{{$product->max_amount}}">
                                <input type="hidden" name="product_id" value="{{$product->id}}">
                                <button type="submit" class="bg-orange-400 rounded-sm py-2 px-4 text-white">Thêm vào giỏ hàng</button>
                            </form>
                        </div>
                    </div>
                    <div class="mt-10">
                        <div class="space-x-6">
                            <a href="" class="bg-orange-400 text-lg rounded-full py-3 px-7 text-white font-medium">Mô tả</a>
                            {{--                            <a href="" class="text-orange-400 text-lg rounded-full py-3 px-7 bg-gray-100 font-medium">Điểm nổi bật</a>--}}
                            {{--                            <a href="" class="text-orange-400 text-lg rounded-full py-3 px-7 bg-gray-100 font-medium">Điều kiện</a>--}}
                        </div>
                        <div class="mt-10">
                            <div class="border p-5 text-sm space-y-3">
                                <p class="text-justify">{{$product->description->general_description}}</p>
                                <img class="w-fit block mx-auto" src="{{$product->description->img}}" alt="">
                                <p class="text-center italic">{{$product->name}}</p>
                                <p class="text-justify">{{$product->description->product_description}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-1/5">
                    <div class="text-center mb-10">
                        <h3 class="text-orange-500 font-semibold text-xl">SẢN PHẨM CÙNG LOẠI</h3>
                    </div>
                    <div class="space-y-6 w-full">
                        @foreach($products as $product)
                            <div class="w-full border border-gray-300 relative group py-4">
                                <div class="w-fit absolute z-50 top-0 left-0">
                                    <div class="px-4 py-1 bg-lime-500 text-white text-sm rounded-md mt-4 ml-4">{{$product->discount}}%</div>
                                </div>
                                <div class="w-full">
                                    <img src="{{$product->thumbnail}}" alt="" class="">
                                </div>
                                <div class="text-center space-y-8">
                                    <h4 class="font-medium text-base text-gray-600">{{$product->name}}</h4>
                                    <div class="text-lg space-x-2 italic">
                                        <span class="">{{number_format($product->price - (($product->price * $product->discount)/100))}} ₫</span>
                                        <span class="text-gray-600 line-through">{{number_format($product->price)}} ₫</span>
                                    </div>
                                </div>
                                <div class="bg-[#00000080] w-full h-full absolute top-0 left-0 hidden group-hover:flex group-hover:justify-center group-hover:items-center transition-all">
                                    <div class="mx-auto w-fit h-fit space-y-4">
                                        <div class="text-lime-500 text-center">
                                            <i class="fa-regular fa-star"></i>
                                            <i class="fa-regular fa-star"></i>
                                            <i class="fa-regular fa-star"></i>
                                            <i class="fa-regular fa-star"></i>
                                            <i class="fa-regular fa-star"></i>
                                        </div>
                                        <div class="flex space-x-3">
                                            <a href="{{route('productDetail', ['id' => $product->id])}}" class="py-2 px-3 text-white block border hover:border-lime-500 hover:bg-lime-500 border-white transition-all cursor-pointer"><i class="fa-solid fa-eye"></i></a>
                                            <a href="" class="py-2 px-3 text-white block border hover:border-lime-500 hover:bg-lime-500 border-white transition-all cursor-pointer"><i class="fa-solid fa-code-compare"></i></a>
                                            <a href="" class="py-2 px-3 text-white block border hover:border-lime-500 hover:bg-lime-500 border-white transition-all cursor-pointer"><i class="fa-solid fa-cart-shopping"></i></a>
                                        </div>
                                        <div class="flex justify-between py-2 px-3 text-white text-center border hover:border-lime-500 hover:bg-lime-500 border-white transition-all cursor-pointer">
                                            <div class=""><i class="fa-solid fa-cart-shopping"></i></div>
                                            <div class="">ADD TO CART</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class=""></div>
        <div class=""></div>
    </div>
</x-app-layout>
