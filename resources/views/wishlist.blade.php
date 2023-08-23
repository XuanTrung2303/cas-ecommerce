@extends('layouts.app')

@section('body_content')
    <section class="px-6 md:px-20 mt-6 min-h-screen">

        <h1 class="text-5xl font-bold text-center drop-shadow-md text-black py-12">Wishlist</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            @foreach (range(1, 6) as $item)
                <div class="flex gap-4">
                    <div class="bg-gray-100 rounded shadow p-2">
                        <img class="w-20" src="{{ asset('dd4you/dpanel/images/product-1.png') }}" alt="">
                    </div>
                    <div class="flex flex-col gap-0.5">
                        <h3 class="text-lg font-medium text-gray-800">Men Blue Shirt</h3>
                        <div class="text-gray-400 text-sm flex items-center gap-2">
                            <p class="flex items-center gap-1">
                                Color:
                                <span style="background-color: #1a0faB" class="w-4 h-4 rounded-full">&nbsp;</span>
                            </p>
                            <p>Size: M</p>
                        </div>
                        <p class="text-black text-lg font-bold">500.000 VND
                            <sub class="text-sm text-normal text-red-500">599.000 VND
                                <span class="text-green-500">(25% off)</span>
                            </sub>
                        </p>
                        <div class="flex items-center gap-6">
                            <button class="text-violet-600 font-bold uppercase">Add To Cart</button>
                            <button class="text-gray-400 uppercase">Remove</button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endsection
