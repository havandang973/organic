<header id="full_nav">
    <div class="header">
        {{-- <div class="container"> --}}
            <nav class="navbar navbar-expand-lg navbar-light">
                <a class="navbar-brand" href="/">
                    <img src="{{asset('uploads/logo.png')}}" alt="" class="logo-img">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa-solid fa-bars" style="color: #ffffff;"></i>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent" style="justify-content: space-evenly">
                    <ul class="navbar-nav" style="width: 50%; justify-content: space-evenly">
                        <li class="nav-item active">
                            <a class="nav-link" href="/">Trang chủ</a>
                        </li>
                        {{-- id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" --}}
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="/products">
                                Sản phẩm
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                @foreach ($categories as $category)
                                    <a class="dropdown-item" href="{{ url('/products?category='.$category->id) }}">{{ $category->category }}</a>
                                @endforeach
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/tdee-calculator">Tính TDEE</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/news">Tin tức</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/introduce">Giới thiệu</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/feedback">Đánh giá</a>
                        </li>
                    </ul>
                    
                    <div class="header-content">
                        <form action="{{ url('/search') }}" method="GET" class="search-form mr-4">
                            <div class="search">
                                <input type="text" class="searchTerm" name="query" placeholder="Tìm kiếm sản phẩm...">
                                <button type="submit" class="searchButton">
                                  <i class="fa fa-search"></i>
                               </button>
                             </div>
                        </form>
                        <div class="header_contact text-right">
                            <span>Liên hệ!</span>
                            <span class="phone_no">0348 478 579</span>
                        </div>
                        <div class="header_icon" style="display: flex; justify-content: center; align-items: center">
                            <a href="/compare" style="width: 100%">
                                <i class="fa-solid fa-code-compare" style="color: #ffffff; font-size: 18px"></i>
                                <span id="amountCompare" class="cart_no" style="font-size: 13px; font-weight: 500; padding: 11px; display: flex; justify-content: center; align-items: center">
                                    <span>{{$amount}}</span>
                                </span>
                            </a>
                        </div>
                        <div class="header_icon" style="display: flex; justify-content: center; align-items: center; margin-left: 10px">
                            <a href="/cart" style="width: 100%">
                                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="24" height="24" x="0" y="0" viewBox="0 0 511.728 511.728" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><path d="M147.925 379.116c-22.357-1.142-21.936-32.588-.001-33.68 62.135.216 226.021.058 290.132.103 17.535 0 32.537-11.933 36.481-29.017l36.404-157.641c2.085-9.026-.019-18.368-5.771-25.629s-14.363-11.484-23.626-11.484c-25.791 0-244.716-.991-356.849-1.438L106.92 54.377c-4.267-15.761-18.65-26.768-34.978-26.768H15c-8.284 0-15 6.716-15 15s6.716 15 15 15h56.942a6.246 6.246 0 0 1 6.017 4.592l68.265 253.276c-12.003.436-23.183 5.318-31.661 13.92-8.908 9.04-13.692 21.006-13.471 33.695.442 25.377 21.451 46.023 46.833 46.023h21.872a52.18 52.18 0 0 0-5.076 22.501c0 28.95 23.552 52.502 52.502 52.502s52.502-23.552 52.502-52.502a52.177 52.177 0 0 0-5.077-22.501h94.716a52.185 52.185 0 0 0-5.073 22.493c0 28.95 23.553 52.502 52.502 52.502 28.95 0 52.503-23.553 52.503-52.502a52.174 52.174 0 0 0-5.464-23.285c5.936-1.999 10.216-7.598 10.216-14.207 0-8.284-6.716-15-15-15zm91.799 52.501c0 12.408-10.094 22.502-22.502 22.502s-22.502-10.094-22.502-22.502c0-12.401 10.084-22.491 22.483-22.501h.038c12.399.01 22.483 10.1 22.483 22.501zm167.07 22.494c-12.407 0-22.502-10.095-22.502-22.502 0-12.285 9.898-22.296 22.137-22.493h.731c12.24.197 22.138 10.208 22.138 22.493-.001 12.407-10.096 22.502-22.504 22.502zm74.86-302.233c.089.112.076.165.057.251l-15.339 66.425H414.43l8.845-67.023 58.149.234c.089.002.142.002.23.113zm-154.645 163.66v-66.984h53.202l-8.84 66.984zm-74.382 0-8.912-66.984h53.294v66.984zm-69.053 0h-.047c-3.656-.001-6.877-2.467-7.828-5.98l-16.442-61.004h54.193l8.912 66.984zm56.149-96.983-9.021-67.799 66.306.267v67.532zm87.286 0v-67.411l66.022.266-8.861 67.145zm-126.588-67.922 9.037 67.921h-58.287l-18.38-68.194zm237.635 164.905H401.63l8.84-66.984h48.973l-14.137 61.217a7.406 7.406 0 0 1-7.25 5.767z" fill="#ffffff" opacity="1" data-original="#000000" class=""></path></g></svg>
                                <span id="amount" class="cart_no" style="font-size: 13px; font-weight: 500; padding: 11px; display: flex; justify-content: center; align-items: center">
                                    <span>{{{Cart::count()}}}</span>
                                </span>
                            </a>
                        </div>
                    </div>
                    @if(\Illuminate\Support\Facades\Auth::check())
                        <!-- Settings Dropdown -->
                        <div class="dropdown ml-lg-4">
                            <button style="border: none" class="btn dropdown-toggle-custom" type="button" id="settingsDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ Auth::user()->name }}
                                <i class="fa-solid fa-caret-down" style="color: #ffffff;"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-custom" aria-labelledby="settingsDropdown">
                                <a class="dropdown-item dropdown-item-custom" href="{{ route('profile.edit') }}">{{ __('Thông tin cá nhân') }}</a>
                                <a class="dropdown-item dropdown-item-custom" href="{{ route('orders') }}">{{ __('Đơn hàng') }}</a>
                                <a class="dropdown-item dropdown-item-custom" href="{{ route('address') }}">{{ __('Địa chỉ giao hàng') }}</a>

                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a class="dropdown-item dropdown-item-custom" href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                                        {{ __('Đăng xuất') }}
                                    </a>
                                </form>
                            </div>
                        </div>
                    @else
                        @if (Route::has('login'))
                            <div class="d-flex ml-lg-4">
                                <div class="border-right pr-2">
                                    <a href="{{ route('login') }}" class="text-light">Đăng nhập</a>
                                </div>
                                @endif
                                @if (Route::has('register'))
                                    <div class="pl-2">
                                        <a href="{{ route('register') }}" class="text-light">Đăng kí tài khoản</a>
                                    </div>
                            </div>
                        @endif
                    @endif
                </div>
            </nav>
        {{-- </div> --}}
    </div>
</header>

<script src="{{ asset('js/cart/add.js') }}"></script>
<script src="{{ asset('js/cart/update.js') }}"></script>
<script src="{{ asset('js/cart/delete.js') }}"></script>
<script src="{{ asset('js/product/compare.js') }}"></script>
<script>
    document.querySelector('.search-btn').addEventListener('click', <a href="https://nodemy.vn/tim-hieu-ve-ham-trong-javascript-cach-tao-truyen-tham-so-va-su-dung-mot-cach-hieu-qua-don-gian-de-hieu-danh-cho-nguoi-moi-bat-dau-important/">function</a> () {
	<a href="https://nodemy.vn/hieu-arrow-function-va-this-trong-javascript-tao-ra-nhung-ham-manh-me-voi-cu-phap-ngan-gon-huong-dan-day-du-cho-nguoi-moi-bat-dau-important/">this</a>.parentElement.classList.toggle('open')
	this.previousElementSibling.focus()
})
</script>
<style>
    .logo-img {
        width: 100%;
        padding: 8px;
    }

    @media (max-width: 768px) {
        .logo-img {
            width: 70%;
        }
    }
    .dropdown-toggle-custom {
        color: #ffffff; /* Màu chữ nút */
        border-radius: 0.375rem; /* Bo tròn góc */
        padding: 0.5rem 1rem; /* Padding */
        font-size: 1rem; /* Kích thước chữ */
        font-weight: 600; /* Độ đậm chữ */
    }

    .nav-item.dropdown:hover .dropdown-menu {
        display: block;
    }

    .dropdown-menu {
        margin-top: 0;
    }

    .search {
        width: 100%;
        position: relative;
        display: flex;
    }

    .searchTerm {
        width: 100%;
        border: 1px solid #606161;
        border-right: none;
        padding: 10px;
        border-radius: 5px 0 0 5px;
        outline: none;
        color: #9DBFAF;
        background-color: #03262c;
        box-shadow: 0 0 0 4px rgba(3, 38, 44, 0.5); /* Hiệu ứng vòng quanh */

    }
    .searchTerm::placeholder {
        color: #ffffff; /* Màu chữ của placeholder */
    }
    .searchTerm:focus{
        color: white;
    }

    .searchButton {
        width: 40px;
        border: 1px solid #606161;
        background: #03262c;
        padding: 5px;
        text-align: center;
        color: #fff;
        border-radius: 0 5px 5px 0;
        cursor: pointer;
    }

    .searchButton:hover {
        background-color: #138b45;
    }

    .wrap{
        width: 30%;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }
</style>

