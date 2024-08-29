<x-app-layout>
    <div class="full-banner">
        <div class="container">
            <div class="row banner-slider">
                <div class="col-md-12">
                    <div class="banner-content">
                        <h1>100% <span>Organic</span></h1>
                        <h3>Thực phẩm tươi & tự nhiên</h3>
                        <p>Đảm bảo an toàn thực phẩm. Không chất bảo quản.</p>
                        <a href="/products" class="btn">Sản phẩm <i class="icofont-bubble-right"></i></a>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="banner-content">
                        <h1>100% <span>Organic</span></h1>
                        <h3>Thực phẩm tươi & tự nhiên</h3>
                        <p>Đảm bảo an toàn thực phẩm. Không chất bảo quản.</p>
                        <a href="/products" class="btn">Sản phẩm <i class="icofont-bubble-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- FEATURES PART START -->
    <div class="full-features">
        <div class="container">
            <div class="row slider">
                <div class="col-xs-12 col-md-12 col-lg-12 col-xl-12 mb-4">
                    <div class="features-box text-center">
                        <div class="features-icon-border">
                            <div class="features-icon">
                                <i class="fa-solid fa-seedling"></i>
                            </div>
                        </div>
                        <div class="features-text">
                            <h3>Healthy Food</h3>
                        </div>
                    </div>
                </div>


                <div class="col-xs-12 col-md-12 col-lg-12 col-xl-12 mb-4">
                    <div class="features-box text-center">
                        <div class="features-icon-border">
                            <div class="features-icon">
                                <i class="fa-solid fa-truck-fast"></i>
                            </div>
                        </div>
                        <div class="features-text">
                            <h3>Free Shipping</h3>
                        </div>
                    </div>
                </div>

                <div class="col-xs-12 col-md-12 col-lg-12 col-xl-12 mb-4">
                    <div class="features-box text-center">
                        <div class="features-icon-border">
                            <div class="features-icon">
                                <i class="fa-solid fa-comments"></i>
                            </div>
                        </div>
                        <div class="features-text">
                            <h3>24/07 Support</h3>
                        </div>
                    </div>
                </div>

                <div class="col-xs-12 col-md-12 col-lg-12 col-xl-12 mb-4">
                    <div class="features-box text-center">
                        <div class="features-icon-border">
                            <div class="features-icon">
                                <i class="fa-solid fa-apple-whole"></i>
                            </div>
                        </div>
                        <div class="features-text">
                            <h3>From our farm</h3>
                        </div>
                    </div>
                </div>

                <div class="col-xs-12 col-md-12 col-lg-12 col-xl-12 mb-4">
                    <div class="features-box text-center">
                        <div class="features-icon-border">
                            <div class="features-icon">
                                <i class="fa-solid fa-seedling"></i>
                            </div>
                        </div>
                        <div class="features-text">
                            <h3>Healthy Food</h3>
                        </div>
                    </div>
                </div>

                <div class="col-xs-12 col-md-12 col-lg-12 col-xl-12 mb-4">
                    <div class="features-box text-center">
                        <div class="features-icon-border">
                            <div class="features-icon">
                                <i class="fa-solid fa-truck-fast"></i>
                            </div>
                        </div>
                        <div class="features-text">
                            <h3>Free Shipping</h3>
                        </div>
                    </div>
                </div>

                <div class="col-xs-12 col-md-12 col-lg-12 col-xl-12 mb-4">
                    <div class="features-box text-center">
                        <div class="features-icon-border">
                            <div class="features-icon">
                                <i class="fa-solid fa-comments"></i>
                            </div>
                        </div>
                        <div class="features-text">
                            <h3>24/07 Support</h3>
                        </div>
                    </div>
                </div>

                <div class="col-xs-12 col-md-12 col-lg-12 col-xl-12 mb-4">
                    <div class="features-box text-center">
                        <div class="features-icon-border">
                            <div class="features-icon">
                                <i class="fa-solid fa-apple-whole"></i>
                            </div>
                        </div>
                        <div class="features-text">
                            <h3>From our farm</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- FEATURES PART END -->

    <!-- BEST SELLER PART START -->
    <div class="full-bestSeller" id="product">
        <div class="container">
            <div class="row">
                <div class="row">
                    <div class="col-12 text-center">
                        <div class="d-flex align-items-center justify-content-center">
                            <img src="https://nan.m-society.go.th/wp-content/uploads/2023/01/new-brand-new-2.gif" alt="Sản phẩm mới" class="img-fluid rounded" style="width: 100px;">
                            <h3 class="section-title mx-3">Sản phẩm mới</h3>
                            <img src="https://nan.m-society.go.th/wp-content/uploads/2023/01/new-brand-new-2.gif" alt="Sản phẩm mới" class="img-fluid rounded" style="width: 100px;">
                        </div>
                        <p class="text-muted">Khám phá những sản phẩm mới nhất và hot nhất của chúng tôi!</p>
                    </div>
                </div>
            </div>

            <div class="row mt-5">
                @foreach ($newProducts as $product)
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 mb-4">
                        <div class="product">
                            <div class="product-img">
                                <img class="w-100" src="{{ $product->thumbnail }}" alt="">
                            </div>
                            <div class="product-content">
                                <div class="product-details position-bottom-left">
                                    <h3 class="product-name"><a href="productdetails.html">{{ $product->name }}</a></h3>
                                    <span
                                        class="product-price">{{ number_format($product->price - ($product->price * $product->discount) / 100) }}
                                        ₫</span>
                                    @if ($product->discount != 0)
                                        <span class="product-prev-price">{{ number_format($product->price) }} ₫</span>
                                    @endif
                                </div>
                                <div class="buttons">
                                    @if ($product->max_amount === 0)
                                        <span class="sold-out-tag position-top-right">Hết hàng</span>
                                    @elseif($product->discount != 0)
                                        <span class="sold-out-tag position-top-right">-{{ $product->discount }}%</span>
                                    @endif
                                    <form action="{{ route('add', $product->id) }}" method="POST"
                                        class="addToCartForm">
                                        @csrf
                                        <button type="button"
                                            class="addToCartBtn btn custom-btn position-bottom-right">
                                            <svg xmlns="http://www.w3.org/2000/svg" version="1.1"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" width="24" height="24"
                                                x="0" y="0" viewBox="0 0 511.728 511.728"
                                                style="enable-background:new 0 0 512 512" xml:space="preserve"
                                                class="">
                                                <g>
                                                    <path
                                                        d="M147.925 379.116c-22.357-1.142-21.936-32.588-.001-33.68 62.135.216 226.021.058 290.132.103 17.535 0 32.537-11.933 36.481-29.017l36.404-157.641c2.085-9.026-.019-18.368-5.771-25.629s-14.363-11.484-23.626-11.484c-25.791 0-244.716-.991-356.849-1.438L106.92 54.377c-4.267-15.761-18.65-26.768-34.978-26.768H15c-8.284 0-15 6.716-15 15s6.716 15 15 15h56.942a6.246 6.246 0 0 1 6.017 4.592l68.265 253.276c-12.003.436-23.183 5.318-31.661 13.92-8.908 9.04-13.692 21.006-13.471 33.695.442 25.377 21.451 46.023 46.833 46.023h21.872a52.18 52.18 0 0 0-5.076 22.501c0 28.95 23.552 52.502 52.502 52.502s52.502-23.552 52.502-52.502a52.177 52.177 0 0 0-5.077-22.501h94.716a52.185 52.185 0 0 0-5.073 22.493c0 28.95 23.553 52.502 52.502 52.502 28.95 0 52.503-23.553 52.503-52.502a52.174 52.174 0 0 0-5.464-23.285c5.936-1.999 10.216-7.598 10.216-14.207 0-8.284-6.716-15-15-15zm91.799 52.501c0 12.408-10.094 22.502-22.502 22.502s-22.502-10.094-22.502-22.502c0-12.401 10.084-22.491 22.483-22.501h.038c12.399.01 22.483 10.1 22.483 22.501zm167.07 22.494c-12.407 0-22.502-10.095-22.502-22.502 0-12.285 9.898-22.296 22.137-22.493h.731c12.24.197 22.138 10.208 22.138 22.493-.001 12.407-10.096 22.502-22.504 22.502zm74.86-302.233c.089.112.076.165.057.251l-15.339 66.425H414.43l8.845-67.023 58.149.234c.089.002.142.002.23.113zm-154.645 163.66v-66.984h53.202l-8.84 66.984zm-74.382 0-8.912-66.984h53.294v66.984zm-69.053 0h-.047c-3.656-.001-6.877-2.467-7.828-5.98l-16.442-61.004h54.193l8.912 66.984zm56.149-96.983-9.021-67.799 66.306.267v67.532zm87.286 0v-67.411l66.022.266-8.861 67.145zm-126.588-67.922 9.037 67.921h-58.287l-18.38-68.194zm237.635 164.905H401.63l8.84-66.984h48.973l-14.137 61.217a7.406 7.406 0 0 1-7.25 5.767z"
                                                        fill="#ffffff" opacity="1" data-original="#000000"
                                                        class=""></path>
                                                </g>
                                            </svg>
                                            <input type="hidden" name="amount" value="1">
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        </button>
                                    </form>
                                </div>

                                <div class="icons position-center" style="display: ruby;">
                                    <a class="rounded-icon"
                                        href="{{ route('productDetail', ['id' => $product->id]) }}">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                    <form action="{{ route('compare.add', $product->id) }}" method="POST"
                                        class="addToCompareForm">
                                        @csrf
                                        <button type="button" class="addToCompareBtn rounded-icon border-0">
                                            <i class="fa-solid fa-code-compare"></i>
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="text-center" style="margin-top: 2rem">
                <a href="{{ route('products') }}">
                    <button type="button" class="btn btn-success und">Xem thêm</button>
                </a>
            </div>
        </div>
    </div>
    <!-- BEST SELLER PART END -->

    <!-- BEST SELLER PART START -->
    <div class="full-bestSeller" id="product">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <div class="d-flex align-items-center justify-content-center">
                        <img src="https://media2.giphy.com/media/DTAGWowlEoaX7Y5I94/giphy.gif?cid=6c09b952ik61bsegp78jjktf9d30uw7c3twhog2mw0dex20y&ep=v1_internal_gif_by_id&rid=giphy.gif&ct=ts" alt="Sản phẩm mới" class="img-fluid rounded" style="width: 100px;">
                        <h3 class="section-title mx-3">Sản phẩm bán chạy</h3>
                        <img src="https://media2.giphy.com/media/DTAGWowlEoaX7Y5I94/giphy.gif?cid=6c09b952ik61bsegp78jjktf9d30uw7c3twhog2mw0dex20y&ep=v1_internal_gif_by_id&rid=giphy.gif&ct=ts" alt="Sản phẩm mới" class="img-fluid rounded" style="width: 100px;">
                    </div>
                    <p class="text-muted">Khám phá những sản phẩm ưa chuộng và bán chạy nhất của chúng tôi!</p>
                </div>
            </div>

            <div class="row mt-5">
                @foreach ($bestSellingProducts as $product)
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 mb-4">
                        <div class="product">
                            <div class="product-img">
                                <img class="w-100" src="{{ $product->thumbnail }}" alt="">
                            </div>
                            <div class="product-content">
                                <div class="product-details position-bottom-left">
                                    <h3 class="product-name"><a href="productdetails.html">{{ $product->name }}</a></h3>
                                    <span
                                        class="product-price">{{ number_format($product->price - ($product->price * $product->discount) / 100) }}
                                        ₫</span>
                                    @if ($product->discount != 0)
                                        <span class="product-prev-price">{{ number_format($product->price) }} ₫</span>
                                    @endif
                                </div>
                                <div class="buttons">
                                    @if ($product->max_amount === 0)
                                        <span class="sold-out-tag position-top-right">Hết hàng</span>
                                    @elseif($product->discount != 0)
                                        <span class="sold-out-tag position-top-right">-{{ $product->discount }}%</span>
                                    @endif
                                    <form action="{{ route('add', $product->id) }}" method="POST"
                                        class="addToCartForm">
                                        @csrf
                                        <button type="button"
                                            class="addToCartBtn btn custom-btn position-bottom-right">
                                            <svg xmlns="http://www.w3.org/2000/svg" version="1.1"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" width="24" height="24"
                                                x="0" y="0" viewBox="0 0 511.728 511.728"
                                                style="enable-background:new 0 0 512 512" xml:space="preserve"
                                                class="">
                                                <g>
                                                    <path
                                                        d="M147.925 379.116c-22.357-1.142-21.936-32.588-.001-33.68 62.135.216 226.021.058 290.132.103 17.535 0 32.537-11.933 36.481-29.017l36.404-157.641c2.085-9.026-.019-18.368-5.771-25.629s-14.363-11.484-23.626-11.484c-25.791 0-244.716-.991-356.849-1.438L106.92 54.377c-4.267-15.761-18.65-26.768-34.978-26.768H15c-8.284 0-15 6.716-15 15s6.716 15 15 15h56.942a6.246 6.246 0 0 1 6.017 4.592l68.265 253.276c-12.003.436-23.183 5.318-31.661 13.92-8.908 9.04-13.692 21.006-13.471 33.695.442 25.377 21.451 46.023 46.833 46.023h21.872a52.18 52.18 0 0 0-5.076 22.501c0 28.95 23.552 52.502 52.502 52.502s52.502-23.552 52.502-52.502a52.177 52.177 0 0 0-5.077-22.501h94.716a52.185 52.185 0 0 0-5.073 22.493c0 28.95 23.553 52.502 52.502 52.502 28.95 0 52.503-23.553 52.503-52.502a52.174 52.174 0 0 0-5.464-23.285c5.936-1.999 10.216-7.598 10.216-14.207 0-8.284-6.716-15-15-15zm91.799 52.501c0 12.408-10.094 22.502-22.502 22.502s-22.502-10.094-22.502-22.502c0-12.401 10.084-22.491 22.483-22.501h.038c12.399.01 22.483 10.1 22.483 22.501zm167.07 22.494c-12.407 0-22.502-10.095-22.502-22.502 0-12.285 9.898-22.296 22.137-22.493h.731c12.24.197 22.138 10.208 22.138 22.493-.001 12.407-10.096 22.502-22.504 22.502zm74.86-302.233c.089.112.076.165.057.251l-15.339 66.425H414.43l8.845-67.023 58.149.234c.089.002.142.002.23.113zm-154.645 163.66v-66.984h53.202l-8.84 66.984zm-74.382 0-8.912-66.984h53.294v66.984zm-69.053 0h-.047c-3.656-.001-6.877-2.467-7.828-5.98l-16.442-61.004h54.193l8.912 66.984zm56.149-96.983-9.021-67.799 66.306.267v67.532zm87.286 0v-67.411l66.022.266-8.861 67.145zm-126.588-67.922 9.037 67.921h-58.287l-18.38-68.194zm237.635 164.905H401.63l8.84-66.984h48.973l-14.137 61.217a7.406 7.406 0 0 1-7.25 5.767z"
                                                        fill="#ffffff" opacity="1" data-original="#000000"
                                                        class=""></path>
                                                </g>
                                            </svg>
                                            <input type="hidden" name="amount" value="1">
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        </button>
                                    </form>
                                </div>

                                <div class="icons position-center" style="display: ruby;">
                                    <a class="rounded-icon"
                                        href="{{ route('productDetail', ['id' => $product->id]) }}">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                    <form action="{{ route('compare.add', $product->id) }}" method="POST"
                                        class="addToCompareForm">
                                        @csrf
                                        <button type="button" class="addToCompareBtn rounded-icon border-0">
                                            <i class="fa-solid fa-code-compare"></i>
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="text-center" style="margin-top: 2rem">
                <a href="{{ route('products') }}">
                    <button type="button" class="btn btn-success und">Xem thêm</button>
                </a>
            </div>
        </div>
    </div>
    <!-- BEST SELLER PART END -->

    <!-- ABOUT US PART START -->
    <div class="full-about" id="full-about">
        <div class="container">
            <div class="row">
                {{--                <div class="about-title"> --}}
                {{--                    <h2>About us</h2> --}}
                {{--                </div> --}}
                <div class="col-md-6">
                    <div class="about-content">
                        <h3>Chúng tôi tự hào cung cấp dịch vụ từ năm 2022.</h3>
                        <div class="about-details">
                            <p>The readable content off a page when looking layout using Lorem Ipsum is that it has.</p>
                            <p>It is a long established fact that a reader will be distracted the readable content off a
                                page when looking at its layout using Lorem Ipsum is that it has.</p>
                        </div>

                        <div class="about-icon-text align-items-center">
                            <div class="abt-icon">
                                <i class="fa-solid fa-leaf"></i>
                            </div>
                            <div class="abt-text">
                                <h2>Sản phẩm <span>tươi ngon 100%</span> từ trang trại hữu cơ..</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ABOUT US PART END -->

    <!-- PARTNERS PART START -->
    <div class="full-partners">
        <div class="container">
            <div class="row partner-slider">
                <div class="col-md-12">
                    <div class="partner-img text-center">
                        <img class="w-50 mx-auto"
                            src="https://admin.ems.com.vn/filemedia/company/EMS_LOGO1.1721463252.png" alt="">
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="partner-img text-center">
                        <img class="w-50 mx-auto"
                            src="https://www.tiendauroi.com/wp-content/uploads/2020/02/Grab-express.png"
                            alt="">
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="partner-img text-center">
                        <img class="w-50 mx-auto"
                            src="https://cdn.haitrieu.com/wp-content/uploads/2022/05/Logo-JT-Express-Slogan.png"
                            alt="">
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="partner-img text-center">
                        <img class="w-50 mx-auto"
                            src="https://home.ahamove.com/wp-content/uploads/2022/02/logo-moi-2022-02-e1644389788464.png"
                            alt="">
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="partner-img text-center">
                        <img class="w-50 mx-auto"
                            src="https://cdn.haitrieu.com/wp-content/uploads/2022/05/Logo-Viettel-Post-Transparent.png"
                            alt="">
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="partner-img text-center">
                        <img class="w-50 mx-auto"
                            src="https://cdn.haitrieu.com/wp-content/uploads/2022/05/Logo-GHN-Slogan-En.png"
                            alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- PARTNERS PART END -->

    <!-- OFFER PART START -->
    <div class="full-offer">
        <div class="bg-1"></div>
        <div class="bg-2"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="offer-content">
                        <h3>Nhu Yếu Phẩm Hàng Ngày</h3>
                        <h2>Giảm Giá (SALE) <br>Sản Phẩm Trái Cây</h2>
                        <a href="#" class="btn">Khám Phá Thêm <i class="icofont-bubble-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- OFFER PART END -->

    <!-- TESTIMONIAL PART START -->
    <div class="container mt-5">
        <div class="section-template">
		<div class="section-banner">
			<a href="#" class="section-order">
				ORDER NOW
			</a>
		</div>
		<div class="section-content">
			<h3 class="section-content-title">O'Food/Want to send </h3>
			<span class="section-content-text">Organicfood.vn chuỗi cửa hàng thực phẩm hữu cơ với mục tiêu giúp người tiêu dùng Việt Nam có một cuộc sống khỏe mạnh hơn thông qua những loại thực phẩm hữu cơ có chứng nhận, thực phẩm tự nhiên và không có nguồn gốc biến đổi gene (GMO).
				 Chúng tôi lựa chọn các loại thực phẩm hữu cơ, thực phẩm tự nhiên từ các nhà sản xuất, các công ty trong và ngoài nước thông qua quá trình lựa chọn kỹ càng về khả năng cung ứng, các giấy chứng nhận tiêu chuẩn do các tổ chức uy tín thế giới cấp.
			</span>
			<button id="section-button" type="button" class="btn btn-primary">XEM THÊM ...</button>
		</div>
	 </div>
    </div>
    <!-- TESTIMONIAL PART END -->

    <!-- CONTACT NOW PART END -->
    <div class="contact-now">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h3 class="contact-quote">Nếu Bạn Cần Trái Cây Hữu Cơ Tự Nhiên Và Tươi!</h3>
                    <a href="#" class="btn">Liên Hệ Ngay <i class="icofont-bubble-right"></i></a>
                </div>
            </div>
        </div>
    </div>
    <!-- CONTACT NOW PART END -->

    {{-- <div class="full-latest-news">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h3 class="section-title">Latest News</h3>
                    <p class="section-subtitle">The passage experienced a surge in popularity during the 1960s when
                        again during the 90s as desktop publishers</p>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-md-6">
                    <div class="latest-news-grid">
                        <div class="news-img">
                            <img class="w-100" src="uploads/news1.jpg" alt="">
                        </div>

                        <div class="news-content">
                            <div class="date-react">
                                <span class="date">16 January’20</span>
                                <span class="react"><i class="icofont-ui-love"></i> 56</span>
                                <span class="react"><i class="icofont-speech-comments"></i> 98</span>
                            </div>
                            <div class="news-title">
                                <a href="blogdetails.html">
                                    <h4>The passage experienced a popularity during the used it on their dry-transfer
                                        sheets.</h4>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="latest-news-list d-flex">
                        <div class="news-img">
                            <img class="w-100" src="uploads/news2.jpg" alt="">
                        </div>

                        <div class="news-content">
                            <div class="date-react">
                                <span class="date">16 January’20</span>
                                <span class="react"><i class="icofont-ui-love"></i> 56</span>
                                <span class="react"><i class="icofont-speech-comments"></i> 98</span>
                            </div>
                            <div class="news-title">
                                <a href="blogdetails.html">
                                    <h4>The passage popularity dry transfer sheets.</h4>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="latest-news-list d-flex">
                        <div class="news-img">
                            <img class="w-100" src="uploads/news3.jpg" alt="">
                        </div>

                        <div class="news-content">
                            <div class="date-react">
                                <span class="date">16 January’20</span>
                                <span class="react"><i class="icofont-ui-love"></i> 56</span>
                                <span class="react"><i class="icofont-speech-comments"></i> 98</span>
                            </div>
                            <div class="news-title">
                                <a href="blogdetails.html">
                                    <h4>The passage popularity dry transfer sheets.</h4>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div> --}}

    <script src="{{ asset('js/cart/add.js') }}"></script>
    <script src="{{ asset('js/product/compare.js') }}"></script>

    <script>
        function calculateTDEE() {
            const age = document.getElementById('age').value;
            const gender = document.getElementById('gender').value;
            const height = document.getElementById('height').value;
            const weight = document.getElementById('weight').value;
            const activity = document.getElementById('activity').value;
            const goal = document.getElementById('goal').value;

            let bmr;
            if (gender === 'male') {
                bmr = 66 + (13.7 * weight) + (5 * height) - (6.8 * age);
            } else {
                bmr = 655 + (9.6 * weight) + (1.8 * height) - (4.7 * age);
            }

            const tdee = bmr * activity;

            let goalCalories;
            if (goal === 'lose') {
                goalCalories = tdee - 400;
            } else if (goal === 'gain') {
                goalCalories = tdee + 400;
            } else {
                goalCalories = tdee;
            }

            document.getElementById('tdeeResult').innerText = `Chỉ số TDEE của bạn là: ${tdee.toFixed(0)} calo một ngày`;
            document.getElementById('bmrResult').innerText = `Chỉ số BMR của bạn là: ${bmr.toFixed(0)} calo cần nạp một ngày`;
            document.getElementById('goalResult').innerText = `Lượng calo cần thiết để bạn ${goal === 'lose' ? 'giảm cân' : goal === 'gain' ? 'tăng cân' : 'duy trì cân nặng'} là: ${goalCalories.toFixed(2)} calo một ngày`;

            document.getElementById('result').classList.remove('d-none');
        }
    </script>
    <style>
        .card {
            border-radius: 15px;
            border: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .card-body {
            padding: 2rem;
        }
        .card-title {
            color: #097770;
            font-weight: 700;
        }
        .form-control {
            border-radius: 10px;
        }
        .btn-primary {
            background-color: #097770;
            border: none;
            border-radius: 10px;
            padding: 0.75rem;
            font-weight: 600;
        }
        .btn-primary:hover {
            background-color: #065d55;
        }
        .bg-light-custom {
            background-color: #e9f5f5;
        }
        .text-success {
            color: #28a745;
        }
        .result-box {
            background-color: #e9f5f5;
            border: 1px solid #d1e7dd;
            border-radius: 10px;
            padding: 1rem;
        }
        .result-box h4 {
            color: #097770;
            font-weight: 700;
        }
    </style>
</x-app-layout>
