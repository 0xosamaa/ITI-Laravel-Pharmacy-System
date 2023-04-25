<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;

class BanController extends Controller
{
    public function ban($id)
    {
        $doctor = Doctor::find($id);
        $doctor->user->ban();

        return response()->json([
            'success' => true,
            'message' => 'Doctor banned successfully.'
        ]);
    }

    public function unban($id)
    {
        $doctor = Doctor::find($id);
        $doctor->user->unban();

        return response()->json([
            'success' => true,
            'message' => 'Doctor unbanned successfully.'
        ]);
    }
}
