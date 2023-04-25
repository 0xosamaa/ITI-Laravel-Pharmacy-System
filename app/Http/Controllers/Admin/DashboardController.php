<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
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

    public function getAdminStats()
    {
        $medicinesCount = Medicine::count();
        $pharmaciesCount = Pharmacy::count();
        $doctorsCount = Doctor::count();
        $usersCount = User::count();

        return response()->json([
            'medicinesCount' => $medicinesCount,
            'pharmaciesCount' => $pharmaciesCount,
            'doctorsCount' => $doctorsCount,
            'usersCount' => $usersCount
        ]);
    }

    public function getMedicinesStats()
    {
        $medicinesByCategory = Medicine::selectRaw('category_id, count(*) as medicine_count')
                            ->groupBy('category_id')
                            ->get();

        foreach ($medicinesByCategory as $category) {
            $categoryName = Category::where('id', $category->category_id)
                        ->first()->name;
            $medicineCount = $category->medicine_count;

            $medicines[$categoryName] = $medicineCount;
        }

        return response()->json($medicines);
    }

    public function getPharmaciesStats()
    {
        $pharmaciesDoctors = Doctor::selectRaw('pharmacy_id, count(*) as doctor_count')
                            ->groupBy('pharmacy_id')
                            ->get();

        foreach ($pharmaciesDoctors as $pharmacy) {
            $pharmacyName = Pharmacy::where('id', $pharmacy->pharmacy_id)
                        ->first()->name;
            $doctorCount = $pharmacy->doctor_count;

            $pharmacies[$pharmacyName] = $doctorCount;
        }

        return response()->json($pharmacies);
    }
}
