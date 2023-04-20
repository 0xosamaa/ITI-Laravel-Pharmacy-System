<?php

namespace App\Http\Controllers;

use App\Models\Pharmacy;
use Illuminate\Http\Request;
use DataTables;

class PharmacyController extends Controller
{
    public function index(Request $request)
    {
        $allPharmacies = Pharmacy::all();
        return view('admin.Pharmacy.index', ['pharmacies'=>$allPharmacies]);
    }
}
