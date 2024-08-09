<?php

namespace App\Http\Controllers;

use App\Models\AdditionalFee;
use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Cart::where('user_id', Auth::id())->with('event')->get();
        $total = $cartItems->sum(function($cartItem) {
            $price = $cartItem->event->price ;
            if ($cartItem->event->sponsorship_title && $cartItem->event->fundraising_target) {
                $price = $cartItem->event->sponsorship_target - ($cartItem->event->price * $cartItem->event->quota);
            }

            return $price * $cartItem->quantity;
        });


        $quantity = $cartItems->sum('quantity');
       
        $tax = 0; // Misalnya nilai pajak

        $additionalFee = null;
        if (count($cartItems) > 0) {
            $additionalFee = AdditionalFee::where('id', $cartItems[0]->event->additional_fee_id)->first();
            if ($additionalFee) {
                $tax = $additionalFee->fee; // Misalnya nilai pajak
                $serviceCharge = 0; // Misalnya nilai service charge
            }
        }

        if ($tax) {
            $total += $total * $tax / 100;
        }

        $snapToken = null;

        return view('cart', compact('cartItems', 'total', 'snapToken', 'additionalFee'));
    }

    public function addToCart(Request $request, $eventId)
    {
        $cart = Cart::firstOrNew(
            ['user_id' => Auth::id(), 'event_id' => $eventId]
        );

        if ($cart->exists) {
            $cart->quantity = DB::raw('quantity + 1');
        } else {
            $cart->quantity = 1;
        }

        $cart->save();

        flash()->flash('success', 'Product added to cart');
        return redirect()->route('cart.index');
    }

    public function updateQuantity(Request $request, $cartItemId)
    {
        $cartItem = Cart::find($cartItemId);
        $cartItem->quantity = $request->quantity;
        $cartItem->save();

        return response()->json(['success' => true, 'quantity' => $cartItem->quantity]);
    }

    public function removeFromCart($cartId)
    {
        Cart::destroy($cartId);
        flash()->flash('success', 'Product removed from cart');
        return redirect()->route('cart.index');
    }
}
