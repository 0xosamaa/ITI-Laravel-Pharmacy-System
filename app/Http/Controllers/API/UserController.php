<?php

namespace App\Http\Controllers\API;

use Exception;
use App\Models\User;
use App\Mail\VerifyEmail;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use App\Mail\VerificationMail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Mail\Mailable;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //index
    public function index(){
        return "here we are...";
    }

    //register
    public function register(Request $request){
        $validData = Validator::make($request->all(),[
            'name' => 'required | min:3',
            'email' => ['required' , 'email' , 'unique:users,email'],
            'password' => ['required', 'min:6', 'confirmed'],
            'national_id' => ['required', 'digits:14', 'unique:users,national_id'],
            'gender' => 'required|in:male,female',
            'avatar_image' => ['file', 'mimes:jpg,png', 'max:2048'],
            'flat_number' => ['required', 'numeric'],
            'floor_number' => ['required', 'numeric'],
            'building_number' => ['required', 'numeric'],
            'area_id' => ['required', 'alpha_num'],
            'street_name' => ['required', 'string'],
            'is_main' => ['required'],
            'governorate_id' => ['required', 'exists:governorates,id']
        ]);

        if($validData->fails()){
            return response(['errors'=>$validData->errors()], 422);
        }

        // Upload Image...
        $fileName = '';
        if($request->hasFile('avatar_image')){
            $image = $request->file('avatar_image');
            $fileName = now() . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('/storage/images/users'), $fileName);
        }else{
            $fileName = 'default.jpg';
        }

        // dd($validData);
        DB::beginTransaction();
        try{
            $data = $request->all();
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'national_id' => $data['national_id'],
                'gender' => $data['gender'],
                'profile_image_path' => $fileName,
            ])->assignRole('user');

            $address = UserAddress::create([
                'flat_number' => $data['flat_number'],
                'floor_number' => $data['floor_number'],
                'building_number' => $data['building_number'],
                'street_name' => $data['street_name'],
                'area_id' => $data['area_id'],
                'is_main' => $data['is_main'],
                'governorate_id' => $data['governorate_id'],
                'user_id' => $user->id
            ]);

            // Send verification email to the user
            // Mail::to($user->email)->send(new VerificationMail($user));
            $user->sendEmailVerificationNotification();
            DB::commit();

            $token = $user->createToken($data['name'])->plainTextToken;
            event(new Registered($user));
            return response(['message'=>'Registered successfully.', 'user'=>$user, 'token'=>$token]);
        }catch(Exception $e){
            DB::rollBack();
            return response(['errors'=>$e->getMessage()], 500);
        }
    }
}
