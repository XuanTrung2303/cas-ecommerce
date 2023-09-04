<a href="{{ route('product_detail', $product->slug) }}" class="bg-white rounded-lg shadow-lg p-3 relative">
    <img class="mx-auto" src="{{ asset('storage/' . $product->image[0]->path) }}" alt="">

    <div class="flex justify-between gap-3 my-3">
        <p class="text-lg font-medium text-gray-800">{{ $product->title }}</p>
        <div class="flex flex-col items-end">
            <strong class="text-violet-600">{{ $product->variant[0]->selling_price }} VND</strong>
            <strike class="text-gray-400">{{ $product->variant[0]->mrp }} VND</strike>
        </div>
    </div>
    <div class="flex justify-between items-center mb-2">
        <div class="flex gap-1">
            @foreach ($product->variant as $item)
                <span style="background-color: {{ $item->color->code }}" class="w-5 h-5 rounded-full">&nbsp;</span>
            @endforeach
        </div>

        <div class="flex gap-1 text-gray-400 text-sm">
            @foreach ($product->variant as $item)
                <span
                    class="flex justify-center items-center w-5 h5 rounded-full border border-gray-400">{{ $item->size->code }}</span>
            @endforeach
        </div>
    </div>
    <div class="flex justify-between items-center">
        <span class="text-gray-400"><i class='bx bx-star'></i>4.5</span>
        <span class="text-violet-600 flex items-center font-bold">
            <i class='bx bxs-cart-add text-2xl'></i>Buy Now
        </span>
    </div>
    <div class="absolute top-2 left-3 right-3 flex justify-between items-center">
        @php
            $discount = round((($product->variant[0]->mrp - $product->variant[0]->selling_price) / $product->variant[0]->mrp) * 100, 2);
        @endphp
        <span class="bg-red-500 text-white rounded px-2 text-xs">{{ round($discount, 2) }}% Off</span>
        <span class="bg-white shadow-md rounded-full w-7 h-7 flex items-center justify-center"><i
                class='bx bx-heart text-xl'></i></span>
    </div>
</a>
