<?php

namespace App\Http\Controllers\AdminCtrls;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use DB;
use Auth;

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
        $user = User::find($id);
        return view('members.show')->with('user',$user);
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
        if( Auth::user()->super_admin === 1 ){
            $member->delete();
            return redirect()->back()->with('success','Item has been deleted successfully');
        }else {
            return redirect('/admin/members')->with('error', 'This action for Super admin only');
        }
    }

    public function activate(Request $request, $id)
    {
        $member = User::find($id);
        if( Auth::user()->super_admin === 1 ){

            $member->active = '1';
            $member->save();
            return redirect('admin/members')->with('success', 'Item has been activated successfully');
        }else {
            return redirect('/admin/members')->with('error', 'This action for Super admin only');
        }
    }

    public function inActivate(Request $request, $id)
    {
        $member = User::find($id);
        if( Auth::user()->super_admin === 1 ){

            $member->active = '0';
            $member->save();
            return redirect('admin/members')->with('success', 'Item has been inActivated successfully');
        }else {
            return redirect('/admin/members')->with('error', 'This action for Super admin only');
        }
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
