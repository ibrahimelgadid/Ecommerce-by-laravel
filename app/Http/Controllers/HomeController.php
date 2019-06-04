<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $cats = DB::table('categories')->orderBy('created_at', 'DESC')->get();
        $brands = DB::table('brands')->orderBy('created_at', 'DESC')->get();
        $products = DB::table('products')->orderBy('created_at', 'DESC')->paginate(10);
        return view('front.index')->with(['cats'=>$cats,'brands'=>$brands,'products'=>$products]);
    }

    public function search(Request $request)
    {
        $products =DB::table('products')
        ->Where('name','like','%'.$request->input('search').'%')
        ->select('products.*')
        ->paginate(5);
        $cats = DB::table('categories')->orderBy('created_at', 'DESC')->get();
        $brands = DB::table('brands')->orderBy('created_at', 'DESC')->get();
        return view('front.index')->with(['cats'=>$cats,'brands'=>$brands,'products'=>$products]);
    }

    public function show($id){
        $product =DB::table('products')
        ->join('admins', 'products.product_user', '=', 'admins.id')
        ->join('categories', 'products.cat_id', '=', 'categories.id')
        ->join('brands', 'products.brand_id', '=', 'brands.id')
        ->where('products.id',$id)
        ->select(
                'products.*', 'admins.name as admin_name',
                'categories.cat_name as cat_name',
                'brands.brand_name as brand_name'
            )
        ->first();

        $gallary = DB::table('gallaries')
            ->where('gallary_product', $id)
            ->get();
        return view('front.details')->with(['product'=>$product,'gallary'=>$gallary]);
    }

    public function getProByCat($id){
        $products =DB::table('products')
        ->join('admins', 'products.product_user', '=', 'admins.id')
        ->join('categories', 'products.cat_id', '=', 'categories.id')
        ->join('brands', 'products.brand_id', '=', 'brands.id')
        ->where('categories.id',$id)
        ->select(
                'products.*', 'admins.name as admin_name',
                'categories.cat_name as cat_name',
                'brands.brand_name as brand_name'
            )
        ->paginate(10);
        $cats = DB::table('categories')->get();
        $brands = DB::table('brands')->get();
        return view('front.ProCategory')->with(['products'=>$products,'cats'=>$cats,'brands'=>$brands]);
    }

    public function getProByBrand($id){
        $products =DB::table('products')
        ->join('admins', 'products.product_user', '=', 'admins.id')
        ->join('categories', 'products.cat_id', '=', 'categories.id')
        ->join('brands', 'products.brand_id', '=', 'brands.id')
        ->where('brands.id',$id)
        ->select(
                'products.*', 'admins.name as admin_name',
                'categories.cat_name as cat_name',
                'brands.brand_name as brand_name'
            )
        ->paginate(10);
        $cats = DB::table('categories')->get();
        $brands = DB::table('brands')->get();
        return view('front.ProBrand')->with(['products'=>$products,'cats'=>$cats,'brands'=>$brands]);
    }

    public function orders(){
        $orderDetails = DB::table('order_details')
        ->where('user', auth()->user()->id)
        ->get();

        return view('front.orders')->with(['orderDetails'=>$orderDetails]);
    }
}
