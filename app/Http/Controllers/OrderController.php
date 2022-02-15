<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
//Created By 2301859543 – Felix Novando – LD01

class OrderController extends Controller
{
    public function displayOrderHistory(){
        UserController::setLang();
        $orders = Order::where("user_id", "=", Auth::user()->id)
            ->orderBy("order_id", "desc")
            ->get();
        return view('pages.historyOrder',compact('orders'));
    }

    public function order(Request $request){
        UserController::setLang();
        $user_id = Auth::user()->id;
        $carts = Cart::where("user_id", "=", $user_id)->get();

        if(count($carts) == 0){
            return redirect()->back();
        }

        foreach ($carts as $cart){
            $order = new Order([
                'user_id' => $user_id,
                'ebook_id' => $cart->ebook_id,
                'order_date' => now()
            ]);
            $order->save();

            Cart::where("user_id", "=", $user_id)
                ->where("ebook_id", "=", $cart->ebook_id)
                ->delete();
        }


        Session::put('message',trans("Success!"));
        return redirect('/successPage');
    }
}
