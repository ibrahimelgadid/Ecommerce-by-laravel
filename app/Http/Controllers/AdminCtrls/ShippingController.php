<?php

namespace App\Http\Controllers\AdminCtrls;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Shipping;
use App\C_order;
use App\Order_details;
use Cart;
use Srmklive\PayPal\Services\ExpressCheckout;

class ShippingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }




    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $shipping = Shipping::where('id',$id)->first();
        return view('orders.editShipping', ['shipping'=>$shipping]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name'=>'required|min:2|unique:shippings,name,'.$id,
            'email'=>'required|email',
            'mobile'=>'required',
            'address'=>'required',
            'city'=>'required',
            'payment_method'=>'required',
            ]);
            
        $shipping = Shipping::find($id);
        $shipping->name = $request->input('name');
        $shipping->email= $request->input('email');
        $shipping->mobile= $request->input('mobile');
        $shipping->address= $request->input('address');
        $shipping->city= $request->input('city');
        $shipping->payment_method= $request->input('payment_method');
        $shipping->save();
        return redirect('admin/orders/'.$shipping->id)->with('success', 'Item has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $shipping = Shipping::find($id);
        $shipping->delete();
        return redirect()->back()->with('success','Item has been deleted successfully');
    }


//     public function paypal()
//     {
//         $provider = new ExpressCheckout; 
//         $data = [];
//         $data['items'] = [];

//         foreach (Cart::content() as $cart) {
//             $cartItems = [
//                 'name' => $cart->name,
//                 'price' =>  $cart->price,
//                 'qty' =>  $cart->qty
//             ];
//             $data['items'][]=$cartItems;
//         }

//         $data['invoice_id'] = uniqid();
//         $data['invoice_description'] = "Order #{$data['invoice_id']} Invoice";
//         $data['return_url'] = url('/cart');
//         $data['cancel_url'] = url('/cart');

//         $total = 0;
//         foreach($data['items'] as $item) {
//             $total += $item['price']*$item['qty'];
//         }

//         $data['total'] = $total;

//         //give a discount of 10% of the order amount
//         // $data['shipping_discount'] = round((10 / 100) * $total, 2);
//         $response = $provider->setExpressCheckout($data);

//         // This will redirect user to PayPal
//         return redirect($response['paypal_link']);
//     }
}
