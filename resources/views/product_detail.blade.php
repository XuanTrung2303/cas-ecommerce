@extends('layouts.app')

@push('scripts')
    <script>
        let currentImage = 0;

        const viewImage = (e, index) => {

            currentImage = index;

            document.getElementById('bigImage').src = e.querySelector('img').src;
        }

        const nextPrevious = (index) => {

            i = currentImage + index;

            let images = document.getElementById('images').querySelectorAll('img');

            if (i >= images.length || i < 0) return;

            currentImage = i;

            let arr = [];

            images.forEach(element => arr.push(element.src));

            document.getElementById('bigImage').src = arr[currentImage];
        }
    </script>
@endpush

@section('body_content')
    <section class="px-6 md:px-20 mt-6">
        <div class="flex flex-wrap md:flex-nowrap gap-6">
            {{-- left --}}
            <div class="shrink-0 w-full md:w-auto flex flex-col-reverse md:flex-row gap-4">
                <div id="images" class="flex md:flex-col gap-3 pb-1 md:pb-0 max-h-96 overflow-y-auto">
                    @foreach (range(1, 4) as $item)
                        <div onclick="viewImage(this, '{{ $loop->index }}')"
                            class="bg-white rounded-md shadow p-1 cursor-pointer">
                            <img class="w-16" src="{{ asset('dd4you/dpanel/images/product-' . $loop->iteration . '.png') }}"
                                alt="">
                        </div>
                    @endforeach
                </div>
                <div class="h-96 relative bg-white rounded-md shadow-md p-3">
                    <img id="bigImage" class="h-full aspect-[2/3]" src="{{ asset('dd4you/dpanel/images/product-1.png') }}"
                        alt="">

                    <span onclick="nextPrevious(-1)"
                        class="absolute top-1/2 left-2 bg-white rounded-full w-5 h-5 shadow flex items-center justify-center"><i
                            class='bx bx-chevron-left text-xl text-gray-400 hover:text-violet-600 duration-200 cursor-pointer'></i></span>
                    <span onclick="nextPrevious(1)"
                        class="absolute top-1/2 right-2 bg-white rounded-full w-5 h-5 shadow flex items-center justify-center"><i
                            class='bx bx-chevron-right text-xl text-gray-400 hover:text-violet-600 duration-200 cursor-pointer'></i></span>

                </div>
            </div>
            {{-- left End --}}

            {{-- Right  --}}
            <div class="w-full flex flex-col gap-4">
                <div class="flex gap-3">
                    <span class="bg-red-500 text-white rounded px-2 text-xs">25% Off</span>
                    <span class="text-gray-400 text-sm"><i class='bx bx-star'></i>4.8</span>
                </div>

                {{-- Name, SKU, Brand --}}
                <h2 class="text-lg font-medium text-gray-800">Men Blue Shirt</h2>
                <div class="text-sm text-gray-800">
                    <p><span class="text-gray-400">SKU:</span>FK-00001</p>
                    <p><span class="text-gray-400">Brand:</span>Brand Name</p>
                </div>

                {{-- Price --}}
                <div>
                    <span class="text-rose-500 font-bold text-xl">500.000 VND</span>
                    <sub class="text-gray-400"><strike>599.000 VND</strike></sub>
                </div>

                {{-- Colors --}}
                <div>
                    <p class="text-gray-400">Colors:</p>
                    <div class="flex gap-1">
                        <span style="background-color: #acacac" class="w-5 h-5 rounded-full">&nbsp;</span>
                        <span style="background-color: #cc00ff" class="w-5 h-5 rounded-full">&nbsp;</span>
                        <span style="background-color: #0048a7" class="w-5 h-5 rounded-full">&nbsp;</span>
                    </div>
                </div>

                {{-- Sizes --}}
                <div>
                    <p class="text-gray-400">Size:</p>
                    <div class="flex gap-1 text-gray-400 text-sm">
                        <span class="flex justify-center items-center w-5 h5 rounded-full border border-gray-400">S</span>
                        <span class="flex justify-center items-center w-5 h5 rounded-full border border-gray-400">M</span>
                        <span class="flex justify-center items-center w-5 h5 rounded-full border border-gray-400">L</span>
                    </div>
                    <a href="#" class="text-gray-400 text-xs">Size Guide</a>
                </div>

                {{-- Quantity --}}
                <div>
                    <p class="text-gray-400">Quantity</p>
                    <div class="flex items-center gap-2">
                        <input type="text" value="1" readonly
                            class="bg-slate-200 rounded border border-gray-300 focus:outline-none px-2 text-lg font-medium w-20">
                        <button class="rounded border border-gray-300 w-7 h-7"><i class='bx bx-minus text-xl'></i></button>
                        <button class="rounded border border-gray-300 w-7 h-7"><i class='bx bx-plus text-xl'></i></button>
                    </div>
                </div>

                {{-- Wishlist, Add to Cart Buy Now --}}
                <div class="flex items-center gap-4">
                    <span class="bg-white shadow-md rounded-full w-8 h-8 flex items-center justify-center">
                        <i class='bx bx-heart text-2xl text-gray-500'></i>
                    </span>
                    <button
                        class="border border-violet-600 rounded w-28 text-center drop-shadow font-medium text-violet-600 py-0.5">Add
                        to Cart</button>
                    <button
                        class="border border-violet-600 rounded w-28 text-center drop-shadow font-medium text-white bg-violet-600 py-0.5">Add
                        to Cart</button>
                </div>
            </div>
            {{-- Right End  --}}
        </div>

        {{-- Product Description --}}
        <div class="">
            <h3 class="text-lg text-gray-400 font-medium my-6">Product Description</h3>
            <div class="text-gray-600">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
                dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex
                ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat
                nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit
                anim id est laborum.
            </div>
        </div>


        <section class="mt-6">
            <h3 class="text-gray-800 font-medium mb-2">Featured Product</h3>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                @foreach (range(1, 12) as $item)
                    <x-product.card1 />
                @endforeach
            </div>
        </section>
    </section>
@endsection
