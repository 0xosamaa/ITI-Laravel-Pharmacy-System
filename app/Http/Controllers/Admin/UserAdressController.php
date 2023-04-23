<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use App\Models\Governorate;

class UserAdressController extends Controller
{
    //index
    public function index($id)
    {
        $data = UserAddress::where('user_id', $id)->get();
        if ($data) {
            return view('admin.user_addresses.index', ['addresses' => $data, "id" => $id]);
        }
    }

    public function create($id)
    {
        $governorates = Governorate::all();
        return view('admin.user_addresses.create', ['governorates' => $governorates, 'id' => $id]);
    }

    public function store($user_id, Request $request)
    {
        $validedAddress = $request->validate([
            'flat_number' => 'required|max:255',
            'floor_number' => 'required|max:255',
            'building_number' => 'required|max:255',
            'street_name' => 'required|max:255',
            'governorate_id' => 'required|exists:governorates,id'
        ]);
        $validedAddress["user_id"] = $user_id;

        UserAddress::create($validedAddress);

        return redirect()->route('admin.users.addresses.index', $user_id)->with('success', 'Address Added successfully.');
    }

    public function edit($user_id, $address_id)
    {
        $governorates = Governorate::all();
        $address = UserAddress::findOrFail($address_id);

        if ($address && $user_id)
            return view('admin.user_addresses.edit', ["address" => $address, 'user_id' => $user_id, 'governorates' => $governorates]);
    }

    public function update($user_id, $address_id, Request $request)
    {
        $address = UserAddress::findOrfail($address_id);

        $validedAddress = $request->validate([
            'flat_number' => 'required|max:255',
            'floor_number' => 'required|max:255',
            'building_number' => 'required|max:255',
            'street_name' => 'required|max:255',
            'governorate_id' => 'required|exists:governorates,id'
        ]);

        $address->flat_number = $validedAddress["flat_number"];
        $address->floor_number = $validedAddress["floor_number"];
        $address->building_number = $validedAddress["building_number"];
        $address->street_name = $validedAddress["street_name"];
        $address->governorate_id = $validedAddress["governorate_id"];
        $address->save();

        return redirect()->route('admin.users.addresses.index', $user_id)->with('success', 'Address Updated successfully.');
    }

    public function show($user_id, $address_id)
    {
        $address = UserAddress::findOrfail($address_id);

        if ($address) {
            return view("admin.user_addresses.show", ['address' => $address]);
        }
    }

    public function destroy($user_id, $address_id)
    {
        $address = UserAddress::findOrFail($address_id);
        $address->delete();

        return redirect()->route('admin.users.addresses.index', $user_id)->with('success', 'Address deleted successfully.');
    }
}
