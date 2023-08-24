<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name') }}</title>

    <!-- Fonts -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />


    @stack('css')
    <!-- Styles -->
    @vite('resources/css/app.css')
</head>

<body class="bg-[#FBFBFB]">
    <div class="flex justify-between px-6 md:px-20 items-center mt-4 bg-white shadow py-2">
        <a href="/"><img src="{{ asset('dd4you/dpanel/images/logo.jfif') }}" alt="LOGO"
                style="width: 160px;height:100px"></a>
        <div class="text-2xl relative">
            <a href="{{ route('wishlist') }}"><i class='bx bx-heart'></i></a>
            <a href="{{ route('account') }}"><i class='bx bx-user'></i></a>
            <a href="{{ route('cart') }}"><i class='bx bx-cart'></i></a>
            <span
                class="absolute top-0 -right-2.5 bg-indigo-600 rounded-full w-4 h-4 text-xs text-white text-center">0</span>
        </div>
    </div>

    <main>@yield('body_content')</main>

    <footer class="px-6 md:px-20 mt-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
            <div>
                <img src="{{ asset('dd4you/dpanel/images/logo.jfif') }}" alt=""
                    style="width: 160px;height:100px">
                <ul class="mt-3 text-gray-600">
                    <li><i class='bx bx-map'></i>Nai Hien Dong, Son Tra</li>
                    <li><i class='bx bxs-phone'></i>+84 379912786</li>
                    <li><i class='bx bx-envelope'></i>xuantrung276@gmail.com</li>
                </ul>
            </div>

            <div>
                <h2 class="text-lg font-medium text-gray-800">Categories</h2>
                <ul class="mt-1 text-gray-800">
                    <li>Category 1</li>
                    <li>Category 2</li>
                    <li>Category 3</li>
                    <li>Category 4</li>
                    <li>Category 5</li>
                </ul>
            </div>

            <div>
                <h2 class="text-lg font-medium text-gray-800">Further Info</h2>
                <ul class="mt-1 text-gray-800">
                    <li>Home</li>
                    <li>About Us</li>
                    <li>Contact Us</li>
                    <li>Pivacy Policy</li>
                    <li>Terms of Use</li>
                </ul>
            </div>
        </div>
        <p class="text-gray-400 text-center my-3">
            Copyright &copy; {{ date('Y') }} CasEcommerce | Designed by <a
                href="https://www.facebook.com/castrichmauxanh" class="underline"></a> Gnurt
        </p>
    </footer>

    <script src="{{ asset('dd4you/dpanel/js/jquery-3.6.1.min.js') }}"></script>


    @stack('scripts')
</body>

</html>
