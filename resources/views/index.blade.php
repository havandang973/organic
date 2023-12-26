<x-app-layout>
    <div class="w-full h-auto">
        <div class="">
            <div class="relative">
                <div class="">
                    <img src="https://food-03.web4s.vn/uploads/plugin/gallery/124/1566443146-1879127106-banner-1.jpg" alt="" class="">
                    <img src="https://food-03.web4s.vn/uploads/plugin/custom_img/2019-08-22/1566463281-1273542439-custom.jpg" alt="" class="">
                </div>
                <div class="absolute max-w-6xl left-0 right-0 mx-auto top-1/3 my-0 bg-white">
                    <div class="pt-8 pb-40 space-y-4 bg-[url('https://food-03.web4s.vn/uploads/plugin/custom_img/2019-08-22/1566463374-1304854252-custom.jpg')]">
                        <div class="text-center pb-5">
                            <h2 class="text-4xl">About Us</h2>
                        </div>
                        <div class="px-20">
                            <p class="text-sm text-center">Sed eleifend, lacus nec bibendum pulvinar, nibh mauris vehicula augue, sit amet mattis ligula lorem eu nisl. Integer a egestas mauris. Nam id diam blandit, condimentum dolor ut, euismod arcu. Sed eleifend, lacus nec bibendum pulvinar, nibh mauris vehicula augue, sit amet mattis ligula lorem eu nisl. Integer a egestas mauris. Nam id diam blandit, condimentum dolor ut, euismod arcu.</p>
                        </div>
                        <div class="">
                            <a href="" class="w-fit mx-auto py-2 px-3 text-lime-500 block border hover:text-white hover:bg-lime-500 border-lime-500 transition-all">Read More</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="w-full">
                <div class="max-w-6xl mx-auto py-14">
                    <div class="text-center pb-5 mb-6">
                        <h2 class="text-4xl">Big Sale Today</h2>
                    </div>
                    <div class="flex">
                        <div class="w-3/5">
                            <img src="https://food-03.web4s.vn/uploads/plugin/custom_img/2019-08-22/1566453780-1268327630-custom.jpg" alt="" class="">
                        </div>
                        <div class="space-y-5">
                            <h2 class="text-red-500 text-2xl font-semibold">GET 30% OFF YOUR ORDER OF $100 OR MORE...</h2>
                            <p class="text-sm">Duis sed odio sit amet nibh vutate cursus a sit amet mauris.Morbi accumsan ipsum velit.Duis sed odio sit amet nibh vutate cursus a sit amet mauris.Morbi accumsan ipsum velit.</p>
                            <div class="">
                                <a href="" class="w-fit mx-auto py-2 px-3 text-lime-500 block border hover:text-white hover:bg-lime-500 border-lime-500 transition-all">SHOP NOW</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="w-full">
                <div class="flex">
                    <div class="flex basis-1/2 items-center justify-around bg-orange-50">
                        <div class="w-2/5">
                            <img src="https://food-03.web4s.vn/uploads/plugin/custom_img/2019-08-22/1566458146-1331048821-custom.png" alt="" class="">
                        </div>
                        <div class="text-center space-y-3">
                            <h2 class="text-4xl text-gray-500 italic">Save up to 50%</h2>
                            <p class="text-xl text-emerald-400 italic">on your first purchase</p>
                            <a href="" class="w-fit text-lg rounded-3xl mx-auto py-2 px-6 text-amber-500 block border-2 hover:text-white hover:bg-amber-500 border-amber-500 transition-all">Show now</a>
                        </div>
                    </div>
                    <div class="flex basis-1/2 justify-around items-center bg-lime-300">
                        <div class="text-center space-y-3">
                            <h2 class="text-4xl text-gray-500 italic">Free Shipping</h2>
                            <p class="text-xl text-black italic">On order over $99</p>
                            <a href="" class="w-fit text-lg rounded-3xl mx-auto py-2 px-6 text-lime-600 block border-2 hover:text-white hover:bg-lime-600 border-lime-600 transition-all">Track now</a>
                        </div>
                        <div class="w-2/5">
                            <img src="https://food-03.web4s.vn/uploads/plugin/custom_img/2019-08-22/1566458146-1026729843-custom.png" alt="" class="">
                        </div>
                    </div>
                </div>
            </div>

            <div class="w-full">
                <div class="max-w-6xl mx-auto py-9">
                    <div class="text-center space-y-6">
                        <h2 class="text-4xl">Our Product</h2>
                        <div class="text-sm">
                            <a href="" class="">RAU-CỦ-QUẢ</a>
                            <span class="">/</span>
                            <a href="" class="">THỊT-HẢI SẢN</a>
                        </div>
                    </div>
                    <div class="grid grid-cols-4 gap-8 my-8">
                        @foreach($products as $product)
                            <div class="w-fit border border-gray-300 relative group py-4">
                                <div class="w-fit absolute z-50 top-0 left-0">
                                    @if($product->discount != 0)
                                        <div class="px-4 py-1 bg-lime-500 text-white text-sm rounded-md mt-4 ml-4">{{$product->discount}}%</div>
                                    @endif
                                </div>
                                <div class="">
                                    <img src="{{$product->thumbnail}}" alt="" class="">
                                </div>
                                <div class="text-center space-y-8">
                                    <h4 class="font-medium text-base text-gray-600">{{$product->name}}</h4>
                                    <div class="text-lg space-x-2 italic">
                                        <span class="">{{number_format($product->price - (($product->price * $product->discount)/100))}} ₫</span>
                                        @if($product->discount != 0)
                                            <span class="text-gray-600 line-through">{{number_format($product->price)}} ₫</span>
                                        @endif
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
                                        <form action="{{route('add', $product->id)}}" method="POST" class="addToCartForm justify-between text-white text-center border hover:border-lime-500 hover:bg-lime-500 border-white transition-all cursor-pointer">
                                            @csrf
                                            <button type="button" class="addToCartBtn flex justify-between py-2 px-3">
                                                <div class=""><i class="fa-solid fa-cart-shopping"></i></div>
                                                <input type="hidden" name="amount" value="1">
                                                <input type="hidden" name="product_id" value="{{$product->id}}">
                                                <div class="">ADD TO CART</div>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="">
                        <a href="" class="w-fit mx-auto py-3 px-10 text-white block border hover:text-lime-500 hover:bg-white bg-lime-500 border-lime-500 transition-all">Load More</a>
                    </div>
                </div>
            </div>

            <div class="w-full h-fit py-14 flex justify-center items-center bg-no-repeat bg-[url('https://food-03.web4s.vn/uploads/plugin/custom_img/2019-08-23/1566524667-992742715-custom.jpg')]">
                <div class="max-w-5xl text-center space-y-6">
                    <div class="mx-auto w-fit">
                        <img src="https://food-03.web4s.vn/uploads/plugin/custom_img/2019-08-23/1566524351-1356571948-custom.jpg" alt="" class="rounded-full">
                    </div>
                    <div class="flex flex-col items-center space-y-6">
                        <div class="text-white text-2xl">
                            <p class="">Quisque nec facilisis sem. In at commodo velit. Aliquam tempor volutpat laoreet. Quisque non tellus eleifend arcu gravida aliquam. Vivamus quis consequat nisl, nec luctus libero. Nam sodales sem egestas sem blandit volutpat.</p>
                        </div>
                        <div class="flex items-center space-x-4">
                            <hr class="w-14">
                            <span class="text-white">KUSHOVA</span>
                            <hr class="w-14">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
</x-app-layout>
