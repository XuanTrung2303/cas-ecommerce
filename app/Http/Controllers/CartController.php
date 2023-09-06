<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Variant;
use App\Models\UserAddress;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

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

    public function apiApplyCoupon(Request $request)
    {
        $data = Coupon::where('code', $request->code)
            ->whereDate('from_valid', '<=', Carbon::now())
            ->where(function ($q) {
                $q->whereDate('till_valid', '>=', Carbon::now())
                    ->orWhereNull('till_valid');
            })->first();

        abort_if(!$data, 404, 'Invalid or Expired Coupon Code');

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
