<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserAddress;
use Illuminate\Http\Request;

class UserAdressController extends Controller
{
    //index
    public function index(Request $request){
        $data = UserAddress::where('user_id', $request->query('id'))->get();
        if($data){
            return view('admin.user_addresses.index', ['addresses'=>$data]);
        }
    }
}
