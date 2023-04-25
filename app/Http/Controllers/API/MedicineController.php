<?php

namespace App\Http\Controllers\Api;

use App\Models\Medicine;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MedicineController extends Controller
{
    public function index()
    {
        $medicines = Medicine::with('discount')->paginate(12);
        return compact('medicines');
    }

    public function show(Medicine $medicine)
    {
        return compact('medicine');
    }
}
