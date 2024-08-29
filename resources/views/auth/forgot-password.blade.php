<x-app-layout>
    <div class="w-full h-full" style="margin-top: 10.5rem">
        <div class="w-full bg-white">
            <div class="container py-8">
                <div class="bg-white py-8">
                    <h2 class="text-black w-full h-full text-lg font-semibold border-bottom py-3 my-3">QUÊN MẬT KHẨU</h2>
                    <div class="mb-4 text-muted">
                        {{ __('Quên mật khẩu. Khách hàng hãy nhập email đã đăng ký.') }}
                    </div>

                    <!-- Session Status -->
                    <x-auth-session-status class="mb-4 text-success" :status="session('status')" />

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <!-- Email Address -->
                        <div class="form-group">
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" class="form-control mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                            <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger" />
                        </div>

                        <div class="d-flex justify-content-end mt-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Xác nhận') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
