@extends('admin.index')
@section('title', '- Thêm người dùng')
@section('content')
    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header font-weight-bold">
                Thêm người dùng
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('add.user') }}">
                    @csrf

                    <!-- Name -->
                    <div>
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Email Address -->
                    <div class="mt-4">
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="mt-4">
                        <x-input-label for="password" :value="__('Password')" />

                        <x-text-input id="password" class="block mt-1 w-full"
                                      type="password"
                                      name="password"
                                      autocomplete="new-password" />

                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Confirm Password -->
                    <div class="mt-4">
                        <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                        <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                      type="password"
                                      name="password_confirmation" autocomplete="new-password" />

                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="role" :value="__('Role')" />
                        <x-select name="role">
                            <option value="CUSTOMER" selected>CUSTOMER</option>
                            <option value="ADMIN">ADMIN</option>
                        </x-select>
                    </div>

                    <div class="flex items-center justify-center flex-col mt-4 space-y-2">
                        <x-primary-button class="ms-4">
                            Thêm mới
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
