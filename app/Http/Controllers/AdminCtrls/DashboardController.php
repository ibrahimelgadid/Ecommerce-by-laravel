<?php

namespace App\Http\Controllers\AdminCtrls;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\User;

class DashboardController extends Controller
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
        //members
        $AllMembers = DB::table('users')->get();
        $PendingMembers = DB::table('users')->where('active', 0)->get();
        $ActiveMembers = DB::table('users')->where('active', 1)->get();

        //categories
        $AllCategories = DB::table('categories')->get();
        $PendingCategories = DB::table('categories')->where('active', 0)->get();
        $ActiveCategories = DB::table('categories')->where('active', 1)->get();

        //brands
        $AllBrands = DB::table('brands')->get();
        $PendingBrands = DB::table('brands')->where('active', 0)->get();
        $ActiveBrands = DB::table('brands')->where('active', 1)->get();
        
        return view('admin.dashboard')->with([
            'members'=>$AllMembers,
            'Pmembers'=>$PendingMembers,
            'Amembers'=>$ActiveMembers,

            'categories'=>$AllCategories,
            'Pcategories'=>$PendingCategories,
            'Acategories'=>$ActiveCategories,

            'brands'=>$AllBrands,
            'Pbrands'=>$PendingBrands,
            'Abrands'=>$ActiveBrands,
        ]);
    }
    
    public function activeMembers(){
        $members = User::where('active', 1)->paginate(5);
        return view('members.active')->with('members',$members);
    }

    public function pendingMembers(){
        $members = User::where('active', 0)->paginate(5);
        return view('members.pending')->with('members',$members);
    }
}
