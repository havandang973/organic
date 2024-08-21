<section>
    <header>
        <h2 class="h4 mb-2 text-dark">
            {{ __('Cập nhật mật khẩu') }}
        </h2>

        <p class="mb-3 text-muted">
            {{ __('Hãy đảm bảo tài khoản của bạn sử dụng một mật khẩu dài và ngẫu nhiên để bảo mật.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-4">
        @csrf
        @method('put')

        <div class="mb-3">
            <x-input-label for="current_password" :value="__('Mật khẩu hiện tại')" />
            <x-text-input id="current_password" name="current_password" type="password" class="mt-1 block w-full form-control" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2 text-danger" />
        </div>

        <div class="mb-3">
            <x-input-label for="password" :value="__('Mật khẩu mới')" />
            <x-text-input id="password" name="password" type="password" class="mt-1 block w-full form-control" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2 text-danger" />
        </div>

        <div class="mb-3">
            <x-input-label for="password_confirmation" :value="__('Xác nhận mật khẩu')" />
            <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full form-control" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2 text-danger" />
        </div>

        <div class="d-flex justify-content-between align-items-center">
            <x-primary-button class="btn btn-primary">{{ __('Lưu') }}</x-primary-button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-success mb-0"
                >{{ __('Đã lưu.') }}</p>
            @endif
        </div>
    </form>
</section>
