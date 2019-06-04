<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cart;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        return view('front.cart',['cart'=>Cart::content()]);
    }

    public function add_to_cart(Request $request){
        $qty = $request->qty;
        $data['qty'] = $qty;
        $data['id'] = $request->input('id');
        $data['name'] = $request->input('name');
        $data['weight'] = null;
        $data['price'] = $request->input('price');
        $data['options']['image'] = $request->input('image');
        Cart::add($data);
        return redirect('/cart');
    }

    public function update_cart(Request $request,$rowId){
        $qty = $request->qty;
        Cart::update($rowId, $qty);
        return redirect('/cart');
    }

    public function delete_cart($rowId){
        Cart::remove($rowId);
        return redirect('/cart');
    }
    public function clear_cart(){
        Cart::destroy();
        return redirect('/cart');
    }
}
