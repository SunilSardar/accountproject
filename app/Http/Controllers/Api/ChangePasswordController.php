<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Record;
use Auth;
use App\Rules\MatchOldPassword;
use App\Rules\PasswordField;
use Illuminate\Support\Facades\Hash;
use Validator;
Use Exception;


class ChangePasswordController extends Controller
{ 
    

public function changePasswords(PasswordField $request){

    // dd(1);
       
       $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_password_confirmation' => ['same:new_password'],
        ]);
        if ((Hash::check(request('old_password'), Auth::user()->password)) == false) {
                $arr = array("status" => 400, "message" => "Check your old password.", "data" => array());
            }
        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);
        Auth::logout();
         return response()->json([['success'=>true,'message'=>'Password Changed']]);
 }
}