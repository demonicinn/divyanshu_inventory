<?php

namespace App\Http\Controllers\Ab;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    //profile
    public function index()
    {
        $user = auth()->user();
        return view('ab.profile.index', compact('user'));
    }

    //profile update
    public function update(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'fname' => 'required|string|max:100',
            'lname' => 'required|string|max:100',
            'email' => 'required|email|max:100|unique:users,email,'.$user->id,
		]);

        
        $user->fname = $request->fname;
        $user->lname = $request->lname;
        $user->email = $request->email;
        $user->save();

        $request->session()->flash('success', "Profile updated successfully");
        return redirect()->back();
    }



    //Profile Password
    public function password()
    {
        return view('ab.profile.change-password');
    }

    //Change Password
    public function changePassword(Request $request)
    {
        $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|string|min:6',
            'new-password_confirmed' => 'required|same:new-password',
        ]);
        $user = auth()->user();

		if (!(Hash::check($request->get('current-password'), $user->password))) {
            // The passwords matches
			$request->session()->flash('error', "Your current password does not matches with the password you provided. Please try again.");
			return redirect()->back();
        }
 
        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
            //Current password and new password are same
			$request->session()->flash('warning', "New Password cannot be same as your current password. Please choose a different password.");
			return redirect()->back();
        }        
 
        //Change Password
        $user->password = Hash::make($request->get('new-password'));
        $user->save();
 
		$request->session()->flash('success', "Password changed successfully");
        return redirect()->back();
    }
}
