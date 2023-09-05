<?php

namespace App\Http\Controllers;

use App\Models\UserAddress;
use App\Models\Variant;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $addresses = [];

        if (auth()->check()) {
            $addresses = UserAddress::where('user_id', auth()->user()->id)->get();
        }

        return view('cart', compact('addresses'));
    }

    public function apiCartProducts(Request $request)
    {
        $ids = explode(',', $request->ids);
        $data = Variant::with('color:id,code', 'size:id,code', 'product:id,title', 'product.oldestImage')->whereIn('id', $ids)->get();

        return response()->json($data);
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
