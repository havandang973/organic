<x-app-layout>

<!-- HERO SECTION PART START -->
<div class="hero_section">
    {{-- <div class="png_img"><img class="w-100 img-fluid" src="{{asset('uploads/banner_poster.jpg')}}" alt="" /></div> --}}
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="herosection_content">
                    <h2 style="color: #fff">Chi tiết sản phẩm</h2>
                    <a href="/" class="btn border-radius-0 border-transparent">Trang chủ</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- HERO SECTION PART END-->

<!-- PRODUCT DETAILS PART START -->
<div class="product_details">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                <div class="product_img d-flex">
                    <div class="big_img">
                        @if($product->max_amount === 0)
                            <span class="sold-out-tag position-top-right">Hết hàng</span>
                        @elseif($product->discount != 0)
                            <span class="sold-out-tag position-top-right">-{{$product->discount}}%</span>
                        @endif
                        <img src="{{asset($product->thumbnail)}}" class="w-75 img-fluid" alt="" />
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                <div class="producudetails_content">
                    <h3>{{$product->name}}</h3>
                    <div class="customer_review">
                        <ul>
                            <li>
                                <i class="fa-regular fa-star"></i>
                                <i class="fa-regular fa-star"></i>
                                <i class="fa-regular fa-star"></i>
                                <i class="fa-regular fa-star"></i>
                                <i class="fa-regular fa-star"></i>
                            </li>
                            <li>
                                <span class="text-dark"><i>(Còn {{$product->max_amount}} sản phẩm)</i></span>
                            </li>
                        </ul>
                    </div>
                    <strong>{{number_format($product->price - (($product->price * $product->discount)/100))}} ₫</strong>
                    @if ($product->discount != 0)
                        <strong><del>{{number_format($product->price)}} ₫</del></strong>
                    @endif
                    <div>
                        <span>Thương hiệu: <b>{{$product->brand->brand}}</b></span><br>
                        <span>Màu sắc: <b>{{$product->color}}</b></span><br>
                        <span>Xuất xứ: <b>{{$product->origin}}</b></span>
                    </div>
                    <div class="add_to_cart d-flex">
                        @if($product->max_amount != 0)
                            <form action="{{route('add', $product->id)}}" method="POST" class="addToCartForm">
                                @csrf
                                <input type="number" name="amount" value="1" class="p-2 text-center font-weight-bolder" style="outline: none;" placeholder="1" required min="1" max="{{ $product->max_amount }}">
                                <input type="hidden" name="product_id" value="{{$product->id}}">
                                <button type="button" class="addToCartBtn btn border-transparent ml-5">
                                    Thêm giỏ hàng
                                </button>
                                <p id="error-amount" class="text-danger"></p>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- PRODUCT DETAILS PART END -->

<!-- PRODUCT TABBER START -->
<div class="product_tabber">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ul class="nav nav-tabs nav_custom" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link nav-link-custom active" id="description-tab" data-toggle="tab" href="#description" role="tab" aria-controls="description" aria-selected="true">Mô tả</a>
                    </li>
                </ul>

                <div class="tab-content" id="myTabContent">
                    {!!$product->describe!!}
                </div>
            </div>
        </div>
    </div>
</div>
<!-- PRODUCT TABBER END -->


<!-- BEST SELLER PART START -->
<div class="full-bestSeller">
    <div class="container">
        <div class="row">
            <div class="col-12 text-left">
                <h3 class="section-title">Sản phẩm khác</h3>
            </div>
        </div>

        <div class="row mt-5 product-slider">
            @foreach($products as $product)
                <div class="col-xs-12 col-md-12 col-lg-12 col-xl-12 mb-12">
                    <div class="product">
                        <div class="product-img">
                            <img class="w-100" src="{{ asset($product->thumbnail) }}" alt="">
                        </div>
                        <div class="product-content">
                            <div class="product-details position-bottom-left">
                                <h3 class="product-name"><a href="productdetails.html">{{$product->name}}</a></h3>
                                <span class="product-price">{{number_format($product->price - (($product->price * $product->discount)/100))}} ₫</span>
                                @if ($product->discount != 0)
                                    <span class="product-prev-price">{{ number_format($product->price) }} ₫</span>
                                @endif
                            </div>
                            <div class="buttons">
                                @if($product->max_amount === 0)
                                    <span class="sold-out-tag position-top-right">Hết hàng</span>
                                @elseif($product->discount != 0)
                                    <span class="sold-out-tag position-top-right">-{{$product->discount}}%</span>
                                @endif
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
                                <form action="{{ route('add', $product->id) }}" method="POST"
                                    class="addToCartForm">
                                    @csrf
                                    <button type="button"
                                        class="addToCartBtn rounded-icon border-0">
                                        <i class="fa-solid fa-cart-shopping" style="color: #5cb917;"></i>
                                        <input type="hidden" name="amount" value="1">
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
<!-- BEST SELLER PART END -->
<script src="{{ asset('js/cart/add.js') }}"></script>
<script src="{{ asset('js/product/compare.js') }}"></script>

</x-app-layout>


<script>

    $(".product-slider").slick({
        // normal options...
        infinite: false,
        slidesToShow: 4,
        slidesToScroll: 2,
        autoplay: true,
        autoplaySpeed: 2000,
        infinite: true,
        arrows:true,

        // the magic
        responsive: [{
            breakpoint: 1500,
            settings: {
                slidesToShow: 4,
                infinite: true
            }

        }, {

            breakpoint: 1201,
            settings: {
                slidesToShow: 2,
                dots: true
            }

        }, {

            breakpoint: 992,
            settings: {
                slidesToShow: 2,
                dots: true
            }

        }, {

            breakpoint: 600,
            settings: {
                slidesToShow: 1,
                dots: true
            }

        }, {

            breakpoint: 300,
            settings: {
                slidesToShow: 1,
                dots: true
            },

        }]
    });

</script>
