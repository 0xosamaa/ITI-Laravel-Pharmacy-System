<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class LandingPageController extends Controller
{
    public function index()
    {
        $medicines = Medicine::inRandomOrder()->limit(12)->get();
        $new_medicines = Medicine::where('created_at', '>=', Carbon::now()->subDays(14)->toDateTimeString())->limit(12)->get();
        return view('site.landing-page', compact('medicines', 'new_medicines'));
    }
}
