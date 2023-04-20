<?php

namespace App\Http\Controllers;

use App\Models\Area;
use Illuminate\Http\Request;
use DataTables;

class AreaController extends Controller
{
    public function index(Request $request)
    {
        $areas = Area::all();

        return view('admin.Area.index',['areas'=>$areas]);
    }
}
