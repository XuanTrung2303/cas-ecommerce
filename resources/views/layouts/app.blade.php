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
            @auth
                <a href="{{ route('account') }}"><i class='bx bx-user'></i></a>
            @else
                <button type="button" onclick="toggleLoginPopup()"><i class='bx bx-user'></i></button>
            @endauth
            <a href="{{ route('cart') }}"><i class='bx bx-cart'></i></a>
            <span
                class="absolute top-0 -right-2.5 bg-indigo-600 rounded-full w-4 h-4 text-xs text-white text-center">0</span>
        </div>
    </div>

    <main>
        @yield('body_content')
        <div id="login-popup"
            class="absolute top-14 right-1/2 md:right-1 left-1/2 md:left-auto -translate-x-1/2 translate-y-8 md:translate-x-0 z-50 bg-white border rounded shadow-lg p-2 w-11/12 md:w-80 hidden">
            <h2 class="text-center text-lg font-bold">Login</h2>
            <hr class="mb-3">

            {{-- Login Form --}}
            <form action="" id="login" class="grid grid-cols-1 gap-3">
                <div class="relative border rounded">
                    <label class="text-gray-400 bg-white px-1 absolute -top-3 left-3">Email</label>
                    <input type="email" name="email" placeholder="Enter your email"
                        class="w-full px-2 pt-1.5 placeholder-slate-300 bg-transparent focus:outline-none">
                </div>
                <div class="relative border rounded">
                    <label class="text-gray-400 bg-white px-1 absolute -top-3 left-3">Password</label>
                    <input type="password" name="password" placeholder="Enter your password"
                        class="w-full px-2 pt-1.5 placeholder-slate-300 bg-transparent focus:outline-none">
                    <button type="button" class="absolute -bottom-5 text-gray-400 left-2 text-sm">Forgot
                        Password?</button>
                </div>

                <button type="button" class="bg-violet-500 mt-4 text-white font-medium py-1 rounded">Login</button>
                <button type="button" onclick="toggleLoginAndRegisterForm()" class="text-sm text-gray-800">Don't have
                    account? <span class="text-violet-500 underline">Register Now</span></button>
            </form>

            {{-- Register Form --}}
            <form action="" id="register" class="grid grid-cols-1 gap-3 hidden">

                <div class="relative border rounded">
                    <label class="text-gray-400 bg-white px-1 absolute -top-3 left-3">First Name</label>
                    <input type="text" name="first_name" placeholder="Enter your first name"
                        class="w-full px-2 pt-1.5 placeholder-slate-300 bg-transparent focus:outline-none">
                </div>

                <div class="relative border rounded">
                    <label class="text-gray-400 bg-white px-1 absolute -top-3 left-3">Last Name</label>
                    <input type="text" name="last_name" placeholder="Enter your last name"
                        class="w-full px-2 pt-1.5 placeholder-slate-300 bg-transparent focus:outline-none">
                </div>

                <div class="relative border rounded">
                    <label class="text-gray-400 bg-white px-1 absolute -top-3 left-3">Email</label>
                    <input type="email" name="email" placeholder="Enter your email"
                        class="w-full px-2 pt-1.5 placeholder-slate-300 bg-transparent focus:outline-none">
                </div>

                <div class="relative border rounded">
                    <label class="text-gray-400 bg-white px-1 absolute -top-3 left-3">Password</label>
                    <input type="password" name="password" placeholder="Enter your password"
                        class="w-full px-2 pt-1.5 placeholder-slate-300 bg-transparent focus:outline-none">
                </div>

                <button type="button" class="bg-violet-500 mt-4 text-white font-medium py-1 rounded">Register</button>
                <button type="button" onclick="toggleLoginAndRegisterForm()" class="text-sm text-gray-800">Already have
                    account? <span class="text-violet-500 underline">Login Now</span></button>
            </form>
        </div>
    </main>

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
    <script>
        const toggleLoginAndRegisterForm = () => {
            let loginForm = document.getElementById('login');
            loginForm.classList.toggle('hidden');
            document.getElementById('register').classList.toggle('hidden');

            loginForm.previousElementSibling.previousElementSibling.innerHTML = loginForm.classList.contains('hidden') ?
                'Register' : 'Login';
        }

        const toggleLoginPopup = () => document.getElementById('login-popup').classList.toggle('hidden');
    </script>

    @stack('scripts')
</body>

</html>
