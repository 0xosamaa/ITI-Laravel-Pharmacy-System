<?php

namespace Database\Seeders;

use App\Models\Medicine;
use App\Models\OrderDetails;
use App\Models\OrderItems;
use App\Models\Pharmacy;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::role('user')->get()->pluck('id');
        $pharmacies = Pharmacy::all()->pluck('id');
        $medicines = Medicine::all();

        for ($i = 0; $i < 30; $i++) {
            $order = OrderDetails::create([
                'user_id' => $users->random(),
                'pharmacy_id' => $pharmacies->random(),
                'status' => 'WaitingForUserConfirmation',
                'is_insured' => true,
                'delivery_address' => 'Address 1',
                'creator_type' => 'doctor',
                'total' => 0,
            ]);

            $counter = fake()->numberBetween(1, 5);
            $total = 0;
            for ($j = 0; $j < $counter; $j++) {
                $item = OrderItems::create([
                    'order_id' => $order->id,
                    'medicine_id' => $medicines->random()->id,
                    'quantity' => fake()->numberBetween(1, 5),
                ]);
                $total += $item->medicine['price'] * $item->quantity;
            }

            $order->doctor_id=$order->pharmacy->doctors->random()->id;
            $order->total = $total;
            //$order->delivery_address = $order->user->address->governorate['name'] . ' ' . $order->user->address->city . ' ' . $order->user->address->street ;
            $order->delivery_address = fake()->address();
            $order->save();
        }

    }
}
