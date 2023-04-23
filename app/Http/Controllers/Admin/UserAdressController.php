<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserAddress;
use Illuminate\Http\Request;

class UserAdressController extends Controller
{
    //index
    public function index($id){
        $data = UserAddress::where('user_id', $id)->get();
        if($data){
            return view('admin.user_addresses.index', ['addresses'=>$data]);
        }
    }
}
