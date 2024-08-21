<x-app-layout>
    <div class="container" style="margin-top: 8.5rem">
        <h2 class="text-center mb-4">So Sánh Sản Phẩm</h2>
        <div class="mb-4">
            <form method="GET" action="/compare">
                <div class="row mb-3">
                    <div class="col-md-3 mb-2" style="display: grid; place-items: center;">
                        <select name="sort_price" class="form-select" aria-label="Sắp xếp giá" style="height: fit-content; padding: 10px 20px">
                            <option value="">Sắp xếp theo giá</option>
                            <option value="asc" {{ request('sort_price') == 'asc' ? 'selected' : '' }}>Giá tăng dần</option>
                            <option value="desc" {{ request('sort_price') == 'desc' ? 'selected' : '' }}>Giá giảm dần</option>
                        </select>
                    </div>                                      
                    <div class="col-md-3 mb-2">
                        <label for="min_price">Giá từ</label>
                        <input type="number" name="min_price" class="form-control" placeholder="Giá tối thiểu" value="{{ request('min_price') }}">
                        <small class="form-text text-muted">Nhập giá thấp nhất bạn muốn tìm kiếm.</small>
                    </div>
                    <div class="col-md-3 mb-2">
                        <label for="max_price">Giá đến</label>
                        <input type="number" name="max_price" class="form-control" placeholder="Giá tối đa" value="{{ request('max_price') }}">
                        <small class="form-text text-muted">Nhập giá cao nhất bạn muốn tìm kiếm.</small>
                    </div>
                    <div class="col-md-3 mb-2 d-flex align-items-center justify-content-center">
                        <button class="btn btn-primary btn-sm rounded-0 text-white" type="submit">Lọc</button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Bảng hiển thị cho màn hình lớn -->
        <div class="d-none d-md-block">
            <table class="table table-bordered">
                <thead>
                <tr class="text-center">
                    <th>Sản Phẩm</th>
                    <th>Hình Ảnh</th>
                    <th>Giá</th>
                    <th>Mô Tả</th>
                    <th>Thêm vào giỏ hàng</th>
                    <th>Xóa</th>
                </tr>
                </thead>
                <tbody>
                @if($products->isEmpty())
                    <tr>
                        <td colspan="6" class="text-center">Chưa có sản phẩm.</td>
                    </tr>
                @endif
                @foreach($products as $product)
                    <tr class="text-center item-compare">
                        <td><b>{{ $product->name }}</b></td>
                        <td><img src="{{ asset($product->thumbnail) }}" alt="{{ $product->name }}" class="img-fluid" width="100"></td>
                        <td><b>{{ number_format($product->price) }} VND</b></td>
                        <td>
                            <div>
                                <span>Màu sắc: <b>{{$product->color}}</b></span><br>
                                <span>Xuất xứ: <b>{{$product->origin}}</b></span>
                            </div>
                        </td>
                        <td style="text-align: center">
                            <form action="{{route('add', $product->id)}}" method="POST" class="addToCartForm">
                                @csrf
                                <button type="button" class="addToCartBtn btn custom-btn">
                                    <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="24" height="24" x="0" y="0" viewBox="0 0 511.728 511.728" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><path d="M147.925 379.116c-22.357-1.142-21.936-32.588-.001-33.68 62.135.216 226.021.058 290.132.103 17.535 0 32.537-11.933 36.481-29.017l36.404-157.641c2.085-9.026-.019-18.368-5.771-25.629s-14.363-11.484-23.626-11.484c-25.791 0-244.716-.991-356.849-1.438L106.92 54.377c-4.267-15.761-18.65-26.768-34.978-26.768H15c-8.284 0-15 6.716-15 15s6.716 15 15 15h56.942a6.246 6.246 0 0 1 6.017 4.592l68.265 253.276c-12.003.436-23.183 5.318-31.661 13.92-8.908 9.04-13.692 21.006-13.471 33.695.442 25.377 21.451 46.023 46.833 46.023h21.872a52.18 52.18 0 0 0-5.076 22.501c0 28.95 23.552 52.502 52.502 52.502s52.502-23.552 52.502-52.502a52.177 52.177 0 0 0-5.077-22.501h94.716a52.185 52.185 0 0 0-5.073 22.493c0 28.95 23.553 52.502 52.502 52.502 28.95 0 52.503-23.553 52.503-52.502a52.174 52.174 0 0 0-5.464-23.285c5.936-1.999 10.216-7.598 10.216-14.207 0-8.284-6.716-15-15-15zm91.799 52.501c0 12.408-10.094 22.502-22.502 22.502s-22.502-10.094-22.502-22.502c0-12.401 10.084-22.491 22.483-22.501h.038c12.399.01 22.483 10.1 22.483 22.501zm167.07 22.494c-12.407 0-22.502-10.095-22.502-22.502 0-12.285 9.898-22.296 22.137-22.493h.731c12.24.197 22.138 10.208 22.138 22.493-.001 12.407-10.096 22.502-22.504 22.502zm74.86-302.233c.089.112.076.165.057.251l-15.339 66.425H414.43l8.845-67.023 58.149.234c.089.002.142.002.23.113zm-154.645 163.66v-66.984h53.202l-8.84 66.984zm-74.382 0-8.912-66.984h53.294v66.984zm-69.053 0h-.047c-3.656-.001-6.877-2.467-7.828-5.98l-16.442-61.004h54.193l8.912 66.984zm56.149-96.983-9.021-67.799 66.306.267v67.532zm87.286 0v-67.411l66.022.266-8.861 67.145zm-126.588-67.922 9.037 67.921h-58.287l-18.38-68.194zm237.635 164.905H401.63l8.84-66.984h48.973l-14.137 61.217a7.406 7.406 0 0 1-7.25 5.767z" fill="#ffffff" opacity="1" data-original="#000000" class=""></path></g></svg>
                                    <input type="hidden" name="amount" value="1">
                                    <input type="hidden" name="product_id" value="{{$product->id}}">
                                </button>
                            </form>
                        </td>
                        <td style="cursor: pointer;">
                            <form action="{{ route('compare.delete', $product->id) }}" method="POST" class="formDeleteCompare d-inline">
                                @csrf
                                <button type="button" class="removeCompare text-danger" style="border: none; background: none; padding: 0;">
                                    <i class="fa-solid fa-trash" style="font-size: 20px"></i>
                                    <input type="hidden" name="product_id" value="{{$product->id}}">
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <!-- Danh sách hiển thị cho màn hình nhỏ -->
        <div class="d-md-none">
            @if($products->isEmpty())
                <p class="text-center">Chưa có sản phẩm.</p>
            @endif
            @foreach($products as $product)
                <div class="card mb-3">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="{{ asset($product->thumbnail) }}" class="img-fluid rounded-start" alt="{{ $product->name }}">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <p class="card-text"><strong>{{ number_format($product->price) }} VND</strong></p>
                                <p class="card-text">Màu sắc: <b>{{$product->color}}</b></p>
                                <p class="card-text">Xuất xứ: <b>{{$product->origin}}</b></p>
                                <div class="d-flex justify-content-between">
                                    <form action="{{route('add', $product->id)}}" method="POST" class="addToCartForm">
                                        @csrf
                                        <button type="button" class="addToCartBtn btn custom-btn">
                                            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="24" height="24" x="0" y="0" viewBox="0 0 511.728 511.728" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><path d="M147.925 379.116c-22.357-1.142-21.936-32.588-.001-33.68 62.135.216 226.021.058 290.132.103 17.535 0 32.537-11.933 36.481-29.017l36.404-157.641c2.085-9.026-.019-18.368-5.771-25.629s-14.363-11.484-23.626-11.484c-25.791 0-244.716-.991-356.849-1.438L106.92 54.377c-4.267-15.761-18.65-26.768-34.978-26.768H15c-8.284 0-15 6.716-15 15s6.716 15 15 15h56.942a6.246 6.246 0 0 1 6.017 4.592l68.265 253.276c-12.003.436-23.183 5.318-31.661 13.92-8.908 9.04-13.692 21.006-13.471 33.695.442 25.377 21.451 46.023 46.833 46.023h21.872a52.18 52.18 0 0 0-5.076 22.501c0 28.95 23.552 52.502 52.502 52.502s52.502-23.552 52.502-52.502a52.177 52.177 0 0 0-5.077-22.501h94.716a52.185 52.185 0 0 0-5.073 22.493c0 28.95 23.553 52.502 52.502 52.502 28.95 0 52.503-23.553 52.503-52.502a52.174 52.174 0 0 0-5.464-23.285c5.936-1.999 10.216-7.598 10.216-14.207 0-8.284-6.716-15-15-15zm91.799 52.501c0 12.408-10.094 22.502-22.502 22.502s-22.502-10.094-22.502-22.502c0-12.401 10.084-22.491 22.483-22.501h.038c12.399.01 22.483 10.1 22.483 22.501zm167.07 22.494c-12.407 0-22.502-10.095-22.502-22.502 0-12.285 9.898-22.296 22.137-22.493h.731c12.24.197 22.138 10.208 22.138 22.493-.001 12.407-10.096 22.502-22.504 22.502zm74.86-302.233c.089.112.076.165.057.251l-15.339 66.425H414.43l8.845-67.023 58.149.234c.089.002.142.002.23.113zm-154.645 163.66v-66.984h53.202l-8.84 66.984zm-74.382 0-8.912-66.984h53.294v66.984zm-69.053 0h-.047c-3.656-.001-6.877-2.467-7.828-5.98l-16.442-61.004h54.193l8.912 66.984zm56.149-96.983-9.021-67.799 66.306.267v67.532zm87.286 0v-67.411l66.022.266-8.861 67.145zm-126.588-67.922 9.037 67.921h-58.287l-18.38-68.194zm237.635 164.905H401.63l8.84-66.984h48.973l-14.137 61.217a7.406 7.406 0 0 1-7.25 5.767z" fill="#ffffff" opacity="1" data-original="#000000" class=""></path></g></svg>
                                            <input type="hidden" name="amount" value="1">
                                            <input type="hidden" name="product_id" value="{{$product->id}}">
                                        </button>
                                    </form>
                                    <form action="{{ route('compare.delete', $product->id) }}" method="POST" class="formDeleteCompare d-inline">
                                        @csrf
                                        <button type="button" class="removeCompare text-danger" style="border: none; background: none; padding: 0;">
                                            <i class="fa-solid fa-trash" style="font-size: 20px"></i>
                                            <input type="hidden" name="product_id" value="{{$product->id}}">
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script src="{{ asset('js/cart/add.js') }}"></script>
    <script src="{{ asset('js/product/compare.js') }}"></script>
</x-app-layout>
