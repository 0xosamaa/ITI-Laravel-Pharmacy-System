<?php

namespace App\Http\Controllers;
use Stripe\Charge;
use App\Models\Order;
use Illuminate\Http\Request;
use Stripe\Checkout\Session;

use Stripe\Customer;
use Stripe\Exception\ApiErrorException;
use Stripe\Stripe;




class StripeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

        public function stripe()
        {
            return view('admin.stripe');
            }

        // public function stripePost(Request $request)
        // {
        //     try {
        //         Stripe::setApiKey(env('STRIPE_SECRET'));

        //         $token = $request->stripeToken;

        //         $customer = Customer::create([
        //             'email' => $request->email,
        //             'source' => $token,
        //         ]);

        //         $charge = Charge::create([
        //             'amount' => 1000,
        //             'currency' => 'usd',
        //             'description' => 'Test charge',
        //             'customer' => $customer->id,
        //             'metadata' => ['order_id' => '1234'],
        //         ]);

        //         // Save the order to the database
        //         $order = new Order();
        //         $order->user_id = auth()->user()->id;
        //         $order->amount = $charge->amount;
        //         $order->payment_gateway = 'Stripe';
        //         $order->transaction_id = $charge->id;
        //         $order->save();

        //         return redirect()->back()->with('success_message', 'Payment successful!');
        //     } catch (ApiErrorException $e) {
        //         return redirect()->back()->with('error_message', 'Payment failed: ' . $e->getMessage());
        //     }
        // }
        public function stripePost(Request $request)
        {
            try {
                Stripe::setApiKey(env('STRIPE_SECRET'));

                $token = $request->stripeToken;

                $charge = Charge::create([
                    'amount' => 100000,
                    'currency' => 'usd',
                    'description' => 'Test charge',
                    'source' => $token,
                    'metadata' => ['order_id' => '1234'],
                ]);
                return redirect()->back()->with('success_message', 'Payment successful!');
            } catch (ApiErrorException $e) {
                return redirect()->back()->with('error_message', 'Payment failed: ' . $e->getMessage());
            }
        }

    }
