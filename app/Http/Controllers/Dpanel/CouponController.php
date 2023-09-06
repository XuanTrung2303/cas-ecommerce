<?php

namespace App\Http\Controllers\Dpanel;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Coupon::paginate(20);

        return view('dpanel.coupon', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:coupons,code',
            'type' => 'required',
            'value' => 'required',
            'from_valid' => 'required'
        ]);

        $data = new Coupon;
        $data->code = $request->code;
        $data->type = $request->type;
        $data->value = $request->value;
        $data->min_cart_amount = $request->min_cart_amount;
        $data->from_valid = $request->from_valid;
        $data->till_valid = $request->till_valid;
        $data->save();

        return back()->withSuccess('New Coupon added Successfully');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'code' => 'required|unique:coupons,code,' . $id,
            'type' => 'required',
            'value' => 'required',
            'from_valid' => 'required'
        ]);

        $data = Coupon::find($id);
        $data->code = $request->code;
        $data->type = $request->type;
        $data->value = $request->value;
        $data->min_cart_amount = $request->min_cart_amount;
        $data->from_valid = $request->from_valid;
        $data->till_valid = $request->till_valid;
        $data->save();

        return back()->withSuccess('Coupon updated  Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    // /**
    //  * Display a listing of the resource.
    //  */
    // public function index()
    // {
    //     //
    // }

    // /**
    //  * Show the form for creating a new resource.
    //  */
    // public function create()
    // {
    //     //
    // }

    // /**
    //  * Store a newly created resource in storage.
    //  */
    // public function store(Request $request)
    // {
    //     //
    // }

    // /**
    //  * Display the specified resource.
    //  */
    // public function show(string $id)
    // {
    //     //
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  */
    // public function edit(string $id)
    // {
    //     //
    // }

    // /**
    //  * Update the specified resource in storage.
    //  */
    // public function update(Request $request, string $id)
    // {
    //     //
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  */
    // public function destroy(string $id)
    // {
    //     //
    // }
}
