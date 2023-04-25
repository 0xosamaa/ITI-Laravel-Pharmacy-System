<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Medicine;
use App\Models\OrderDetails;
use App\Models\OrderItems;
use App\Models\PaymentDetails;
use App\Models\Pharmacy;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe\Stripe;

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
        $user = User::findOrFail($data['user_id']);
        $delivery_address = $user->main_address()->governorate->name . ' ' . $user->main_address()->street_name . ' ' . $user->main_address()->building_number . ' ' . $user->main_address()->floor_number . ' ' . $user->main_address()->flat_number;
        // create order details and get the id of the created order details
        $order = [
            'user_id' => $data['user_id'],
            'pharmacy_id' => $data['pharmacy_id'],
            'status' => 'WaitingForUserConfirmation',
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
            if (!isset($data[$medicine->id])) {
                $data[$medicine->id] = 1;
            }
            $total += $medicine->price * $data[$medicine->id];
        }
        $order['total'] = $total;
        $orderDetails = OrderDetails::create($order);

        foreach ($medicines as $medicine) {
            OrderItems::create([
                'order_id' => $orderDetails->id,
                'medicine_id' => $medicine->id,
                'quantity' => $data[$medicine->id],
            ]);
            unset($data[$medicine->id]);
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
            // Update order items
            foreach ($medicines as $medicine) {
                if (!in_array($medicine->id, $medicine_arr)) {
                    OrderItems::create([
                        'order_id' => $id,
                        'medicine_id' => $medicine['id'],
                        'quantity' => $data[$medicine->id] | 1,
                    ]);
                    $total += $medicine->price * $data[$medicine->id];
                    unset($data[$medicine->id]);
                }
                elseif (in_array($medicine->id, $medicine_arr) && $data[$medicine->id] != null) {
                    $order_item = OrderItems::where('order_id', $id)->where('medicine_id', $medicine->id)->first();
                    $order_item->quantity = $data[$medicine->id];
                    $order_item->save();
                    $total += $medicine->price * $data[$medicine->id];
                    unset($data[$medicine->id]);
                }
            }
            // Delete old order items
            foreach ($medicine_arr as $medicine) {
                if (!in_array($medicine, $data['medicines'])) {
                    OrderItems::where('order_id', $id)->where('medicine_id', $medicine)->delete();
                }
            }
            $data['total'] = $total;

        }
        else{
            $total = 0;
            foreach ($medicines as $medicine) {
                $order_item = OrderItems::where('order_id', $id)->where('medicine_id', $medicine->id)->first();
                if($data[$medicine->id] != null){
                    $order_item->quantity = $data[$medicine->id];
                    $order_item->save();
                    $total += $medicine->price * $data[$medicine->id];
                    unset($data[$medicine->id]);
                }
                else
                    $total += $medicine->price * $order_item->quantity;
            }
            $data['total'] = $total;
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

    public function checkOut(Request $request,string $id)
    {

        $order = OrderDetails::find($id);


        $token = request()->stripeToken;
        try {
            Stripe::setApiKey(env('STRIPE_SECRET'));
            $charge = \Stripe\Charge::create([
                'amount' => (int)($order->total/100),
                'currency' => 'usd',
                'source' => $token,
                'description' => 'Order Charge',
                'receipt_email' => $order->user->email,
                'metadata' => [
                    'contents' => $order->items->map(function ($item) {
                        return $item->medicine->name . ', ' . $item->quantity;
                    })->values()->toJson(),
                    'quantity' => $order->items->sum('quantity'),
                ],
            ]);

            $order->status = 'Completed';
            $order->save();
            $payment = PaymentDetails::create([
                'order_id' => $order->id,
                'user_id' => $order->user_id,
                'amount' => $charge->amount,
                'status' => $charge->status,
                'payment_method' => $charge->payment_method,
                'balance_transaction' => $charge['balance_transaction'],
                'transaction_id' => $charge->id,
                'receipt_url' => $charge['receipt_url'],
            ]);
            return redirect()->back()->with('success' , $charge->receipt_url);

        } catch (\Exception $e) {
            dd($e->getMessage());
            //return redirect()->back()->with('Failed' , 'Payment Failed');
        }
    }
    public function quantity(Request $request)
    {
        $data = $request->all();
        // check if url contains create
        $sender = 'create';
        if (strpos(url()->previous(), 'edit')) {
            $sender = 'edit';
        }
        $medicines = Medicine::whereIn('id', $data['medicines'])->get();
        return view('admin.Orders.quantity', ['medicines' => $medicines, 'data' => $data, 'sender' => $sender]);
    }
}
