<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Medicine;
use App\Models\OrderDetails;
use App\Models\OrderItems;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        // get user with the given id
        /*$delivery = User::findOrFailed($data['user_id'])->user_addresses;
        $delivery_address = "$delivery->street $delivery->city $delivery->governate->name";*/
        $delivery_address = "Address 1";

        // create order details and get the id of the created order details
        $order = [
            'user_id' => $data['user_id'],
            'pharmacy_id' => $data['pharmacy_id'],
            'status' => 'New',
            'is_insured' => true,
            'delivery_address' => $delivery_address,
        ];
        $order['creator_type'] = 'user';

        // get all medicines with id in array of ids
        $medicines = Medicine::whereIn('id', $data['medicines'])->get();
        $total = 0;
        foreach ($medicines as $medicine) {
            $total += $medicine->price;
        }
        $order['total'] = $total;
        $orderDetails = OrderDetails::create($order);

        foreach ($medicines as $medicine) {
            OrderItems::create([
                'order_id' => $orderDetails->id,
                'medicine_id' => $medicine->id,
                'quantity' => 1,
            ]);
        }
        $res = OrderDetails::create($order);
        return response()->json(['message' => 'Order created successfully', 'order' => $res]);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
