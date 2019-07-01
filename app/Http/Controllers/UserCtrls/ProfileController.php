<?php

namespace App\Http\Controllers\UserCtrls;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Hash;
use Auth;
use Storage;

class ProfileController extends Controller
{


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $profile = User::find($id);
        return view('front.profile')->with('profile',$profile);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $profile = User::find($id);
        return view('front.editProfile')->with('profile',$profile);
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
            'name'=>'required|min:2|unique:users,name,'.$id,
            'userAvatar'=>'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'email'=>'required|email',
            'facebook'=>'url|nullable',
            'twitter'=>'url|nullable',
            'youtube'=>'url|nullable',
            'bio'=>'min:5|nullable',
            'password' => 'string|min:1|confirmed|nullable'
            ]);
        
        $user = User::find($id);
        $user->name = $request->input('name');
        $user->email= $request->input('email');
        $user->facebook = $request->input('facebook');
        $user->twitter = $request->input('twitter');
        $user->youtube = $request->input('youtube');
        $user->bio = $request->input('bio');
        if($request->input('password')){
            $user->password = Hash::make($request->input('password'));
        }else {
            $user->password = $request->input('oldpassword');
        }
        if($request->hasFile('userAvatar')){
            if($user->userAvatar != 'public/image/users/noimage.png'){

                Storage::delete($user->userAvatar);
            }
            $user->userAvatar = $request->file('userAvatar')->store('public/image/users');
        }else {
            $user->userAvatar = $request->input('olduserAvatar');
        }
        // return $user;
        $user->save();
        return redirect('profile/'.Auth::user()->id)->with('success', 'Profile has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
