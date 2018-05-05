<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\User;
use Hash;


class PasswordController extends Controller
{
    //
    public function index(){

    	return view('auth.passwords.passwordchange');
    }

    public function update(Request $request){

    	$password    = Auth::user()->password;
    	$oldpassword = $request->oldpassword;

    	if(Hash::check($oldpassword,$password)){

    		$user           = User::find(Auth::id());
    		$user->password = Hash::make($request->password);
    		$user->save();
    		Auth::logout();
    		return Redirect()->route('login')->with('successMsg','Successfullt your password change. please login');
    	}
    	else{

    		return Redirect()->back()->with('errorMsg','Your oldpassword is wrong');
    	}
    }
}
