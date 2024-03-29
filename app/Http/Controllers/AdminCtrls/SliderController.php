<?php

namespace App\Http\Controllers\AdminCtrls;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Slider;
use DB;
use Storage;
use Auth;

class SliderController extends Controller
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
        $sliders = DB::table('sliders')
        ->join('admins', 'sliders.admin_id', '=', 'admins.id')
        ->select('sliders.*', 'admins.name as admin_name')
        ->paginate(10);
        return view('sliders.all', ['sliders'=>$sliders]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sliders.add');
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
            'slider'=>'required|min:2|unique:sliders,name',
            'description'=>'required|min:5',
            'image'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $slider = new Slider;
        $slider->name = $request->input('slider');
        $slider->admin_id = auth()->user()->id;
        $slider->description= $request->input('description');

        $fileExt =  $request->file('image')->getClientOriginalExtension();
        
        $filenameWext = $request->file('image')->getClientOriginalName();
        $filename = pathinfo($filenameWext, PATHINFO_FILENAME);
        
        $filenameToStore = $filename.'_'.time().'.'.$fileExt;

        $slider->image = $request->file('image')->storeAs('public/image/sliders', $filenameToStore);
        
        $slider->save();
        return redirect('admin/sliders')->with('success', 'Item has been added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

        /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $slider = Slider::find($id);
        if(Auth::user()->id === $slider->admin_id || Auth::user()->super_admin === 1 ){

            Storage::delete($slider->image);
            $slider->delete();
            return redirect()->back()->with('success','Item has been deleted successfully');
        }else {
            return redirect('/admin/sliders')->with('error', 'This action for owner or Super admin only');
        }
    }

    public function activate(Request $request, $id)
    {
        $slider = Slider::find($id);
        if(Auth::user()->id === $slider->admin_id || Auth::user()->super_admin === 1 ){

            $slider->active = '1';
            $slider->save();
            return redirect('admin/sliders')->with('success', 'Item has been activated successfully');
        }else {
            return redirect('/admin/sliders')->with('error', 'This action for owner or Super admin only');
        }
    }

    public function inActivate(Request $request, $id)
    {
        $slider = Slider::find($id);
        if(Auth::user()->id === $slider->admin_id || Auth::user()->super_admin === 1 ){

            $slider->active = '0';
            $slider->save();
            return redirect('admin/sliders')->with('success', 'Item has been inActivated successfully');
        }else {
            return redirect('/admin/sliders')->with('error', 'This action for owner or Super admin only');
        }
    }

    public function search(Request $request)
    {
        $sliders =DB::table('sliders')
        ->Where('name','like','%'.$request->input('search').'%')
        ->select('sliders.*')
        ->paginate(5);
        return view('sliders.search')->with(['sliders'=>$sliders]);
        
    }
}
