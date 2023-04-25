<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Medicine;
use App\Models\Pharmacy;
use Illuminate\Http\Request;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $medicinesCount = Medicine::count();
        $pharmaciesCount = Pharmacy::count();
        $doctorsCount = Doctor::count();
        $usersCount = User::count();


        return view('admin.dashboard', [
            'medicinesCount' => $medicinesCount,
            'pharmaciesCount' => $pharmaciesCount,
            'doctorsCount' => $doctorsCount,
            'usersCount' => $usersCount
        ]);
    }
}
