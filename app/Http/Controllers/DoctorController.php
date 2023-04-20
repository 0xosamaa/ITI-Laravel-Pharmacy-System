<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function index()
    {
        return view('admin/doctors.index');
    }

    public function create()
    {
        return view('admin/doctors.create');
    }
}
