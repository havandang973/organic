<x-app-layout>
    <div class="container-fluid p-0" style="margin-top: 10.5rem">
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header bg-white border-bottom-0">
                            <h2 class="text-dark text-center">ĐĂNG KÝ</h2>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('register') }}">
                                @csrf

                                <!-- Name -->
                                <div class="form-group">
                                    <label for="name">{{ __('Họ tên') }}</label>
                                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus autocomplete="name">
                                    @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Email Address -->
                                <div class="form-group mt-3">
                                    <label for="email">{{ __('Email') }}</label>
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autocomplete="username">
                                    @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Password -->
                                <div class="form-group mt-3">
                                    <label for="password">{{ __('Mật khẩu') }}</label>
                                    <input id="password" type="password" class="form-control" name="password" required autocomplete="new-password">
                                    @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Confirm Password -->
                                <div class="form-group mt-3">
                                    <label for="password_confirmation">{{ __('Xác nhận mật khẩu') }}</label>
                                    <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                    @error('password_confirmation')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="d-flex flex-column align-items-center mt-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Đăng kí') }}
                                    </button>

                                    <a class="btn btn-link mt-2" href="{{ route('login') }}">
                                        {{ __('Đã có tài khoản?') }}
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
