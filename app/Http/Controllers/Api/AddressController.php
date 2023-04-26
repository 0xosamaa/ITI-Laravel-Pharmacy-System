<?php

namespace App\Http\Controllers\Api;

use App\Models\Governorate;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use GuzzleHttp\Psr7\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Exception;
use Money\Exchange;

class AddressController extends Controller
{
    //index
    public function index($id)
    {
        $data = UserAddress::where('user_id', $id)->get();
        if ($data) {
            return response()->json(['data'=>$data]);
        }
    }

    public function store(Request $request, $user_id)
    {
        $validatedAddress = Validator::make($request->all(),[
            'flat_number' => 'required|max:255',
            'floor_number' => 'required|max:255',
            'building_number' => 'required|max:255',
            'area_id' => 'required|max:255',
            'street_name' => 'required|max:255',
            'governorate_id' => 'required|exists:governorates,id'
        ]); 

        if($validatedAddress->fails()){
            return response(['errors'=>$validatedAddress->errors()], 422);
        }

        try{
            $data = $request->all();
            $data['user_id'] = $user_id;
            UserAddress::create($data);
        }catch(Exception $e){
            return response(['errors'=>'Error to add this address...!']);
        }

        return response(['message'=>'Address added successfully.', 'address'=>$data]);
    }

    public function update(Request $request, $user_id, $address_id)
    {
        $address = UserAddress::findOrfail($address_id);
        if($address === null){
            return response(['errors'=>'No such address exists...!'],420);
        }
        
        $validatedAddress = Validator::make($request->all(),[
            'flat_number' => 'nullable|max:255',
            'floor_number' => 'nullable|max:255',
            'building_number' => 'nullable|max:255',
            'area_id' => 'nullable|max:255',
            'street_name' => 'nullable|max:255',
            'governorate_id' => 'exists:governorates,id'
        ]); 

        if($validatedAddress->fails()){
            return response(['errors'=>$validatedAddress->errors()], 422);
        }

        try{
            $data = $request->all();
            $address->flat_number = $data['flat_number'];
            $address->floor_number = $data['floor_number'];
            $address->building_number = $data['building_number'];
            $address->street_name = $data['street_name'];
            $address->area_id = $data['area_id'];
            $address->governorate_id = $data['governorate_id'];
            $address->user_id = $user_id;
            $address->update();
        }catch(Exception $e){
            return response(['errors'=>$e->getMessage()]);
        }

        return response(['message'=>'Address updated successfully.', 'address'=>$address]);
    }

    public function show($user_id, $address_id)
    {
        $address = UserAddress::find($address_id);
        if($address === null){
            return response(['errors'=>'No such address exists...!'],420);
        }

        return response(['address'=>$address]);
    }

    public function destroy($user_id, $address_id)
    {
        $address = UserAddress::find($address_id);
        if($address === null){
            return response(['errors'=>'No such address exists...!'],420);
        }
        try{
            $address->delete();
        }catch(Exception $e){
            return response(['errors'=>$e->getMessage()]);
        }

        return response(['message'=>'Address deleted successfully.', 'address'=>$address]);
    }
}
