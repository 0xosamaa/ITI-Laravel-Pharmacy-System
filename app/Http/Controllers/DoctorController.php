<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Pharmacy;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;

class DoctorController extends Controller
{
    public function index()
    {
        return view('admin.doctors.index');
    }

    public function create()
    {
        $pharmacies = Pharmacy::all();

        return view('admin.doctors.create', [
            'pharmacies' => $pharmacies
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'min:6', 'confirmed', Rules\Password::defaults()],
            'national_id' => ['required', 'digits:14', 'unique:'.Doctor::class],
            'avatar_image' => ['nullable', 'image'],
            'pharmacy_id' => ['required', 'exists:pharmacies,id']
        ], [
            'name.required' => 'Name is required',
            'name.max' => 'Name must be at most 255 characters',
            'email.required' => 'Email is required',
            'email.max' => 'Email must be at most 255 characters',
            'email.unique' => 'Email already exists',
            'password.required' => 'Password is required',
            'password.min' => 'Password must be at least 6 characters',
            'national_id.required' => 'National ID is required',
            'national_id.digits' => 'National ID must be a valid 14-digit number',
            'national_id.unique' => 'National ID already exists',
            'avatar_image.image' => 'Avatar must be an image',
            'pharmacy_id.required' => 'Pharmacy is required',
            'pharmacy_id.exists' => 'Pharmacy does not exist'
        ]);

        if ($request->hasFile('avatar_image')) {
            $image = $request->file('avatar_image');
            $extension = $image->getClientOriginalExtension();
            $filename = uniqid() . '.' . $extension;
            $image->move(public_path('admins/images/doctors'), $filename);
        }
        else {
            $filename = 'default.jpg';
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Doctor::create([
            'doctor_id' => $user->id,
            'national_id' => $request->national_id,
            'avatar_image' => $filename,
            'pharmacy_id' => $request->pharmacy_id
        ]);

        return redirect('doctors')->with('success', 'Doctor created successfully');
    }
}
