<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name') }}</title>

    <!-- Fonts -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('dd4you/dpanel/css/owl.carousel.min.css ') }}">
    <link rel="stylesheet" href="{{ asset('dd4you/dpanel/css/owl.theme.default.min.css') }}">

    <!-- Styles -->
    @vite('resources/css/app.css')
</head>

<body class="bg-[#FBFBFB]">
    <div class="flex justify-between px-20 items-center mt-4 bg-white shadow py-2">
        <img src="{{ asset('dd4you/dpanel/images/logo.jfif') }}" alt="LOGO" style="width: 160px;height:100px">
        <div class="text-2xl relative">
            <i class='bx bx-heart'></i>
            <i class='bx bx-user'></i>
            <i class='bx bx-cart'></i>
            <span
                class="absolute top-0 -right-2.5 bg-indigo-600 rounded-full w-4 h-4 text-xs text-white text-center">0</span>
        </div>
    </div>

    <div>
        <div class="owl-carousel h-min">
            <a href="#">
                <img src="dd4you/dpanel/images/banner.png" alt="">
            </a>
            <a href="#">
                <img src="dd4you/dpanel/images/banner.png" alt="">
            </a>
            <a href="#">
                <img src="dd4you/dpanel/images/banner.png" alt="">
            </a>
            <a href="#">
                <img src="dd4you/dpanel/images/banner.png" alt="">
            </a>
            <a href="#">
                <img src="dd4you/dpanel/images/banner.png" alt="">
            </a>
        </div>
    </div>

    <h1>dd</h1>

    <script src="{{ asset('dd4you/dpanel/js/jquery-3.6.1.min.js') }}"></script>
    <script src="{{ asset('dd4you/dpanel/js/owl.carousel.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $(".owl-carousel").owlCarousel({
                loop: true,
                margin: 10,
                dots: false,
                responsiveClass: true,
                responsive: {
                    0: {
                        items: 1,
                    },
                    600: {
                        items: 1,
                    },
                    1000: {
                        items: 1,
                    }
                }

            });
        });
    </script>
</body>

</html>
