<?php

namespace App\Http\Controllers\AdminCtrls;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Categories;
use Auth;
use Illuminate\Support\Facades\DB;

 

class CategoriesController extends Controller
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
        
        $cats =DB::table('categories')
        ->join('admins', 'categories.admin_id', '=', 'admins.id')
        ->select('categories.*', 'admins.name as admin_name')
        ->paginate(5);
        return view('categories.all')->with(['cats'=>$cats]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.add');
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
            'category'=>'required|min:2|unique:categories,cat_name',
            'description'=>'required|min:5',
        ]);

        $cat = new Categories;
        $cat->cat_name = $request->input('category');
        $cat->description= $request->input('description');
        $cat->admin_id =  Auth::user()->id;
        $cat->save();
        return redirect('admin/categories')->with('success', 'Item has been added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cat =DB::table('categories')
        ->join('admins', 'categories.admin_id', '=', 'admins.id')
        ->select('categories.*', 'admins.name as admin_name')
        ->where('categories.id', $id)
        ->first();
        return view('categories.show')->with('cat',$cat);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cat = Categories::find($id);
        if(Auth::user()->id === $cat->admin_id || Auth::user()->super_admin === 1 ){
            return view('categories.edit')->with('cat',$cat);
        }else {
            return redirect('/admin/categories')->with('error', 'This action for owner or Super admin only');
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

        $cat = Categories::find($id);
        if(Auth::user()->id === $cat->admin_id || Auth::user()->super_admin === 1 ){
            $this->validate($request, [
                'category'=>'required|min:2|unique:categories,cat_name,'.$id,
                'description'=>'required|min:5',
            ]);
    
            $cat->cat_name = $request->input('category');
            $cat->description= $request->input('description');
            $cat->admin_id = Auth::user()->id;
            $cat->save();
            return redirect('/admin/categories')->with('success', 'Item has been updated successfully');
        }else {
            return redirect('/admin/categories')->with('error', 'This action for owner or Super admin only');
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
        $cat = Categories::find($id);
        if(Auth::user()->id === $cat->admin_id || Auth::user()->super_admin === 1 ){
            $cat->delete();
            return redirect('admin/categories')->with('success', 'Item has been deleted successfully');
        }else {
            return redirect('/admin/categories')->with('error', 'This action for owner or Super admin only');
        }
    }


    public function activate(Request $request, $id)
    {
        $cat = Categories::find($id);
        if(Auth::user()->id === $cat->admin_id || Auth::user()->super_admin === 1 ){
            $cat->active = '1';
            $cat->save();
            return redirect('admin/categories')->with('success', 'Item has been activated successfully');
        }else {
            return redirect('/admin/categories')->with('error', 'This action for owner or Super admin only');
        }
    }

    public function inActivate(Request $request, $id)
    {
        $cat = Categories::find($id);
        if(Auth::user()->id === $cat->admin_id || Auth::user()->super_admin === 1 ){
            $cat->active = '0';
            $cat->save();
            return redirect('admin/categories')->with('success', 'Item has been inActivated successfully');
        }else {
            return redirect('/admin/categories')->with('error', 'This action for owner or Super admin only');
        }
    }

    public function search(Request $request)
    {
        $cats =DB::table('categories')
        ->join('admins', 'categories.admin_id', '=', 'admins.id')
        ->Where('cat_name','like','%'.$request->input('search').'%')
        ->select('categories.*', 'admins.name as admin_name')
        ->paginate(5);
        return view('categories.search')->with(['cats'=>$cats]);
        
    }
}
