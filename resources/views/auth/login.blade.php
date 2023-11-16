<x-app-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="w-full h-full">
        <div class="w-full bg-no-repeat -my-6 bg-center bg-[url('https://food-03.web4s.vn/uploads/plugin/custom_img/2018-09-10/1536547650-699688875-custom.jpg')]">
            <div class="max-w-6xl mx-auto py-36 text-white text-xl text-center font-semibold">
                <span class=""><a href="" class="">TRANG CHỦ / </a></span>
                <span class="text-yellow-500">ĐĂNG NHẬP</span>
            </div>
        </div>
        <div class="w-full bg-white">
            <div class="max-w-xl mx-auto py-8">
                <div class="bg-white py-8">
                    <h2 class="text-black w-full h-full text-lg font-semibold border-b border-gray-300 py-3 my-3">ĐĂNG NHẬP</h2>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- Email Address -->
                        <div>
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Password -->
                        <div class="mt-4">
                            <x-input-label for="password" :value="__('Password')" />

                            <x-text-input id="password" class="block mt-1 w-full"
                                          type="password"
                                          name="password"
                                          required autocomplete="current-password" />

                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <!-- Remember Me -->
                        <div class="block mt-4">
                            <label for="remember_me" class="inline-flex items-center">
                                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 text-indigo-600 shadow-sm outline-none" name="remember">
                                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                            </label>
                        </div>

                        <div class="flex items-center justify-center flex-col mt-4 space-y-2">
                            <x-primary-button class="ms-3">
                                {{ __('Log in') }}
                            </x-primary-button>

                            @if (Route::has('password.request'))
                                <a class="ml-3 underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100" href="{{ route('password.request') }}">
                                    {{ __('Forgot your password?') }}
                                </a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

