<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

{{--        <title>{{ config('app.name', 'Organic') }}</title>--}}
        <title>Organic @yield('title')</title>

        <!-- Fonts -->
        <link rel="icon" type="image/x-icon" href="{{asset('uploads/i-n-may-logo-home2-x11409.png')}}">
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <script src="https://cdn.tailwindcss.com/3.4.3"></script>
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
    <div id="notification" class="notification hidden">
        <div class="flex justify-center items-center">
            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="40" height="40" x="0" y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><path fill="#4bae4f" fill-rule="evenodd" d="M256 0C114.8 0 0 114.8 0 256s114.8 256 256 256 256-114.8 256-256S397.2 0 256 0z" clip-rule="evenodd" opacity="1" data-original="#4bae4f" class=""></path><path fill="#ffffff" d="M206.7 373.1c-32.7-32.7-65.2-65.7-98-98.4-3.6-3.6-3.6-9.6 0-13.2l37.7-37.7c3.6-3.6 9.6-3.6 13.2 0l53.9 53.9L352.1 139c3.7-3.6 9.6-3.6 13.3 0l37.8 37.8c3.7 3.7 3.7 9.6 0 13.2L219.9 373.1c-3.6 3.7-9.5 3.7-13.2 0z" opacity="1" data-original="#ffffff"></path></g></svg>
            <span id="notification-message"></span>
        </div>
    </div>
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
{{--            @include('layouts.navigation')--}}
            @include('layouts.header')


            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>

            @include('layouts.footer')
        </div>
    </body>
</html>

<style>
    .hidden {
        display: none;
    }

    .notification {
        position: fixed;
        top: 10px;
        right: 10px;
        background-color: #4caf50; /* Màu nền */
        color: white; /* Màu chữ */
        padding: 10px 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        z-index: 1000;
        transition: opacity 0.5s ease;
        opacity: 0;
        display: flex;
        align-items: center;
    }

    .notification i {
        margin-right: 10px;
    }

    .notification.show {
        display: block;
        opacity: 1;
    }

</style>
<script>
    function showNotification(message) {
        var notification = document.getElementById('notification');
        var notificationMessage = document.getElementById('notification-message');
        notificationMessage.innerText = message;
        notification.classList.add('show');

        setTimeout(function() {
            notification.classList.remove('show');
        }, 3000);
    }
</script>
