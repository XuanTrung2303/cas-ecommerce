@extends('layouts.app')

@push('scripts')
    <script></script>
@endpush

@section('body_content')
    <section class="px-6 md:px-20 mt-6 min-h-screen">

        <h1 class="text-5xl font-bold text-center drop-shadow-md text-black py-16">Shopping Cart</h1>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            {{-- Left Side --}}
            <div class="md:col-span-2">
                {{-- Delivery Addresses --}}
                <h3 class="text-gray-700 text-lg font-medium">Delivery Address</h3>
                <div class="flex gap-4 mb-3">
                    <div class="flex gap-4 overflow-x-auto pt-2 scrollbar-thin scrollbar-thumb-gray-400 scrollbar-h-1">
                        @foreach (range(1, 4) as $item)
                            <label for="address_{{ $loop->index }}" class="shrink-0 w-72 relative">
                                <input type="radio" name="address" id="address_{{ $loop->index }}" class="hidden peer">
                                <div class="p-2 border border-slate-300 peer-checked:border-violet-600 rounded-md">
                                    <div class="flex justify-between items-center">
                                        <span class="text-black font-bold">Vinay Rajput</span>
                                        <span class="text-gray-400 cursor-pointer"><i class='bx bx-pencil'></i>Edit</span>
                                    </div>
                                    <p class="text-gray-400 text-sm leading-4">Railway Station, NH 28, Railway Colony
                                        Gorakhpur,
                                        Uttar
                                        Pradesh - 273008</p>
                                    <p class="text-gray-600 text-sm">Mobile No: +84 98989899</p>
                                </div>
                                <i
                                    class='hidden peer-checked:block absolute -top-3 -right-2 bx bxs-check-circle text-xl text-violet-600 bg-white'></i>
                            </label>
                        @endforeach
                    </div>
                    <div
                        class="bg-slate-300 text-gray-400 cursor-pointer px-2 md:px-4 rounded-md shrink-0 flex flex-col items-center justify-center">
                        <i class='bx bxs-plus-circle text-lg'></i>
                        <span class="text-sm ">Add Address</span>
                    </div>
                </div>
                {{-- Delivery Address End --}}
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
                                    <div class="flex items-center justify-center gap-1">
                                        <i class='text-gray-400 bx bx-minus-circle text-xl'></i>
                                        <span class="border border-slate-300 px-3 loading-none">01</span>
                                        <i class='text-green-400 bx bx-plus-circle text-xl'></i>
                                    </div>
                                    <button class="text-gray-400 uppercase">Remove</button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            {{-- Left Side End --}}

            {{-- Right Side --}}
            <div>
                <div class="bg-white rounded-md shadow-md p-2">
                    <h3 class="mb-3 text-black font-medium uppercase">Order Details</h3>

                    <div class="relative mb-2 px-2 py-1.5 border border-slate-300 rounded-md">
                        <label class="absolute -top-3.5 left-5 text-slate-300 bg-white px-1">Discount Code</label>
                        <div class="flex justify-between">
                            <input type="text" name="" placeholder="Enter Discount Code"
                                class="w-full focus:outline-none">
                            <button class="text-violet-600 font-medium">Apply</button>
                        </div>
                    </div>

                    <div class="flex justify-between items-center">
                        <span class="text-gray-400">Subtotal</span>
                        <span class="text-gray-800 font-bold">2.000.000 VND</span>
                    </div>

                    <div class="flex justify-between items-center">
                        <span class="text-gray-400">Shipping cost</span>
                        <span class="text-gray-800 font-bold">0 VND</span>
                    </div>

                    <div class="mb-2 flex justify-between items-center">
                        <span class="text-gray-400">Discount (25%)</span>
                        <span class="text-violet-600 font-bold">500.000 VND</span>
                    </div>
                    <div class="mb-1 flex justify-between items-center">
                        <span class="text-gray-400">Total</span>
                        <span class="text-gray-800 font-bold">1.500.000 VND</span>
                    </div>

                    <div class="flex justify-between items-center bg-green-100 px-2 py-1 rounded-md">
                        <span class="text-green-500">Your total Savings amount on this order</span>
                        <span class="text-green-500 font-bold">500.000 VND</span>
                    </div>

                    <button
                        class="mt-5 bg-violet-600 text-white font-bold text-center w-full py-1 rounded shadow">Checkout</button>
                </div>
            </div>
            {{-- Right Side End --}}

        </div>

        <div>
            <h3 class="mb-4 text-gray-700 text-lg font-medium">Payment Method</h3>

            <div class="flex flex-wrap gap-3">
                <label for="" class="border border-slate-300 rounded p-2">
                    <input type="radio" name="payment_method" id="" class="hidden peer">
                    <span class="text-gray-400 font-medium uppercase">Pay On Delivery</span>
                </label>

                <label for="" class="border border-slate-300 rounded py-2 px-6">
                    <input type="radio" name="payment_method" id="" class="hidden peer">
                    <span class="text-gray-400 font-medium uppercase">UPI</span>
                </label>

                <label for="" class="border border-slate-300 rounded p-2">
                    <input type="radio" name="payment_method" id="" class="hidden peer">
                    <span class="text-gray-400 font-medium uppercase">Paytm</span>
                </label>
            </div>
        </div>
    </section>
@endsection
