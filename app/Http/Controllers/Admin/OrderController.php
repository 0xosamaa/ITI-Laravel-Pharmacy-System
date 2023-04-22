<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Medicine;
use App\Models\OrderDetails;
use App\Models\OrderItems;
use App\Models\Pharmacy;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->hasRole('pharmacist')) {
            $orders = OrderDetails::where('pharmacy_id', Auth::user()->id)->get();
        }
        elseif (Auth::user()->hasRole('doctor')) {
            $orders = OrderDetails::where('doctor_id', Auth::user()->id)->get();
        }
        else {
            $orders = OrderDetails::all();
        }
        return view('admin.Orders.index',['orders' => $orders]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $medicines = Medicine::all();
        $users = User::role('user')->get();
        $pharmacies = Pharmacy::all();
        return view('admin.Orders.create', ['medicines' => $medicines, 'users' => $users, 'pharmacies' => $pharmacies]);

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
        if (isset($data['doctor_id'])) {
            $order['doctor_id'] = $data['doctor_id'];
            $order['creator_type'] = 'doctor';
        }
        elseif (Auth::user()->hasRole('admin')) {
            $order['creator_type'] = 'admin';
        }
        else {
            $order['creator_type'] = 'pharmacy';
        }
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
        // create order items
        return redirect()->route('admin.orders.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $order = OrderDetails::find($id);
        return view('admin.Orders.show', ['order' => $order]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $order = OrderDetails::find($id);
        $pharmacies = Pharmacy::all();
        $users = User::role('user')->get();
        $medicines = Medicine::all();
        return view('admin.Orders.edit', ['order' => $order, 'pharmacies' => $pharmacies, 'users' => $users, 'medicines' => $medicines]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();
        $medicines = Medicine::whereIn('id', $data['medicines'])->get();
        $order = OrderDetails::find($id);
        $medicine_arr = $order->items->pluck('medicine_id')->toArray();

        // Compare old medicines with new medicines
        if ($data['medicines'] != $medicine_arr) {
            $total = 0;
            foreach ($medicines as $medicine) {
                $total += $medicine->price;
            }
            $data['total'] = $total;
            foreach ($data['medicines'] as $medicine) {
                if (!in_array($medicine, $medicine_arr)) {
                    OrderItems::create([
                        'order_id' => $id,
                        'medicine_id' => $medicine,
                        'quantity' => 1,
                    ]);
                }
            }
            foreach ($medicine_arr as $medicine) {
                if (!in_array($medicine, $data['medicines'])) {
                    OrderItems::where('order_id', $id)->where('medicine_id', $medicine)->delete();
                }
            }

        }
        unset($data['medicines']);

        $order->update($data);
        return redirect()->route('admin.orders.show', $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $order = OrderDetails::find($id);
        $order->status = 'Canceled';
        $order->save();
        return redirect()->route('admin.orders.index');

        /*$order = OrderDetails::find($id);
        $order->items->each->delete();
        $order->delete();
        return redirect()->route('admin.orders.index');*/
    }
}
