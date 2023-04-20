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
<<<<<<< HEAD
}
=======
}
>>>>>>> 8d0e4480603ac6e605bb79638a364bcf115d4254
