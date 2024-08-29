<x-app-layout>
    <!-- HERO SECTION PART START -->
    <div class="hero_section">
        {{-- <div class="png_img"><img class="w-100 img-fluid" src="{{asset('uploads/banner_poster.jpg')}}" alt="" /></div> --}}
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="herosection_content">
                        <h2 style="color: #fff">Sản phẩm</h2>
                        <a href="/" class="btn border-radius-0 border-transparent">Trang chủ</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- HERO SECTION PART END-->
    <div class="full-bestSeller" id="product" style="margin-top: 2rem">
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
                        <select id="sortSelect" class="form-control d-inline-block w-auto"
                            style="padding: 0px 10px; height: 30px;">
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
                <form id="filterForm" method="GET" action="{{ route('products') }}">
                    <div class="row mt-3">
                        <!-- Cột lọc sản phẩm -->
                        <div class="col-md-3">
                            <div class="filter-sidebar">
                                <!-- Lọc theo danh mục -->
                                <div class="filter-group mb-4">
                                    <h5 class="mb-2">Danh mục</h5>
                                    <ul class="list-group">
                                        @foreach ($categories as $category)
                                            <li class="list-group-item d-flex align-items-center">
                                                <div class="form-check">
                                                    <input type="checkbox" name="categories[]"
                                                        value="{{ $category->id }}" class="form-check-input"
                                                        {{ request()->has('categories') && in_array($category->id, request()->get('categories')) ? 'checked' : '' }}>
                                                    <label class="form-check-label">{{ $category->category }}</label>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>

                                <!-- Lọc theo giá -->
                                <div class="filter-group mb-4">
                                    <h5 class="mb-2">Giá</h5>
                                    <div class="d-flex justify-content-between mb-2">
                                        <span id="priceRangeMinLabel">{{ request()->get('price_min', 0) }}₫</span>
                                        <span id="priceRangeMaxLabel">{{ request()->get('price_max', 2000000) }}₫</span>
                                    </div>
                                    <input type="range" class="form-range" min="0" max="2000000"
                                        step="100" id="priceRangeMin" name="price_min"
                                        value="{{ request()->get('price_min', 0) }}" oninput="updatePriceRange()">
                                    <input type="range" class="form-range" min="0" max="2000000"
                                        step="100" id="priceRangeMax" name="price_max"
                                        value="{{ request()->get('price_max', 2000000) }}" oninput="updatePriceRange()">
                                    <p>Giá: <span id="priceValue">{{ request()->get('price_min', 0) }}₫ -
                                            {{ request()->get('price_max', 2000000) }}₫</span></p>
                                </div>

                                <!-- Lọc theo thương hiệu -->
                                <div class="filter-group mb-4">
                                    <h5 class="mb-2">Thương hiệu</h5>
                                    <ul class="list-group">
                                        @foreach ($brands as $brand)
                                            <li class="list-group-item d-flex align-items-center">
                                                <div class="form-check">
                                                    <input type="checkbox" name="brands[]" value="{{ $brand->id }}"
                                                        class="form-check-input"
                                                        {{ request()->has('brands') && in_array($brand->id, request()->get('brands')) ? 'checked' : '' }}>
                                                    <label class="form-check-label">{{ $brand->brand }}</label>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>

                        </div>

                        <!-- Cột sản phẩm -->
                        <div class="col-md-9">
                            <div class="row" id="productList">
                                @foreach ($products as $product)
                                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 mb-4 product-item"
                                        data-category="{{ $product->category->id }}"
                                        data-brand="{{ $product->brand->brand }}"
                                        data-price="{{ $product->price - ($product->price * $product->discount) / 100 }}"
                                        data-name="{{ $product->name }}">
                                        <div class="product">
                                            <div class="product-img">
                                                <img class="w-100" src="{{ $product->thumbnail }}" alt="">
                                            </div>
                                            <div class="product-content">
                                                <div class="product-details position-bottom-left">
                                                    <h3 class="product-name"><a
                                                            href="{{ route('productDetail', ['id' => $product->id]) }}">{{ $product->name }}</a>
                                                    </h3>
                                                    <span
                                                        class="product-price">{{ number_format($product->price - ($product->price * $product->discount) / 100) }}
                                                        ₫</span>
                                                    @if ($product->discount != 0)
                                                        <span
                                                            class="product-prev-price">{{ number_format($product->price) }}
                                                            ₫</span>
                                                    @endif
                                                </div>
                                                <div class="buttons">
                                                    @if ($product->max_amount === 0)
                                                        <span class="sold-out-tag position-top-right">Hết hàng</span>
                                                    @elseif($product->discount != 0)
                                                        <span
                                                            class="sold-out-tag position-top-right">-{{ $product->discount }}%</span>
                                                    @endif
                                                    <form action="{{ route('add', $product->id) }}" method="POST"
                                                        class="addToCartForm">
                                                        @csrf
                                                        <button type="button"
                                                            class="addToCartBtn btn custom-btn position-bottom-right">
                                                            <svg xmlns="http://www.w3.org/2000/svg" version="1.1"
                                                                xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                width="24" height="24" x="0" y="0"
                                                                viewBox="0 0 511.728 511.728"
                                                                style="enable-background:new 0 0 512 512"
                                                                xml:space="preserve" class="">
                                                                <g>
                                                                    <path
                                                                        d="M147.925 379.116c-22.357-1.142-21.936-32.588-.001-33.68 62.135.216 226.021.058 290.132.103 17.535 0 32.537-11.933 36.481-29.017l36.404-157.641c2.085-9.026-.019-18.368-5.771-25.629s-14.363-11.484-23.626-11.484c-25.791 0-244.716-.991-356.849-1.438L106.92 54.377c-4.267-15.761-18.65-26.768-34.978-26.768H15c-8.284 0-15 6.716-15 15s6.716 15 15 15h56.942a6.246 6.246 0 0 1 6.017 4.592l68.265 253.276c-12.003.436-23.183 5.318-31.661 13.92-8.908 9.04-13.692 21.006-13.471 33.695.442 25.377 21.451 46.023 46.833 46.023h21.872a52.18 52.18 0 0 0-5.076 22.501c0 28.95 23.552 52.502 52.502 52.502s52.502-23.552 52.502-52.502a52.177 52.177 0 0 0-5.077-22.501h94.716a52.185 52.185 0 0 0-5.073 22.493c0 28.95 23.553 52.502 52.502 52.502 28.95 0 52.503-23.553 52.503-52.502a52.174 52.174 0 0 0-5.464-23.285c5.936-1.999 10.216-7.598 10.216-14.207 0-8.284-6.716-15-15-15zm91.799 52.501c0 12.408-10.094 22.502-22.502 22.502s-22.502-10.094-22.502-22.502c0-12.401 10.084-22.491 22.483-22.501h.038c12.399.01 22.483 10.1 22.483 22.501zm167.07 22.494c-12.407 0-22.502-10.095-22.502-22.502 0-12.285 9.898-22.296 22.137-22.493h.731c12.24.197 22.138 10.208 22.138 22.493-.001 12.407-10.096 22.502-22.504 22.502zm74.86-302.233c.089.112.076.165.057.251l-15.339 66.425H414.43l8.845-67.023 58.149.234c.089.002.142.002.23.113zm-154.645 163.66v-66.984h53.202l-8.84 66.984zm-74.382 0-8.912-66.984h53.294v66.984zm-69.053 0h-.047c-3.656-.001-6.877-2.467-7.828-5.98l-16.442-61.004h54.193l8.912 66.984zm56.149-96.983-9.021-67.799 66.306.267v67.532zm87.286 0v-67.411l66.022.266-8.861 67.145zm-126.588-67.922 9.037 67.921h-58.287l-18.38-68.194zm237.635 164.905H401.63l8.84-66.984h48.973l-14.137 61.217a7.406 7.406 0 0 1-7.25 5.767z"
                                                                        fill="#ffffff" opacity="1"
                                                                        data-original="#000000" class=""></path>
                                                                </g>
                                                            </svg>
                                                            <input type="hidden" name="amount" value="1">
                                                            <input type="hidden" name="product_id"
                                                                value="{{ $product->id }}">
                                                        </button>
                                                    </form>
                                                </div>

                                                <div class="icons position-center" style="display: ruby;">
                                                    <a class="rounded-icon"
                                                        href="{{ route('productDetail', ['id' => $product->id]) }}">
                                                        <i class="fa-solid fa-eye"></i>
                                                    </a>
                                                    <form action="{{ route('compare.add', $product->id) }}"
                                                        method="POST" class="addToCompareForm">
                                                        @csrf
                                                        <button type="button"
                                                            class="addToCompareBtn rounded-icon border-0">
                                                            <i class="fa-solid fa-code-compare"></i>
                                                            <input type="hidden" name="product_id"
                                                                value="{{ $product->id }}">
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
                </form>

                <!-- Cột hiển thị sản phẩm -->

                <div class="full-bestSeller">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 text-left">
                                <h4 class="section-title">Sản phẩm khác</h3>
                            </div>
                        </div>

                        <div class="row mt-5 product-slider">
                            @foreach ($products as $product)
                                <div class="col-xs-12 col-md-12 col-lg-12 col-xl-12 mb-12">
                                    <div class="product">
                                        <div class="product-img">
                                            <img class="w-100" src="{{ asset($product->thumbnail) }}"
                                                alt="">
                                        </div>
                                        <div class="product-content">
                                            <div class="product-details position-bottom-left">
                                                <h3 class="product-name"><a
                                                        href="productdetails.html">{{ $product->name }}</a></h3>
                                                <span
                                                    class="product-price">{{ number_format($product->price - ($product->price * $product->discount) / 100) }}
                                                    ₫</span>
                                                @if ($product->discount != 0)
                                                    <span
                                                        class="product-prev-price">{{ number_format($product->price) }}
                                                        ₫</span>
                                                @endif
                                            </div>
                                            <div class="buttons">
                                                @if ($product->max_amount === 0)
                                                    <span class="sold-out-tag position-top-right">Hết hàng</span>
                                                @elseif($product->discount != 0)
                                                    <span
                                                        class="sold-out-tag position-top-right">-{{ $product->discount }}%</span>
                                                @endif
                                                <form action="{{ route('add', $product->id) }}" method="POST"
                                                    class="addToCartForm">
                                                    @csrf
                                                    <button type="button"
                                                        class="addToCartBtn btn custom-btn position-bottom-right">
                                                        <svg xmlns="http://www.w3.org/2000/svg" version="1.1"
                                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24"
                                                            height="24" x="0" y="0" viewBox="0 0 511.728 511.728"
                                                            style="enable-background:new 0 0 512 512"
                                                            xml:space="preserve" class="">
                                                            <g>
                                                                <path
                                                                    d="M147.925 379.116c-22.357-1.142-21.936-32.588-.001-33.68 62.135.216 226.021.058 290.132.103 17.535 0 32.537-11.933 36.481-29.017l36.404-157.641c2.085-9.026-.019-18.368-5.771-25.629s-14.363-11.484-23.626-11.484c-25.791 0-244.716-.991-356.849-1.438L106.92 54.377c-4.267-15.761-18.65-26.768-34.978-26.768H15c-8.284 0-15 6.716-15 15s6.716 15 15 15h56.942a6.246 6.246 0 0 1 6.017 4.592l68.265 253.276c-12.003.436-23.183 5.318-31.661 13.92-8.908 9.04-13.692 21.006-13.471 33.695.442 25.377 21.451 46.023 46.833 46.023h21.872a52.18 52.18 0 0 0-5.076 22.501c0 28.95 23.552 52.502 52.502 52.502s52.502-23.552 52.502-52.502a52.177 52.177 0 0 0-5.077-22.501h94.716a52.185 52.185 0 0 0-5.073 22.493c0 28.95 23.553 52.502 52.502 52.502 28.95 0 52.503-23.553 52.503-52.502a52.174 52.174 0 0 0-5.464-23.285c5.936-1.999 10.216-7.598 10.216-14.207 0-8.284-6.716-15-15-15zm91.799 52.501c0 12.408-10.094 22.502-22.502 22.502s-22.502-10.094-22.502-22.502c0-12.401 10.084-22.491 22.483-22.501h.038c12.399.01 22.483 10.1 22.483 22.501zm167.07 22.494c-12.407 0-22.502-10.095-22.502-22.502 0-12.285 9.898-22.296 22.137-22.493h.731c12.24.197 22.138 10.208 22.138 22.493-.001 12.407-10.096 22.502-22.504 22.502zm74.86-302.233c.089.112.076.165.057.251l-15.339 66.425H414.43l8.845-67.023 58.149.234c.089.002.142.002.23.113zm-154.645 163.66v-66.984h53.202l-8.84 66.984zm-74.382 0-8.912-66.984h53.294v66.984zm-69.053 0h-.047c-3.656-.001-6.877-2.467-7.828-5.98l-16.442-61.004h54.193l8.912 66.984zm56.149-96.983-9.021-67.799 66.306.267v67.532zm87.286 0v-67.411l66.022.266-8.861 67.145zm-126.588-67.922 9.037 67.921h-58.287l-18.38-68.194zm237.635 164.905H401.63l8.84-66.984h48.973l-14.137 61.217a7.406 7.406 0 0 1-7.25 5.767z"
                                                                    fill="#ffffff" opacity="1"
                                                                    data-original="#000000" class=""></path>
                                                            </g>
                                                        </svg>
                                                        <input type="hidden" name="amount" value="1">
                                                        <input type="hidden" name="product_id"
                                                            value="{{ $product->id }}">
                                                    </button>
                                                </form>
                                            </div>

                                            <div class="icons position-center" style="display: ruby;">
                                                <a class="rounded-icon"
                                                    href="{{ route('productDetail', ['id' => $product->id]) }}">
                                                    <i class="fa-solid fa-eye"></i>
                                                </a>
                                                <form action="{{ route('compare.add', $product->id) }}"
                                                    method="POST" class="addToCompareForm">
                                                    @csrf
                                                    <button type="button"
                                                        class="addToCompareBtn rounded-icon border-0">
                                                        <i class="fa-solid fa-code-compare"></i>
                                                        <input type="hidden" name="product_id"
                                                            value="{{ $product->id }}">
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Scripts -->
    <script src="{{ asset('js/cart/add.js') }}"></script>
    <script src="{{ asset('js/product/compare.js') }}"></script>
    <script src="{{ asset('js/product/filter.js') }}"></script>
    <style>
        .filter-group h5 {
            font-family: "Barlow Condensed", sans-serif;
            font-size: 1.25rem;
            font-weight: 600;
        }

        .form-check-label {
            font-family: "Barlow Condensed", sans-serif;
            font-size: 1rem;
            font-weight: 600;
            color: #495057;
        }
    </style>

</x-app-layout>
