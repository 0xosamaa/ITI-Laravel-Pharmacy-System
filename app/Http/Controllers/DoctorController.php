<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function index()
    {
        return view('doctors.index');
    }

    public function create()
    {
        return view('doctors.create');
    }
}
