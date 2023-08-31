@extends('layouts.app')

@push('scripts')
    <script>
        const getDistrictStateByPinCode = (e, district = null, state = null) => {
            let calledApi = false;

            if (calledApi) return;

            let _district = document.getElementById('district');
            let _state = document.getElementById('state');
            let pin_code = typeof e == 'string' ? e : e.value;

            if (pin_code.length == 6) {
                calledApi = true;
                fetch(`https://api.postalpincode.in/pincode/${pin_code}`)
                    .then((response) => response.json())
                    .then((data) => {
                        data = data[0];
                        if (data.Status == 'Success') {
                            var distItems = [];
                            var stateItems = [];
                            data.PostOffice.forEach(ele => {
                                if (distItems.indexOf(ele.District) == -1) distItems.push(ele.District);
                                if (stateItems.indexOf(ele.State) == -1) stateItems.push(ele.State);
                            });
                            if (distItems.length == 1) {
                                _district.innerHTML = `<option value="${distItems[0]}">${distItems[0]}</option>`;
                            } else {
                                let html = '<option value="">Select</option>';
                                distItems.forEach(element => {
                                    html +=
                                        `<option value="${element}" ${element==district?'selected':''}>${element}</option>`;
                                });
                                _district.innerHTML = html;
                            }
                            if (stateItems.length == 1) {
                                _state.innerHTML = `<option value="${stateItems[0]}">${stateItems[0]}</option>`;
                            } else {
                                let html = '<option value="">Select</option>';
                                stateItems.forEach(element => {
                                    html +=
                                        `<option value="${element}" ${element==state?'selected':''}>${element}</option>`;
                                });
                                _state.innerHTML = html;
                            }
                        } else {
                            toast.error(data.Message);
                        }
                    });
            }
        }
        @if ($data->pin_code)
            getDistrictStateByPinCode("{{ $data->pin_code }}", "{{ $data->district }}", "{{ $data->state }}");
        @endif
    </script>
@endpush

@section('body_content')
    <div class="px-6 md:min-h-screen md:px-20 mt-6 grid grid-cols-1 md:grid-cols-6 gap-4">
        <div>
            <ul class="flex md:flex-col flex-wrap justify-between gap-3 md:gap-1" id="tabLinks">
                <li><a class="flex" href="{{ route('account.index') }}">My Profile</a></li>
                <li><a class="flex" href="{{ route('account.index', ['tab' => 'orders']) }}">My Orders</a></li>
                <li><a class="flex text-violet-600 underline" href="{{ route('account.index', ['tab' => 'address']) }}">My
                        Address</a>
                </li>
                <li><a href="{{ route('logout') }}" class="flex">Logout</a></li>
            </ul>
        </div>

        {{-- Right Side --}}
        <div class="md:col-span-5">
            <section id="profile" class="tabContent border border-slate-300 rounded px-4 pt-2 pb-4">
                <h3 class="text-gray-900 font-medium text-center">Edit Delivery Address</h3>
                <hr class="mb-3">

                <form action="{{ route('address.update', $data->id) }}" method="POST"
                    class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    @method('PUT')
                    @csrf

                    <div class="mt-4 relative border border-slate-300 rounded">
                        <label for="" class="absolute -top-3.5 left-3 bg-gray-50 px-1 text-gray-400 ">
                            Default Address
                        </label>
                        <select name="is_default_address" class="mt-2 px-3 bg-transparent focus:outline-none w-full"
                            required>
                            <option value="">Select</option>
                            <option value="1" @selected($data->is_default_address = 1)>Yes</option>
                            <option value="0" @selected($data->is_default_address = 0)>No</option>
                        </select>
                    </div>
                    <div class="mt-4 relative border border-slate-300 rounded">
                        <label for="" class="absolute -top-3.5 left-3 bg-gray-50 px-1 text-gray-400 ">
                            Address Type
                        </label>
                        <select name="tag" class="mt-2 px-3 bg-transparent focus:outline-none w-full" required>
                            <option value="">Select</option>
                            <option value="Home" @selected($data->tag = 'Home')>Home</option>
                            <option value="Office" @selected($data->tag = 'Office')>Office</option>
                        </select>
                    </div>
                    <div class="mt-4 relative border border-slate-300 rounded">
                        <label for="" class="absolute -top-3.5 left-3 bg-gray-50 px-1 text-gray-400 ">First
                            Name</label>
                        <input type="text" name="first_name" value="{{ $data->first_name }}"
                            class="mt-2 px-3 bg-transparent focus:outline-none w-full" required>
                    </div>
                    <div class="mt-4 relative border border-slate-300 rounded">
                        <label for="" class="absolute -top-3.5 left-3 bg-gray-50 px-1 text-gray-400 ">Last
                            Name</label>
                        <input type="text" name="last_name" value="{{ $data->last_name }}"
                            class="mt-2 px-3 bg-transparent focus:outline-none w-full" required>
                    </div>
                    <div class="mt-4 relative border border-slate-300 rounded">
                        <label for="" class="absolute -top-3.5 left-3 bg-gray-50 px-1 text-gray-400 ">Mobile
                            Number</label>
                        <input type="tel" maxlength="10" name="mobile_no" value="{{ $data->mobile_no }}"
                            class="mt-2 px-3 bg-transparent focus:outline-none w-full" required>
                    </div>
                    <div class="mt-4 relative border border-slate-300 rounded">
                        <label for="" class="absolute -top-3.5 left-3 bg-gray-50 px-1 text-gray-400 ">Street
                            Address</label>
                        <input type="text" name="street_address" value="{{ $data->street_address }}"
                            class="mt-2 px-3 bg-transparent focus:outline-none w-full" required>
                    </div>
                    <div class="mt-4 relative border border-slate-300 rounded">
                        <label for="" class="absolute -top-3.5 left-3 bg-gray-50 px-1 text-gray-400 ">Pin
                            Code</label>
                        <input type="tel" maxlength="6" onkeyup="getDistrictStateByPinCode(this)" name="pin_code"
                            value="{{ $data->pin_code }}" class="mt-2 px-3 bg-transparent focus:outline-none w-full"
                            required>
                    </div>

                    <div class="mt-4 relative border border-slate-300 rounded">
                        <label for="" class="absolute -top-3.5 left-3 bg-gray-50 px-1 text-gray-400 ">
                            District
                        </label>
                        <select name="district" id="district" class="mt-2 px-3 bg-transparent focus:outline-none w-full"
                            required>
                        </select>
                    </div>
                    <div class="mt-4 relative border border-slate-300 rounded">
                        <label for="" class="absolute -top-3.5 left-3 bg-gray-50 px-1 text-gray-400 ">
                            State
                        </label>
                        <select name="state" id="state" class="mt-2 px-3 bg-transparent focus:outline-none w-full"
                            required>
                        </select>
                    </div>

                    <div>
                        <label for="">&nbsp;</label>
                        <button
                            class="bg-violet-500 rounded shadow py-1 text-center w-full text-white uppercase font-medium">Update</button>
                    </div>
                </form>

            </section>
        </div>
        {{-- Right Side End --}}
    </div>
@endsection
