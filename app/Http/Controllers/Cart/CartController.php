<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\BaseController;
use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends BaseController
{

    public function index()
    {
        return view('frontend.cart.index');
    }
    public function add(Request $request,$uuid)
    {
        // dd($uuid);
        return view('frontend.cart.index');
    }
   
}
