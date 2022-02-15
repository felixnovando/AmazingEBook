<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
//Created By 2301859543 – Felix Novando – LD01

class CartController extends Controller
{
    public function deleteCart(Request $request){
        UserController::setLang();
        $user_id = Auth::user()->id;
        $ebook_id = $request->ebook_id;

        Cart::where("user_id", "=", $user_id)
            ->where("ebook_id", "=", $ebook_id)
            ->delete();

        return redirect()->back();
    }

    public function getCartPage(){
        UserController::setLang();
        $carts = Cart::where("user_id", "=", Auth::user()->id)->get();
        return view('pages.cart', compact('carts'));
    }

    public function addCart(Request $request){
        UserController::setLang();
        $user_id = Auth::user()->id;
        $ebook_id = $request->id;

        $cart = Cart::where("user_id", "=", $user_id)
            ->where("ebook_id", "=", $ebook_id)
            ->get();

        if(is_null($cart)){
            return redirect()->back();
        }

        $cart = new Cart([
            "user_id" => $user_id ,
            "ebook_id" => $ebook_id
        ]);

        $cart->save();

        return redirect('/cart');
    }
}
