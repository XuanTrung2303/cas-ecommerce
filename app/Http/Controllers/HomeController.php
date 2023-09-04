<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with([
            'image',
            'variant' => function ($q) {
                $q->with('color', 'size');
            }
        ])
            ->withCount('image')
            ->havingRaw('image_count > 0')
            ->latest()->limit(12)->get();
        return view('welcome', compact('products'));
    }

    public function productDetail(Request $request, $slug)
    {
        $filter[] = $request->c ?? null; // Color
        $filter[] = $request->s ?? null; // Size

        $product = Product::with([
            'brand',
            'image',
            'variant' => function ($q) use ($filter) {
                $color_id = $filter[0];
                $size_id = $filter[1];
                $q->when($color_id, function ($q2, $color_id) {
                    return $q2->where('color_id', $color_id);
                })->when($size_id, function ($q2, $size_id) {
                    return $q2->where('size_id', $size_id);
                })->with('color', 'size');
            }
        ])->where('slug', $slug)->first();

        abort_if(!$product, 404);

        $products = Product::with([
            'image',
            'variant' => function ($q) {
                $q->with('color', 'size');
            }
        ])
            ->withCount('image')
            ->havingRaw('image_count > 0')
            ->latest()->limit(12)->get();
        return view('product_detail', compact('products', 'product'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
