<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Medicine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cart = Auth::user()->cart;
        return view('site.cart.index', compact('cart'));
    }

    public function add(Request $request)
    {

        $medicine = Medicine::where('id', $request->medicine_id)->firstOrFail();
        $cart = Cart::where('user_id', Auth::user()->id)->first();
        if (!$cart) $cart = Cart::create(['user_id' => Auth::user()->id]);
        $cart->add($medicine);

        return redirect()->back()->with(['success' => 'Medicine added to cart successfully!']);
    }

    public function remove(Request $request)
    {
        $medicine = Medicine::where('id', $request->medicine_id)->firstOrFail();
        $cart = Cart::where('user_id', Auth::user()->id)->first();
        $cart->remove($medicine);
        return redirect()->back();
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

    public function sub_totals()
    {
        $cart = Cart::where('user_id', Auth::user()->id)->first();
        return $cart->sub_totals();
    }
}
