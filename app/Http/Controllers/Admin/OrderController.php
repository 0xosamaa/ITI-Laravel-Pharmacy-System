<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = [
            [
                'id' => 1,
                'doctor_name' => 'Dr. John Doe',
                'user_name' => 'John Doe',
                'createdAt' => '2021-01-01 12:00:00',
                'status' => 'New',
                'total' => 1400,
                'delivery_address' => 'Address 1',
                'assigned_pharmacy' => 'Pharmacist 1',
                'creator_type' => 'Admin 1',
                'is_insured' => true,
            ],
            [
                'id' => 2,
                'doctor_name' => 'Dr. John Doe',
                'user_name' => 'John Doe',
                'createdAt' => '2021-01-01 12:00:00',
                'status' => 'Confirmed',
                'total' => 1400,
                'delivery_address' => 'Address 1',
                'assigned_pharmacy' => 'Pharmacist 1',
                'creator_type' => 'Admin 1',
                'is_insured' => true,
            ],
            [
                'id' => 3,
                'doctor_name' => 'Dr. John Doe',
                'user_name' => 'John Doe',
                'createdAt' => '2021-01-01 12:00:00',
                'status' => 'Processing',
                'total' => 1400,
                'delivery_address' => 'Address 1',
                'assigned_pharmacy' => 'Pharmacist 1',
                'creator_type' => 'Admin 1',
                'is_insured' => true,
            ],
            [
                'id' => 4,
                'doctor_name' => 'Dr. John Doe',
                'user_name' => 'John Doe',
                'createdAt' => '2021-01-01 12:00:00',
                'status' => 'WaitingForUserConfirmation',
                'total' => 1400,
                'delivery_address' => 'Address 1',
                'assigned_pharmacy' => 'Pharmacist 1',
                'creator_type' => 'Admin 1',
                'is_insured' => true,
            ],
            [
                'id' => 5,
                'doctor_name' => 'Dr. John Doe',
                'user_name' => 'John Doe',
                'createdAt' => '2021-01-01 12:00:00',
                'status' => 'Canceled',
                'total' => 1400,
                'delivery_address' => 'Address 1',
                'assigned_pharmacy' => 'Pharmacist 1',
                'creator_type' => 'Admin 1',
                'is_insured' => true,
            ],
        ];
        return view('admin.Orders.index',['orders' => $orders]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.Orders.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        dd($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $order = [
            'id' => 1,
            'doctor_name' => 'Dr. John Doe',
            'user_name' => 'John Doe',
            'createdAt' => '2021-01-01 12:00:00',
            'status' => 'pending',
            'items' => [
                [
                    'id' => 1,
                    'name' => 'Item 1',
                    'quantity' => 1,
                    'price' => 100,
                    'total' => 100,
                ],
                [
                    'id' => 2,
                    'name' => 'Item 2',
                    'quantity' => 2,
                    'price' => 200,
                    'total' => 400,
                ],
                [
                    'id' => 3,
                    'name' => 'Item 3',
                    'quantity' => 3,
                    'price' => 300,
                    'total' => 900,
                ],
            ],
            'total' => 1400,
            'delivery_address' => 'Address 1',
            'assigned_pharmacy' => 'Pharmacist 1',
            'creator_type' => 'Admin 1',
            'is_insured' => true,
        ];
        return view('admin.Orders.show', ['order' => $order]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('admin.Orders.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        dd($id);
    }
}
