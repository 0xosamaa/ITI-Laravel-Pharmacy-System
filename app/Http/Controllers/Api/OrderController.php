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
    public function getOrdersByUser()
    {
        $user = Auth::user();
        $orders = OrderDetails::where('user_id', $user->id)->get();
        return response()->json(['orders' => $orders]);
    }

    public function AddNewOrder(Request $request)
    {
        try {
            $data = $request->all();
            $user = Auth::user();
            $delivery_address = $user->main_address()->governorate->name . ' ' . $user->main_address()->street_name . ' ' . $user->main_address()->building_number . ' ' . $user->main_address()->floor_number . ' ' . $user->main_address()->flat_number;
            // create array of medicine ids from an array of medicine objects
            $medicine_ids = array_map(function ($item) {
                return $item['medicine_id'];
            }, $data['cart']);
            $medicines = Medicine::whereIn('id', $medicine_ids)->get();
            $total_price = 0;
            foreach ($data['cart'] as $item) {
                $medicine = $medicines->where('id', $item['medicine_id'])->first();
                $total_price += $medicine->price * $item['quantity'];
            }

            $order = [
                'user_id' => $user->id,
                'pharmacy_id' => $data['pharmacy_id'],
                'status' => 'New',
                'delivery_address' => $delivery_address,
                'total' => $total_price,
                'creator_type' => 'user',
                'is_insured' => true,
            ];
            $orderDetails = OrderDetails::create($order);
            foreach ($data['cart'] as $item) {
                $medicine = $medicines->where('id', $item['medicine_id'])->first();
                OrderItems::create([
                    'order_id' => $orderDetails->id,
                    'medicine_id' => $medicine->id,
                    'quantity' => $item['quantity'],
                ]);
            }
            return response()->json(['msg'=>'Order Done Wait For Confirmation','order' => $orderDetails]);
        }
        catch (\Exception $e) {
            return response()->json(['msg'=>'Something Went Wrong']);
        }


    }



    public function destroy(string $id)
    {
        // Send Notification to Pharmacy or Doctor with the order id
    }
}
