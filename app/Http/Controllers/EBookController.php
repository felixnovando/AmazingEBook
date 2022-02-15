<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\EBook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
//Created By 2301859543 – Felix Novando – LD01

class EBookController extends Controller
{
    public function home(){
        UserController::setLang();
        //ambil yang belum di delete
        $ebooks = EBook::all();
        return view('pages.home', compact('ebooks'));
    }

    public function detail($id){
        UserController::setLang();
        $ebook = EBook::where('ebook_id', '=', $id)->first();

        //cek apakah di cart
        $cart = Cart::where("ebook_id", "=", $id)
            ->where("user_id", "=", Auth::user()->id)
            ->first();
        return view('pages.detail', compact('ebook', 'cart'));
    }
}
