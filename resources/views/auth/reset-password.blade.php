<x-app-layout>
    <div class="container-fluid d-flex align-items-center justify-content-center" style="margin-top: 10.5rem;">
        <div class="w-50">
            <form method="POST" action="{{ route('password.store') }}">
                @csrf

                <!-- Password Reset Token -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <!-- Email Address -->
                <div class="form-group">
                    <label for="email">{{ __('Email') }}</label>
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email', $request->email) }}" required autofocus autocomplete="username">
                    <span class="text-danger">@error('email') {{ $message }} @enderror</span>
                </div>

                <!-- Password -->
                <div class="form-group mt-3">
                    <label for="password">{{ __('Password') }}</label>
                    <input id="password" type="password" class="form-control" name="password" required autocomplete="new-password">
                    <span class="text-danger">@error('password') {{ $message }} @enderror</span>
                </div>

                <!-- Confirm Password -->
                <div class="form-group mt-3">
                    <label for="password_confirmation">{{ __('Confirm Password') }}</label>
                    <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    <span class="text-danger">@error('password_confirmation') {{ $message }} @enderror</span>
                </div>

                <div class="form-group mt-4 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Reset Password') }}
                    </button>
                </div>
            </form>
        </div>
    </div>

</x-app-layout>
