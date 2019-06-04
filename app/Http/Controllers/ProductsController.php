<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use File;
use Storage;

use App\Products;
use App\Gallaries;

class ProductsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products =DB::table('products')
        ->join('admins', 'products.product_user', '=', 'admins.id')
        ->select('products.*', 'admins.name as admin_name')
        ->paginate(5);
        return view('products.all')->with(['products'=>$products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brands =DB::table('brands')->get();
        $cats =DB::table('categories')->get();
        return view('products.add')->with(['cats'=>$cats,'brands'=>$brands]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'product'=>'required|min:2|unique:products,name',
            'description'=>'required|min:5',
            'color'=>'required',
            'size'=>'required',
            'price'=>'required',
            'category'=>'required',
            'brand'=>'required',
            'image'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $product = new Products;
        $product->name = $request->input('product');
        $product->color = $request->input('color');
        $product->size = $request->input('size');
        $product->price = $request->input('price');
        $product->product_user = auth()->user()->id;
        $product->cat_id= $request->input('category');
        $product->brand_id = $request->input('brand');
        $product->description= $request->input('description');

        $fileExt =  $request->file('image')->getClientOriginalExtension();
        
        $filenameWext = $request->file('image')->getClientOriginalName();
        $filename = pathinfo($filenameWext, PATHINFO_FILENAME);
        
        $filenameToStore = $filename.'_'.time().'.'.$fileExt;

        $product->image = $request->file('image')->storeAs('public/image', $filenameToStore);
        
        $product->save();
        return redirect('/products')->with('success', 'Item has been added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
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
        return view('products.show')->with(['product'=>$product,'gallary'=>$gallary]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Products::find($id);
        $brands =DB::table('brands')->get();
        $cats =DB::table('categories')->get();
        return view('products.edit')
        ->with(['cats'=>$cats,'brands'=>$brands,'product'=>$product]);
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
        'product'=>'required|min:2|unique:products,name,'.$id,
        'description'=>'required|min:5',
        'color'=>'required',
        'size'=>'required',
        'price'=>'required',
        'category'=>'required',
        'brand'=>'required',
        'image'=>'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $product = Products::find($id);
        $product->name = $request->input('product');
        $product->color = $request->input('color');
        $product->size = $request->input('size');
        $product->price = $request->input('price');
        $product->product_user = auth()->user()->id;
        $product->cat_id= $request->input('category');
        $product->brand_id = $request->input('brand');
        $product->description= $request->input('description');

        if($request->has('image')){
            Storage::delete($request->input('oldImg'));
            $fileExt =  $request->file('image')->getClientOriginalExtension();
            
            $filenameWext = $request->file('image')->getClientOriginalName();
            $filename = pathinfo($filenameWext, PATHINFO_FILENAME);
            
            $filenameToStore = $filename.'_'.time().'.'.$fileExt;
    
            $product->image = $request->file('image')->storeAs('public/image', $filenameToStore);
        }else{
            $product->image = $request->input('oldImg');
        }

        $product->save();
        return redirect('/products')->with('success', 'Item has been Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cat = Products::find($id);
        Storage::delete($cat->image);
        $cat->delete();
        return redirect('/products')->with('success', 'Item has been deleted successfully');
    }


    public function activate(Request $request, $id)
    {
        $cat = Products::find($id);
        $cat->active = '1';
        $cat->save();
        return redirect('/products')->with('success', 'Item has been activated successfully');
    }

    public function inActivate(Request $request, $id)
    {
        $product = Products::find($id);
        $product->active = '0';
        $product->save();
        return redirect('/products')->with('success', 'Item has been inActivated successfully');
    }


    public function upload_images(Request $request, $id)
    {
        $product = Products::find($id);
        $gallary = new Gallaries;
        $this->validate($request, [
            'file'=>'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
    
        $gallary->gallary_product = $product->id;
        $fileExt =  $request->file('file')->getClientOriginalExtension();
        
        $filenameWext = $request->file('file')->getClientOriginalName();
        $filename = pathinfo($filenameWext, PATHINFO_FILENAME);
        
        $filenameToStore = $filename.'_'.time().'.'.$fileExt;

        $gallary->image = $request->file('file')->storeAs('public/image/'.$product->id, $filenameToStore);
        $gallary->save();
        return redirect('/products')->with('success', 'Gallary has been Uploaded successfully');
    }


    public function deleteGallaryImage($id){
        $gallary = Gallaries::find($id);
        Storage::delete($gallary->image);
        $gallary->delete();
        return redirect()->back()->with('success', 'Image has been Deleted successfully');
    }

    public function deleteGallary($id){
        $product = Products::find($id);
        Storage::deleteDirectory('public/image/'.$product->id);
        $gallaries = Gallaries::where('gallary_product', $id);
        $gallaries->delete();
        return redirect()->back()->with('success', 'Image has been Cleared successfully');
    }

    
    public function search(Request $request)
    {
        $products =DB::table('products')
        ->join('admins', 'products.product_user', '=', 'admins.id')
        ->join('categories', 'products.cat_id', '=', 'categories.id')
        ->join('brands', 'products.brand_id', '=', 'brands.id')
        ->Where('products.name','like','%'.$request->input('search').'%')
        ->select(
                'products.*', 'admins.name as admin_name',
                'categories.cat_name as cat_name',
                'brands.brand_name as brand_name'
            )->paginate(5);
        return view('products.search')->with(['products'=>$products]);
        
    }
}