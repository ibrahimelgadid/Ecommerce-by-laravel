<?php

namespace App\Http\Controllers\AdminCtrls;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Brands;
use Auth;
use DB;

class BrandsController extends Controller
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
        
        $brands =DB::table('brands')
        ->join('admins', 'brands.admin_id', '=', 'admins.id')
        ->select('brands.*', 'admins.name as admin_name')
        ->paginate(5);
        return view('brands.all')->with(['brands'=>$brands]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('brands.add');
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
            'brand'=>'required|min:2|unique:brands,brand_name',
            'description'=>'required|min:5',
        ]);

        $brand = new brands;
        $brand->brand_name = $request->input('brand');
        $brand->description= $request->input('description');
        $brand->admin_id =  Auth::user()->id;
        $brand->save();
        return redirect('admin/brands')->with('success', 'Item has been added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $brand = brands::find($id);
        $brand =DB::table('brands')
        ->join('admins', 'brands.admin_id', '=', 'admins.id')
        ->select('brands.*', 'admins.name as admin_name')
        ->where('brands.id', $id)
        ->first();
        return view('brands.show')->with('brand',$brand);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $brand = brands::find($id);
        if(Auth::user()->id === $brand->admin_id || Auth::user()->super_admin === 1 ){
            return view('brands.edit')->with('brand',$brand);
        }else {
            return redirect('/admin/brands')->with('error', 'This action for owner or Super admin only');
        }
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
        if(Auth::user()->id === $brand->admin_id || Auth::user()->super_admin === 1 ){
            $this->validate($request, [
                'brand'=>'required|min:2|unique:brands,brand_name,'.$id,
                'description'=>'required|min:5',
                ]);
            
            $brand = brands::find($id);
            $brand->brand_name = $request->input('brand');
            $brand->description= $request->input('description');
            $brand->admin_id = Auth::user()->id;
            $brand->save();
            return redirect('admin/brands')->with('success', 'Item has been updated successfully');
        }else {
            return redirect('/admin/brands')->with('error', 'This action for owner or Super admin only');
        }
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $brand = brands::find($id);
        if(Auth::user()->id === $brand->admin_id || Auth::user()->super_admin === 1 ){
            $brand->delete();
            return redirect('admin/brands')->with('success', 'Item has been deleted successfully');
        }else {
            return redirect('/admin/brands')->with('error', 'This action for owner or Super admin only');
        }
    }


    public function activate(Request $request, $id)
    {
        $brand = brands::find($id);
        if(Auth::user()->id === $brand->admin_id || Auth::user()->super_admin === 1 ){
            $brand->active = '1';
            $brand->save();
            return redirect('admin/brands')->with('success', 'Item has been activated successfully');
        }else {
            return redirect('/admin/brands')->with('error', 'This action for owner or Super admin only');
        }
        
    }

    public function inActivate(Request $request, $id)
    {
        $brand = brands::find($id);
        if(Auth::user()->id === $brand->admin_id || Auth::user()->super_admin === 1 ){
            $brand->active = '0';
            $brand->save();
            return redirect('admin/brands')->with('success', 'Item has been inActivated successfully');
        }else {
            return redirect('/admin/brands')->with('error', 'This action for owner or Super admin only');
        }
        
    }

    public function search(Request $request)
    {
        $brands =DB::table('brands')
        ->join('admins', 'brands.admin_id', '=', 'admins.id')
        ->Where('brand_name','like','%'.$request->input('search').'%')
        ->select('brands.*', 'admins.name as admin_name')
        ->paginate(5);
        return view('brands.search')->with(['brands'=>$brands]);
        
    }
    // public function forSuperAdmin($route)
    // {
    //     if(Auth::user()->id === $brand->admin_id || Auth::user()->super_admin === 1 ){
    //         return true;
    //     }else {
    //         return redirect('/admin/'.$route)->with('error', 'This action for owner or Super admin only');
    //     }
    // }
}
