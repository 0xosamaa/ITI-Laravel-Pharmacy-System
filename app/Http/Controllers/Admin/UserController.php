<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\User;
use App\Models\Governorate;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use Faker\Provider\UserAgent;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $data = User::all();
        return view('admin.users.index', ['users' => $data]);
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        $default_adress = UserAddress::where('is_main',1)->where('user_id',$id)->with('governorate')->first();
        return view('admin.users.info',['user'=>$user, 'address'=>$default_adress]);
    }

    public function create()
    {
        $governorate = Governorate::all();
        if ($governorate) {
            return view('admin.users.create', ['governorates' => $governorate]);
        }
    }

    public function store(Request $request){
        $validData = $request->validate([
            'name' => 'required | min:3',
            'email' => ['required' , 'email' , 'unique:users,email'],
            'password' => ['required', 'min:6', 'confirmed'],
            'national_id' => ['required', 'digits:14', 'unique:users,national_id'],
            'gender' => 'in:male,female',
            'avatar_image' => ['file', 'mimes:jpg,png', 'max:2048'],
            'flat_number' => ['nullable', 'numeric'],
            'floor_number' => ['nullable', 'numeric'],
            'building_number' => ['nullable', 'numeric'],
            'area_id' => ['nullable', 'alpha_num'],
            'street_name' => ['nullable', 'string'],
            'is_main' => ['required'],
            'governorate_id' => ['exists:governorates,id']
        ]);

        // Upload Image...
        $fileName = '';
        if($request->file('avatar_image')){
            $image = $request->file('avatar_image');
            $fileName = now() . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('/storage/images/users'), $fileName);
        }else{
            $fileName = 'default.jpg';
        }

        // dd($validData);
        DB::beginTransaction();
        try{
            $user = new User;
            $user->name = $validData['name'];
            $user->email = $validData['email'];
            $user->password = Hash::make($validData['password']);
            $user->national_id = $validData['national_id'];
            $user->gender = $validData['gender'];
            $user->profile_image_path = $fileName;
            // $user->assignRole('user');
            $user->save();

            $address = new UserAddress;
            $address->flat_number = $validData['flat_number'];
            $address->floor_number = $validData['floor_number'];
            $address->building_number = $validData['building_number'];
            $address->street_name = $validData['street_name'];
            $address->area_id = $validData['area_id'];
            $address->is_main = $validData['is_main'];
            $address->governorate_id = $validData['governorate_id'];
            $address->user_id = $user->id;
            $address->save();
            
            DB::commit();
            return redirect()->route('admin.users.index')->with('success', 'User Added Successfully.');
        }catch(Exception $e){
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage()); //'Error Occured While Adding New Record...!'
        }
    }

    public function edit($id){
        $userData = UserAddress::where('user_id', $id)->with(['governorate', 'user'])->firstOrFail();
        $governorates = Governorate::all();
        $addresses = UserAddress::where('user_id', $id)->with('governorate')->get();

        return view('admin.users.edit', ['userData' => $userData, 'addresses' => $addresses, 'governorates' => $governorates]);
    }

    public function update($id, Request $request){
        $user = User::findOrFail($id);
        $validData = $request->validate([
            'name' => 'required | min:3',
            'national_id' => 'nullable|digits:14|unique:users,national_id,'.$user->id.',id',
            'mobile_number' => 'nullable|digits:11|unique:users,mobile_number,'.$user->id.',id',
            'gender' => 'in:male,female',
            'date_of_birth' => ['nullable', 'date'],
            'avatar_image' => ['file', 'mimes:jpg,png', 'max:2048'],
            'address_id' => ['exists:user_addresses,id']
        ]);

        // Upload Image...
        $fileName = '';
        if($request->file('avatar_image')){
            $image = $request->file('avatar_image');
            $fileName = now() . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('/storage/images/users'), $fileName);

            $old_img = $user->profile_image_path;
            if($old_img){
                File::delete(public_path('/storage/images/users/').$old_img );
            }
        }

        // dd($validData);
        DB::beginTransaction();
        try{
            $user->name = $validData['name'];
            $user->national_id = $validData['national_id'];
            $user->mobile_number = $validData['mobile_number'];
            $user->gender = $validData['gender'];
            $user->date_of_birth = $validData['date_of_birth'];
            if($fileName != '') $user->profile_image_path = $fileName;
            $user->save();

            $new_address = UserAddress::findOrFail($validData['address_id']);
            if($new_address->is_main == 0){
                $oldAddress = $user->user_addresses()->where('is_main', 1)->first();
                if($oldAddress){
                    $oldAddress->is_main = 0;
                    $oldAddress->save();
                }

                $new_address->is_main = 1;
                $new_address->save();
            }
            
            DB::commit();
            return redirect()->route('admin.users.index')->with('success', 'User Updated Successfully.');
        }catch(Exception $e){
            DB::rollBack();
            // dd($e->getMessage());
            return redirect()->back()->with('error', $e->getMessage()); //'Error Occured While Adding New Record...!'
        }
    }

    public function destroy($id){
        User::destroy($id);
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }
}
