<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Models\Governorate;
use App\Models\UserAddress;
use Faker\Provider\UserAgent;
use GuzzleHttp\Psr7\Request;

class UserController extends Controller
{
    public function index(){
        $data = User::all();
        return view('admin.users.index', ['users'=>$data]);
    }

    public function show($id){
        $user = User::findOrFail($id);
        $default_adress = UserAddress::where('is_main',1)->with('governorate')->first();
        // $user_adresses = User::with('user_addresses')->get();
        // dd($default_adress);
        return view('admin.users.info',['user'=>$user, 'address'=>$default_adress]);
    }

    public function create(){
        $governorate = Governorate::all();
        if($governorate){
            return view('admin.users.create', ['governorates'=>$governorate]);
        }
    }

    public function edit($id){
        $user = User::findOrFail($id);
        dd($user);
    }
}
