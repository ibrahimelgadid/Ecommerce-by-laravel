<?php

namespace App\Http\Controllers\UserCtrls;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Shipping;
use App\C_order;
use App\Order_details;
use Cart;
use Srmklive\PayPal\Services\ExpressCheckout;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function thank()
    {
        return view('front.thank');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function checkout(Request $request)
    {
        $this->validate($request, [
            'name'=>'required|min:2',
            'email'=>'required|email',
            'mobile'=>'required',
            'address'=>'required',
            'city'=>'required',
            'payment_method'=>'required',
        ]);
        $shipping = new Shipping;
        $shipping->name = $request->input('name');
        $shipping->email = $request->input('email');
        $shipping->mobile = $request->input('mobile');
        $shipping->address = $request->input('address');
        $shipping->city = $request->input('city');
        $shipping->payment_method = $request->input('payment_method');
        $shipping->save();

        $order = new C_order;
        $order->user = auth()->user()->id;
        $order->shipping= $shipping->id;
        $order->total = $request->input('total');
        $order->save();

        $cartContent = Cart::content();
        foreach ($cartContent as $pro) {
            $details = new Order_details;
            $details->order_id = $order->id;
            $details->user= auth()->user()->id;
            $details->product = $pro->id;
            $details->product_price = $pro->price;
            $details->product_name = $pro->name;
            $details->product_qty = $pro->qty;
            $details->save();
        }

        $cartContent = Cart::destroy();
        
        return redirect('/thank')->with('success', 'Item has been added successfully');
    }


    public function paypal()
    {
        $provider = new ExpressCheckout; 
        $data = [];
        $data['items'] = [];

        foreach (Cart::content() as $cart) {
            $cartItems = [
                'name' => $cart->name,
                'price' =>  $cart->price,
                'qty' =>  $cart->qty
            ];
            $data['items'][]=$cartItems;
        }

        $data['invoice_id'] = uniqid();
        $data['invoice_description'] = "Order #{$data['invoice_id']} Invoice";
        $data['return_url'] = url('/cart');
        $data['cancel_url'] = url('/cart');

        $total = 0;
        foreach($data['items'] as $item) {
            $total += $item['price']*$item['qty'];
        }

        $data['total'] = $total;

        //give a discount of 10% of the order amount
        // $data['shipping_discount'] = round((10 / 100) * $total, 2);
        $response = $provider->setExpressCheckout($data);

        // This will redirect user to PayPal
        return redirect($response['paypal_link']);
    }
}
