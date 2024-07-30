<x-app-layout>
    <div class="container-fluid h-100" style="margin-top: 9.5rem">
        <div class="bg-light py-4">
            <div class="container py-4">
                <div class="bg-white p-4">
                    <div class="d-flex justify-content-between">
                        <div id="btn_address" class="text-center w-100 py-3 text-primary font-weight-bold cursor-pointer">ĐỊA CHỈ GIAO HÀNG</div>
                        {{-- <div id="btn_login" class="bg-secondary text-white w-100 text-center py-3 cursor-pointer">ĐĂNG NHẬP</div> --}}
                    </div>
                    <div id="address" class="px-3">
                        <div class="row">
                            @foreach($addresses as $address)
                                <div class="col-md-4 mb-4">
                                    <div class="card">
                                        <div class="card-body position-relative">
                                            <a href="{{route('delete.address', $address->id)}}" class="position-absolute top-0 end-0 m-2 text-muted text-danger-hover"><i class="fas fa-times"></i></a>
                                            <p class="card-text"><i class="far fa-user"></i> {{$address->name}}</p>
                                            <p class="card-text"><i class="fas fa-map-marker-alt"></i> {{$address->address}}</p>
                                            <p class="card-text"><i class="fas fa-phone"></i> {{$address->telephone}}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <form action="/address" method="POST" class="mt-4">
                            @csrf
                            <div class="form-group">
                                <input value="{{ old('name') }}" name="name" type="text" class="form-control" placeholder="Tên">
                                @if ($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <input value="{{ old('address') }}" name="address" type="text" class="form-control" placeholder="Địa chỉ">
                                @if ($errors->has('address'))
                                    <span class="text-danger">{{ $errors->first('address') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <input value="{{ old('telephone') }}" name="telephone" type="text" class="form-control" placeholder="Số điện thoại">
                                @if ($errors->has('telephone'))
                                    <span class="text-danger">{{ $errors->first('telephone') }}</span>
                                @endif
                            </div>
                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Lưu</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .text-danger-hover:hover {
            color: red !important; /* Bootstrap's danger color */
        }
    </style>

    <script src="{{ asset('js/cart/add.js') }}"></script>
    <script src="{{ asset('js/cart/update.js') }}"></script>
    <script src="{{ asset('js/cart/delete.js') }}"></script>
</x-app-layout>
