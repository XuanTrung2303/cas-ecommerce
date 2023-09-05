@extends('layouts.app')

@push('scripts')
    <script>
        const remoteItem = (e, id) => {
            mCart.remove(id);
            e.parentElement.parentElement.parentElement.remove();
        }

        setTimeout(() => {
            let items = mCart._getItems();
            let ids = Object.keys(items);

            axios.get(`${window.location.href}/products?ids=${ids}`)
                .then((res) => {
                    let html = '';
                    console.log('res', res.data);
                    res.data.forEach(item => {
                        let qty = mCart.getQty(item.id)
                        html += `<div class="flex gap-4">
                            <div class="bg-gray-100 rounded shadow p-2">
                                <img class="w-20" src="${'/storage/'+item.product.oldest_image.path}" alt="">
                            </div>
                            <div class="flex flex-col gap-0.5">
                                <h3 class="text-lg font-medium text-gray-800">${item.product.title}</h3>
                                <div class="text-gray-400 text-sm flex items-center gap-2">
                                    <p class="flex items-center gap-1">
                                        Color:
                                        <span sty le="background-color: ${item.color.code}" class="w-4 h-4 rounded-full">&nbsp;</span>
                                    </p>
                                    <p>Size: ${item.size.code}</p>
                                </div>
                                <p class="text-black text-lg">
                                    <span class="itemPrice">${item.selling_price}</span> VND x <span class="qty">${qty}</span> = <span class="font-bold"><span class="itemTotalPrice">${item.selling_price*qty} </span> VND</span>
                                </p>
                                <div class="flex items-center gap-6">
                                    <div class="flex items-center justify-center gap-1">
                                        <i onclick="mCart.manageQty(this, '${item.id}', -1, '${item.stock}')" class='text-gray-400 bx bx-minus-circle text-xl cursor-pointer'></i>
                                        <span class="border border-slate-300 px-3 loading-none">${qty}</span>
                                        <i onclick="mCart.manageQty(this, '${item.id}', 1, '${item.stock}')" class='text-green-400 bx bx-plus-circle text-xl cursor-pointer'></i>
                                    </div>
                                    <button onClick="remoteItem(this, '${item.id}')" class="text-gray-400 uppercase">Remove</button>
                                </div>
                            </div>
                        </div>`
                    });

                    document.getElementById('itemContainer').innerHTML = html;
                    mCart.updatePrice();
                })
                .catch((error) => {
                    cuteToast({
                        type: "error",
                        message: error.message,
                    })
                });
        }, 250);
    </script>
@endpush

@section('body_content')
    <section class="px-6 md:px-20 mt-6 min-h-screen">

        <h1 class="text-5xl font-bold text-center drop-shadow-md text-black py-12">Shopping Cart</h1>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            {{-- Left Side --}}
            <div class="md:col-span-2">
                {{-- Delivery Addresses --}}
                <h3 class="text-gray-700 text-lg font-medium">Delivery Address</h3>
                <div class="grid grid-cols-1 md:grid-cols-6 gap-4 mb-5">
                    <div
                        class="md:col-span-5 flex gap-4 overflow-x-auto pt-2 scrollbar-thin scrollbar-thumb-gray-400 scrollbar-h-1">
                        @forelse ($addresses as $item)
                            <label for="address_{{ $item->id }}" class="shrink-0 w-72 relative">
                                <input type="radio" @checked($item->is_default_address) name="address"
                                    id="address_{{ $item->id }}" value="{{ $item->id }}" class="hidden peer">
                                <div class="p-2 border border-slate-300 peer-checked:border-violet-600 rounded-md">
                                    <div class="flex justify-between items-center">
                                        <span class="text-black font-bold">{{ $item->full_name }}</span>
                                        <a href="{{ route('address.edit', $item->id) }}"
                                            class="text-gray-400 cursor-pointer"><i class='bx bx-pencil'></i>Edit</a>
                                    </div>
                                    <p class="text-gray-400 text-sm leading-4">{{ $item->full_address }}</p>
                                    <p class="text-gray-600 text-sm">Mobile No: +84 {{ $item->mobile_no }}</p>
                                </div>
                                <i
                                    class='hidden peer-checked:block absolute -top-3 -right-2 bx bxs-check-circle text-xl text-violet-600 bg-white'></i>
                            </label>
                        @empty
                            <div class="border rounded-md w-full flex py-10 justify-center items-center">
                                <button type="button" class="text-violet-500 font-medium"
                                    onclick="toggleLoginPopup()">Login to
                                    continue</button>
                            </div>
                        @endforelse
                    </div>
                    <a href="{{ route('address.create') }}"
                        class="bg-slate-300 text-gray-400 cursor-pointer px-2 pt-2 md:px-4 rounded-md shrink-0 flex flex-col items-center justify-center">
                        <i class='bx bxs-plus-circle text-lg'></i>
                        <span class="text-sm ">Add Address</span>
                    </a>
                </div>
                {{-- Delivery Address End --}}
                <div id="itemContainer" class="grid grid-cols-1 md:grid-cols-2 gap-5">

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
                        <span class="text-gray-800 font-bold"><span id="subtotal">0</span> VND</span>
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
                        <span class="text-gray-800 font-bold"><span id="total">0</span> VND</span>
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
