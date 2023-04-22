<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe;
use Stripe\Charge;
use Stripe\Checkout\Session;
use App\Models\Order;


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

        public function stripePost(Request $request)
        {
            Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
            Stripe\Charge::create([
                'amount' => 100*100,
                'currency' => 'usd',
                'source' => $request->stripeToken,
                'description' => 'test payment from mostafa',
            ]);
            Session::flash('sucess', 'payment successfully');
            return back();
        }
    }
