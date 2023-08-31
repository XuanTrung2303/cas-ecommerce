<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserAddress;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->method() == 'POST') {
            $request->validate([
                'first_name' => 'required|max:25',
                'last_name' => 'required|max:25',
                'email' => 'required|email',
                'mobile' => 'required|max:10',
            ]);
            $user = User::find(auth()->user()->id);
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $user->mobile = $request->mobile;
            $user->save();

            return back()->withSuccess('Update Successfully');
        }

        $addresses = UserAddress::where('user_id', auth()->user()->id)->get();
        return view('account', compact('addresses'));
    }


    // Address

    public function newAddress(Request $request)
    {
        if ($request->method() == 'GET') return view('new_address');

        $request->validate([
            'is_default_address' => 'required',
            'tag' => 'required|max:50',
            'first_name' => 'required|max:50',
            'last_name' => 'required|max:50',
            'mobile_no' => 'required|max:10',
            'street_address' => 'required|max:100',
            'district' => 'required|max:50',
            'state' => 'required|max:50',
            'pin_code' => 'required|max:6',
            'note' => 'max:250',
        ]);

        $address = new UserAddress;
        $address->user_id = auth()->user()->id;
        $address->is_default_address = $request->is_default_address;
        $address->tag = $request->tag;
        $address->first_name = $request->first_name;
        $address->last_name = $request->last_name;
        $address->mobile_no = $request->mobile_no;
        $address->street_address = $request->street_address;
        $address->district = $request->district;
        $address->state = $request->state;
        $address->pin_code = $request->pin_code;
        $address->note = $request->note;
        $address->save();

        if ($address->is_default_address) self::setDefaultAddress($address->id);

        return redirect()->route('account.index', ['tab' => 'address'])->withSuccess('New Delivery Address Added');
    }

    public function editAddress(Request $request, $id)
    {
        if ($request->method() == 'GET') {
            $data = UserAddress::find($id);
            return view('edit_address', compact('data'));
        }

        $request->validate([
            'is_default_address' => 'required',
            'tag' => 'required|max:50',
            'first_name' => 'required|max:50',
            'last_name' => 'required|max:50',
            'mobile_no' => 'required|max:10',
            'street_address' => 'required|max:100',
            'district' => 'required|max:50',
            'state' => 'required|max:50',
            'pin_code' => 'required|max:6',
            'note' => 'max:250',
        ]);

        $address = UserAddress::find($id);
        $address->is_default_address = $request->is_default_address;
        $address->tag = $request->tag;
        $address->first_name = $request->first_name;
        $address->last_name = $request->last_name;
        $address->mobile_no = $request->mobile_no;
        $address->street_address = $request->street_address;
        $address->district = $request->district;
        $address->state = $request->state;
        $address->pin_code = $request->pin_code;
        $address->note = $request->note;
        $address->save();

        if ($address->is_default_address) self::setDefaultAddress($address->id);

        return redirect()->route('account.index', ['tab' => 'address'])->withSuccess('Delivery Address Updated');
    }

    private static function setDefaultAddress($address_id)
    {
        UserAddress::where('user_id', auth()->user()->id)->where('id', '!=', $address_id)->update(['is_default_address' => false]);
    }

    // End Address
}
