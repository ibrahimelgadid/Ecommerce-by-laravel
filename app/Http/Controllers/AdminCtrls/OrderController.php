<?php

namespace App\Http\Controllers\AdminCtrls;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\C_order;
use App\Shipping;
use App\Order_details;
use DB;
class OrderController extends Controller
{

    public function __construct(){
        $this->middleware('auth:admin');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = DB::table('c_orders')
        ->join('users','c_orders.user', '=', 'users.id')
        ->join('shippings','c_orders.shipping', '=', 'shippings.id')
        ->select('c_orders.*', 'users.name as creator'
        ,'shippings.payment_method')
        ->paginate(10);
        return view('orders.all', ['orders'=>$orders]);
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = DB::table('c_orders')
        ->join('users','c_orders.user', '=', 'users.id')
        ->join('shippings','c_orders.shipping', '=', 'shippings.id')
        ->select('c_orders.*', 'users.name as creator'
        ,'shippings.payment_method')
        ->where('shippings.id', $id)
        ->first();

        $shipping_id = $order->shipping;
        $order_id = $order->id;

        $shipping = DB::table('shippings')
        ->where('id', $shipping_id)
        ->first();

        $orderDetails = DB::table('order_details')
        ->where('order_id', $order_id)
        ->get();

        return view('orders.show', [
            'order'=>$order,
            'shipping'=>$shipping,
            'orderDetails'=>$orderDetails,
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order = Order_details::where('id',$id)->first();
        return view('orders.editOrder', ['order'=>$order]);
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
            'qty'=>'required',
            ]);
            
        $order = Order_details::find($id);
        $c = C_order::where('id', $order->order_id)->first();
        $shipping = Shipping::where('id', $c->id)->first();
        $order->product_qty= $request->input('qty');
        $order->save();
        return redirect('admin/order/show/'.$shipping->id)->with('success', 'Order has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order_details::find($id);
        $order->delete();
        return redirect()->back()->with('success','Item has been deleted successfully');
    }

    public function activate(Request $request, $id)
    {
        $order = C_order::find($id);
        $order->active = '1';
        $order->save();
        return redirect('admin/orders')->with('success', 'Item has been activated successfully');
    }

    public function done(Request $request, $id)
    {
        $order = C_order::find($id);
        $order->status = '1';
        $order->save();
        return redirect('admin/orders')->with('success', 'Order has been finished');
    }

    public function inActivate(Request $request, $id)
    {
        $order = C_order::find($id);
        $order->active = '0';
        $order->save();
        return redirect('admin/orders')->with('success', 'Item has been inActivated successfully');
    }

    public function search(Request $request)
    {
        $orders =DB::table('c_orders')
        ->join('users','c_orders.user', '=', 'users.id')
        ->join('shippings','c_orders.shipping', '=', 'shippings.id')
        ->select('c_orders.*', 'users.name as creator'
        ,'shippings.payment_method')
        ->Where('users.name','like','%'.$request->input('search').'%')
        ->paginate(5);
        return view('orders.search')->with(['orders'=>$orders]);
        
    }
}
