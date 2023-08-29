<?php

namespace App\Http\Controllers\Dpanel;

use App\Models\ProductImage;
use App\Models\Size;
use App\Models\Brand;
use App\Models\Color;
use App\Models\Product;
use App\Models\Variant;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Product::with('brand', 'category')->paginate(10);

        return view('dpanel.product.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $brands = Brand::where('is_active', true)->get();
        $categories = Category::where('is_active', true)->get();
        $colors = Color::where('is_active', true)->get();
        $sizes = Size::where('is_active', true)->get();

        return view('dpanel.product.create', compact('brands', 'categories', 'colors', 'sizes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'brand_id' => 'required',
            'title' => 'required|max:255|unique:products',
            'description' => 'required',
            'color_id' => 'required|array|min:1',
            'size_id' => 'required|array|min:1',
            'mrp' => 'required|array|min:1',
            'selling_price' => 'required|array|min:1',
            'stock' => 'required|array|min:1',
            'images.*' => 'mimes:jpg,jpeg,png'
        ]);

        // Store Product
        $product = new Product;
        $product->brand_id = $request->brand_id;
        $product->category_id = $request->category_id;
        $product->title = $request->title;
        $product->slug = Str::slug($request->title);
        $product->description = $request->description;
        $product->save();

        // Store Variant
        $colors = $request->color_id;
        foreach ($colors as $key => $color_id) {
            $product_id = $product->id;
            $size_id = $request->size_id[$key];
            $sku = 'CAS' . $product_id . 'T' . $color_id . 'S' . $size_id; # CASICISI where P-Product, C-color and S-Size

            $variant = new Variant;
            $variant->sku = $sku;
            $variant->product_id = $product_id;
            $variant->color_id = $color_id;
            $variant->size_id = $size_id;
            $variant->mrp = $request->mrp[$key];
            $variant->selling_price = $request->selling_price[$key];
            $variant->stock = $request->stock[$key];
            $variant->save();
        }

        // Store Image
        foreach ($request->images as $image) {
            $productImage = new ProductImage;
            $productImage->product_id = $product->id;
            $productImage->path = $image->store('media', 'public');
            $productImage->save();
        }

        return redirect()->route('dpanel.product.index')->withSuccess('Product Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Product::with('variant', 'image')->find($id);

        abort_if(!$data, 404);

        $brands = Brand::where('is_active', true)->get();
        $categories = Category::where('is_active', true)->get();
        $colors = Color::where('is_active', true)->get();
        $sizes = Size::where('is_active', true)->get();

        return view('dpanel.product.edit', compact('brands', 'categories', 'colors', 'sizes', 'data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'category_id' => 'required',
            'brand_id' => 'required',
            'title' => 'required|max:255|unique:products,title,' . $id,
            'description' => 'required',
            'color_id' => 'required|array|min:1',
            'size_id' => 'required|array|min:1',
            'mrp' => 'required|array|min:1',
            'selling_price' => 'required|array|min:1',
            'stock' => 'required|array|min:1',
            'images.*' => 'nullable|mimes:jpg,jpeg,png'
        ]);

        // Update Product
        $product = Product::find($id);
        $product->brand_id = $request->brand_id;
        $product->category_id = $request->category_id;
        $product->title = $request->title;
        $product->slug = Str::slug($request->title);
        $product->description = $request->description;
        $product->save();

        // Update Variant
        $colors = $request->color_id;
        foreach ($colors as $key => $color_id) {
            $product_id = $product->id;
            $size_id = $request->size_id[$key];
            $sku = 'CAS' . $product_id . 'T' . $color_id . 'S' . $size_id; # CASICISI where P-Product, C-color and S-Size

            if (isset($request->variant_ids[$key])) {
                $variant = Variant::find($request->variant_ids[$key]);
            } else {
                $variant = new Variant;
            }
            $variant->sku = $sku;
            $variant->product_id = $product_id;
            $variant->color_id = $color_id;
            $variant->size_id = $size_id;
            $variant->mrp = $request->mrp[$key];
            $variant->selling_price = $request->selling_price[$key];
            $variant->stock = $request->stock[$key];
            $variant->save();
        }

        // Update Image
        foreach ($request->images as $key => $image) {

            if (isset($request->image_ids[$key])) {
                $productImage = ProductImage::find($request->image_ids[$key]);
                Storage::disk('public')->delete($productImage->path);
                $productImage->path = $image->store('media', 'public');
                $productImage->save();
            } else {
                $productImage = new ProductImage;
                $productImage->product_id = $product->id;
                $productImage->path = $image->store('media', 'public');
                $productImage->save();
            }
        }

        return redirect()->route('dpanel.product.index')->withSuccess('Product Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
