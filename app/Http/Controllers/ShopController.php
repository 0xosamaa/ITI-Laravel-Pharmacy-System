<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index()
    {
        $medicines = Medicine::with('discount')->paginate(12);
        return view('site.shop.index', compact('medicines'));
    }

    public function show(Medicine $medicine)
    {
        return view('site.shop.show', ['medicine' => $medicine]);
    }
}
