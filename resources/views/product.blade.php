<x-app-layout>
    <div class="full-bestSeller" id="product" style="margin-top: 8.5rem">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h3 class="section-title">Sản phẩm</h3>
                </div>
            </div>

            <!-- Thêm phần sắp xếp -->
            <div class="row mt-4">
                <div class="col-12 text-right">
                    <div class="sort-options">
                        <label for="sortSelect">Sắp xếp theo:</label>
                        <select id="sortSelect" class="form-control d-inline-block w-auto" style="padding: 0px 10px; height: 30px;">
                            <option value="default">Mặc định</option>
                            <option value="price_asc">Giá: Tăng dần</option>
                            <option value="price_desc">Giá: Giảm dần</option>
                            <option value="name_asc">Tên: A-Z</option>
                            <option value="name_desc">Tên: Z-A</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <!-- Cột lọc sản phẩm -->
                <div class="col-md-3">
                    <div class="filter-sidebar">
{{--                        <h4>Lọc sản phẩm</h4>--}}

                        <!-- Lọc theo danh mục -->
                        <div class="filter-group mb-4">
                            <h5 class="mb-2">Danh mục</h5>
                            <ul class="list-group">
                                @foreach($categories as $category)
                                    <li class="list-group-item">
                                        <a href="?category={{$category->id}}" class="filter-link text-dark">{{$category->category}}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <!-- Lọc theo giá -->
                        <div class="filter-group mb-4">
                            <h5 class="mb-2">Giá</h5>
                            <input type="range" class="form-range" min="0" max="500000" step="100" id="priceRangeMin" value="0" oninput="updatePriceRange()">
                            <input type="range" class="form-range" min="0" max="500000" step="100" id="priceRangeMax" value="10000000" oninput="updatePriceRange()">
                            <p>Giá: <span id="priceValue">0₫ - 10,000,000₫</span></p>
                        </div>

                        <!-- Lọc theo thương hiệu -->
                        <div class="filter-group mb-4">
                            <h5 class="mb-2">Thương hiệu</h5>
                            <ul class="list-group">
                                @foreach($brands as $brand)
                                    <li class="list-group-item">
                                        <input type="checkbox" id="{{$brand->brand}}" name="brand" value="{{$brand->brand}}">
                                        <label for="{{$brand->brand}}"> {{$brand->brand}}</label>
                                    </li>
                                @endforeach
{{--                                <li class="list-group-item">--}}
{{--                                    <input type="checkbox" id="brand1" name="brand" value="brand1">--}}
{{--                                    <label for="brand1"> Thương hiệu 1</label>--}}
{{--                                </li>--}}
{{--                                <li class="list-group-item">--}}
{{--                                    <input type="checkbox" id="brand2" name="brand" value="brand2">--}}
{{--                                    <label for="brand2"> Thương hiệu 2</label>--}}
{{--                                </li>--}}
{{--                                <li class="list-group-item">--}}
{{--                                    <input type="checkbox" id="brand3" name="brand" value="brand3">--}}
{{--                                    <label for="brand3"> Thương hiệu 3</label>--}}
{{--                                </li>--}}
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Cột hiển thị sản phẩm -->
                <div class="col-md-9">
                    <div class="row" id="productList">
                        @foreach($products as $product)
                            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 mb-4 product-item"
                                 data-brand="{{ $product->brand->brand }}"
                                 data-price="{{ $product->price - (($product->price * $product->discount) / 100) }}"
                                 data-name="{{ $product->name }}">
                                <div class="product">
                                    <div class="product-img">
                                        <img class="w-100" src="{{$product->thumbnail}}" alt="">
                                    </div>
                                    <div class="product-content">
                                        <div class="product-details position-bottom-left">
                                            <h3 class="product-name"><a href="{{route('productDetail', ['id' => $product->id])}}">{{$product->name}}</a></h3>
                                            @if($product->discount != 0)
                                                <span class="product-prev-price">{{number_format($product->price)}} ₫</span>
                                            @endif
                                            <span class="product-price">{{number_format($product->price - (($product->price * $product->discount)/100))}} ₫</span>
                                        </div>
                                        <div class="buttons">
                                            @if($product->max_amount === 0)
                                                <span class="sold-out-tag position-top-right">Hết hàng</span>
                                            @elseif($product->discount != 0)
                                                <span class="sold-out-tag position-top-right">-{{$product->discount}}%</span>
                                            @endif
                                            <form action="{{route('add', $product->id)}}" method="POST" class="addToCartForm">
                                                @csrf
                                                <button type="button" class="addToCartBtn btn custom-btn position-bottom-right">
                                                    <input type="hidden" name="amount" value="1">
                                                    <input type="hidden" name="product_id" value="{{$product->id}}">
                                                </button>
                                            </form>
                                        </div>

                                        <div class="icons position-center" style="display: ruby;">
                                            <a class="rounded-icon" href="{{route('productDetail', ['id' => $product->id])}}">
                                                <i class="fa-solid fa-eye"></i>
                                            </a>
                                            <form action="{{route('compare.add', $product->id)}}" method="POST" class="addToCompareForm">
                                                @csrf
                                                <button type="button" class="addToCompareBtn rounded-icon border-0">
                                                    <i class="fa-solid fa-code-compare"></i>
                                                    <input type="hidden" name="product_id" value="{{$product->id}}">
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Phân trang -->
                    <div class="text-center" style="margin-top: 2rem">
                        {{ $products->links('pagination.bootstrap') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
        <!-- Scripts -->
        <script src="{{ asset('js/cart/add.js') }}"></script>
        <script src="{{ asset('js/product/compare.js') }}"></script>
        <script src="{{ asset('js/product/filter.js') }}"></script>
</x-app-layout>
