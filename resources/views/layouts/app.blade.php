<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Welcome | TazZA</title>
    <meta name="description" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- favicon -->
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
    <link rel="icon" href="favicon.ico" type="image/x-icon" />
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@300;400;500;600;700;800&family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Slick slider -->
    <link rel="stylesheet" href="{{asset('css/slick.css')}}" />
    <link rel="stylesheet" href="{{asset('css/slick-theme.css')}}" />
    <!-- bootstrap -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}" />
    <!-- Style css-->
    <link rel="stylesheet" href="{{asset('css/style.css')}}" />
    <!-- Responsive css-->
    <link rel="stylesheet" href="{{asset('css/responsive.css')}}" />
</head>
    <body class="font-sans antialiased">
    <div id="notification" class="notification hidden">
        <div class="flex justify-center items-center">
            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="40" height="40" x="0" y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><path fill="#4bae4f" fill-rule="evenodd" d="M256 0C114.8 0 0 114.8 0 256s114.8 256 256 256 256-114.8 256-256S397.2 0 256 0z" clip-rule="evenodd" opacity="1" data-original="#4bae4f" class=""></path><path fill="#ffffff" d="M206.7 373.1c-32.7-32.7-65.2-65.7-98-98.4-3.6-3.6-3.6-9.6 0-13.2l37.7-37.7c3.6-3.6 9.6-3.6 13.2 0l53.9 53.9L352.1 139c3.7-3.6 9.6-3.6 13.3 0l37.8 37.8c3.7 3.7 3.7 9.6 0 13.2L219.9 373.1c-3.6 3.7-9.5 3.7-13.2 0z" opacity="1" data-original="#ffffff"></path></g></svg>
            <span id="notification-message"></span>
        </div>
    </div>
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
    </body>
</html>

<style>
    .hidden {
        display: none;
    }

    .notification {
        position: fixed;
        top: 80px;
        right: 10px;
        background-color: #4caf50; /* Màu nền */
        color: white; /* Màu chữ */
        padding: 8px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        z-index: 1000;
        transition: opacity 0.3s ease;
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
<!-- jQuery -->
<script src="{{asset('js/jquery-3.2.1.min.js')}}"></script>
<!-- Slick slider -->
<script src="{{asset('js/slick.min.js')}}"></script>
<!-- Bootstrap JS -->
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<!-- scripts -->
<script src="{{asset('js/scripts.js')}}"></script>

<script>
    $(".banner-slider").slick({
        infinite: false,
        autoplay: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplaySpeed: 2000,
        arrows:false,
        dots: true,
    });

    $(".slider").slick({
        infinite: false,
        slidesToShow: 4,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
        arrows:false,
        dots: true,

        // the magic
        responsive: [{
            breakpoint: 1500,
            settings: {
                slidesToShow: 4,
                infinite: true
            }

        }, {

            breakpoint: 1201,
            settings: {
                slidesToShow: 3,
                dots: true
            }

        }, {

            breakpoint: 991,
            settings: {
                slidesToShow: 2,
                dots: true
            }

        }, {

            breakpoint: 600,
            settings: {
                slidesToShow: 1,
                dots: true
            }

        }, {

            breakpoint: 300,
            settings: {
                slidesToShow: 1,
                dots: true
            },
        }]
    });


    $(".partner-slider").slick({
        // normal options...
        infinite: false,
        slidesToShow: 5,
        slidesToScroll: 2,
        autoplay: true,
        autoplaySpeed: 2000,
        infinite: true,
        arrows:true,

        // the magic
        responsive: [{

            breakpoint: 1500,
            settings: {
                slidesToShow: 4,
                infinite: true
            }

        }, {

            breakpoint: 1201,
            settings: {
                slidesToShow: 3,
                dots: true
            }

        }, {

            breakpoint: 991,
            settings: {
                slidesToShow: 2,
                dots: true,
                arrows:false,
            }

        }, {
            breakpoint: 600,
            settings: {
                slidesToShow: 2,
                dots: true,
                arrows:false
            }

        }]
    });



    $(".product-slider").slick({
        // normal options...
        infinite: false,
        slidesToShow: 5,
        slidesToScroll: 2,
        autoplay: true,
        autoplaySpeed: 2000,
        infinite: true,
        arrows:true,

        // the magic
        responsive: [{

            breakpoint: 1024,
            settings: {
                slidesToShow: 3,
                infinite: true
            }

        }, {

            breakpoint: 600,
            settings: {
                slidesToShow: 2,
                dots: true
            }

        }, {

            breakpoint: 300,
            settings: "unslick" // destroys slick

        }]
    });

    //for testimonial
    $('.testimonial-img').slick({
        speed: 500,
        arrows: false,
        autoplay: true,
        autoplaySpeed: 2000,
        slidesToShow: 1,
        slidesToScroll: 1,
        asNavFor: '.testimonial-text',
        centerMode: true,
        centerPadding: 0,
        responsive: [
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    centerMode: true,
                    focusOnSelect: true,
                    centerPadding: 0,
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    centerMode: true,
                    focusOnSelect: true,
                    centerPadding: 0,
                }
            },
            {
                breakpoint: 575,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    centerMode: true,
                    focusOnSelect: true,
                    centerPadding: 0,
                }
            }
        ]
    });



    $('.testimonial-text').slick({
        infinite: false,
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
        infinite: true,
        arrows:true,
        centerPadding: 0,
        dots: false,
        speed: 1000,
        asNavFor: '.testimonial-img',
        prevArrow: '<i class="icofont-double-right"></i>',
        nextArrow: '<i class="icofont-double-left"></i>',

        responsive: [
            {
                breakpoint: 991,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 767,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                }
            }
        ]
    });
</script>
