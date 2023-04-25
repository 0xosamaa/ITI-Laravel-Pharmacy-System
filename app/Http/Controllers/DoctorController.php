<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Doctor;
use App\Models\Pharmacy;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Http\Requests\StoreDoctorRequest;
use App\Http\Requests\UpdateDoctorRequest;

class DoctorController extends Controller
{
    public function index()
    {
        $doctors = Doctor::with("pharmacy", "user")->get();
        return view('admin.doctors.index', compact('doctors'));
    }

    public function create()
    {
        $pharmacies = Pharmacy::all();
        return view('admin.doctors.create', compact('pharmacies'));
    }

    public function store(StoreDoctorRequest $request)
    {
        if ($request->hasFile('avatar_image')) {
            $image = $request->file('avatar_image');
            $extension = $image->getClientOriginalExtension();
            $filename = uniqid() . '.' . $extension;
            $image->move(public_path('storage/images/doctors'), $filename);
        }
        else {
            $filename = '../default.jpg';
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'national_id' => $request->national_id,
            'profile_image_path' => $filename
        ])->assignRole('doctor');

        DB::table('doctors')->insert([
            'user_id' => $user->id,
            'pharmacy_id' => $request->pharmacy_id
        ]);

        return redirect(route('admin.doctors.index'))->with('success', 'Doctor created successfully');
    }

    public function show($id)
    {
        $doctor = Doctor::find($id);
        return view('admin.doctors.show', compact('doctor'));
    }

    public function edit($id)
    {
        $doctor = Doctor::find($id);
        $pharmacies = Pharmacy::all();

        return view('admin.doctors.edit', [
            'doctor' => $doctor,
            'pharmacies' => $pharmacies
        ]);
    }

    public function update($id, UpdateDoctorRequest $request)
    {
        $doctor = Doctor::find($id);

        if ($request->hasFile('avatar_image')) {
            $image = $request->file('avatar_image');
            $extension = $image->getClientOriginalExtension();
            $filename = uniqid() . '.' . $extension;
            $image->move(public_path('storage/images/doctors'), $filename);
            if ($doctor->user->profile_image_path != '../default.jpg') {
                File::delete(public_path('storage/images/doctors/'). $doctor->user->profile_image_path);
            }
        }
        else {
            $filename = $doctor->user->profile_image_path;
        }

        DB::table('users')->where('id', $doctor->user_id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'national_id' => $request->national_id,
            'profile_image_path' => $filename,
            'updated_at' => \Carbon\Carbon::now()
        ]);

        DB::table('doctors')->where('id', $doctor->id)->update([
            'pharmacy_id' => $request->pharmacy_id
        ]);

        return redirect(route('admin.doctors.index'))->with('success', 'Doctor updated successfully');
    }

    public function destroy($id)
    {
        $doctor = Doctor::find($id);

        if ($doctor->user->profile_image_path != '../default.jpg') {
            File::delete(public_path('storage/images/doctors/'). $doctor->user->profile_image_path);
        }
        DB::table('doctors')->where('id', $doctor->id)->delete();
        Doctor::destroy($id);

        // Get the updated list of doctors
        $doctors = Doctor::all();

        // Return a JSON response with the updated data
        return response()->json([
            'success' => true,
            'message' => 'Doctor deleted successfully.'
        ]);
    }

    public function ban($id)
    {
        $doctor = Doctor::find($id);
        $doctor->user->ban();

        return response()->json([
            'success' => true,
            'message' => 'Doctor banned successfully.'
        ]);
    }

    public function unban($id)
    {
        $doctor = Doctor::find($id);
        $doctor->user->unban();

        return response()->json([
            'success' => true,
            'message' => 'Doctor unbanned successfully.'
        ]);
    }
}
