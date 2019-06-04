<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use DB;

class MembersController extends Controller
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
        $members = User::paginate(5);
        return view('members.all')->with('members',$members);
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $member = User::find($id);
        $member->delete();
        return redirect()->back()->with('success','Item has been deleted successfully');
    }

    public function activate(Request $request, $id)
    {
        $cat = User::find($id);
        $cat->active = '1';
        $cat->save();
        return redirect('/members')->with('success', 'Item has been activated successfully');
    }

    public function inActivate(Request $request, $id)
    {
        $cat = User::find($id);
        $cat->active = '0';
        $cat->save();
        return redirect('/members')->with('success', 'Item has been inActivated successfully');
    }

    public function search(Request $request)
    {
        $members =DB::table('users')
        ->Where('name','like','%'.$request->input('search').'%')
        ->select('users.*')
        ->paginate(5);
        return view('members.search')->with(['members'=>$members]);
        
    }
}
