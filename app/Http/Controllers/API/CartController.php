<?php

namespace App\Http\Controllers\Api;

use App\Models\Cart;
use App\Models\Medicine;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cart = Auth::user()->cart->with('items');
        return compact('cart');
    }

    public function add(Request $request)
    {
        $medicine = Medicine::where('id', $request->medicine_id)->firstOrFail();
        $cart = Cart::where('user_id', Auth::user()->id)->first();
        $cart->add($medicine);

        return ['success' => 'Medicine added to cart successfully!'];
    }

    public function remove(Request $request)
    {
        $medicine = Medicine::where('id', $request->medicine_id)->firstOrFail();
        $cart = Cart::where('user_id', Auth::user()->id)->first();
        $cart->remove($medicine);
        return ['success' => 'Medicine removed to cart successfully!'];
    }

    public function increase(Request $request)
    {
        $medicine = Medicine::where('id', $request->medicine_id)->firstOrFail();
        $cart = Cart::where('user_id', Auth::user()->id)->first();
        $cart->increase($medicine);
        return ['success' => 'quantity increased'];
    }

    public function decrease(Request $request)
    {
        $medicine = Medicine::where('id', $request->medicine_id)->firstOrFail();
        $cart = Cart::where('user_id', Auth::user()->id)->first();
        $cart->decrease($medicine);
        return ['success' => 'quantity decreased'];
    }

    public function empty()
    {
        $cart = Cart::where('user_id', Auth::user()->id)->first();
        $cart->empty();
        return ['success' => 'cart destroyed'];
    }
}
