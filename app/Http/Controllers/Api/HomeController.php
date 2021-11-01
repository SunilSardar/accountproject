<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Record;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function token(){
        return csrf_token();
    }

    public function login(Request $request)
    {
        // var_dump("expression"); die();
        $email = $request->email;
        $password = $request->password;
        if(Auth::attempt(['email'=>$email,'password'=>$password], true)){ //is_active->1 wala hatae diye
            return response()->json(['success'=>true,'message'=>'Successfully logged in','user'=>Auth::user()]);
        }
        else{
           return response()->json(['success'=>false,'message'=>'Invalid username or password']);
        }
    }

     //sign up
public function sign_up(Request $request) {
    // dd("here");
    $todayDate= Carbon::now();
    $user = new User;
    $user->name = $request->name;
    $user->email = $request->email;
    $user->phone = $request->phone;
    $user->address = $request->address;
    $user->type_id = $request->type_id;
    $user->customer_code = strtotime(date(("Y-m-d H:i:s")));//customer_code will generate automatic with recent time wise
    // $user->phone_no = $request->phone_no;
    $user->date =$todayDate->toDateString();
    // $user->user_type = 3;
    //$user->created_type = '1';
    // var_dump($request->name,$request->class);
    $user->save();

    return response()->json([[
        "message" => "user record created"
    ]], 201);
  }

    //credit
public function credit(Request $request) {
    
    //$todayDate= Carbon::now();
    $user = new User;
    $user->name = $request->name;
    $user->email = Hash::make($user->name);
    $user->password = 'Null';
    // $user->type_id = '1';
    // $user->phone_no = $request->phone_no;
    // $user->date_np =$todayDate->toDateString();
    // $user->time_np = date("H:i:s");
    // $user->user_type = 3;
    // $user->created_type = '1';
    // var_dump($request->name,$request->class);
    $user->save();


    $record = new Record;
    $record->customer_id = $user->id;
    $record->credit_amount = $request->credit_amount;
    $record->receive_amount = '0';
    $record->rem_amount = '0';
    $record->created_by = Auth::user()->id;
    $record->description = $request->description;
    $record->date = $request->date;
    $record->type_id = '1';

    $record->save();

    return response()->json([[
        "message" => "user record created"
    ]], 201);
  }

    //credit
public function debit(Request $request) {
    // dd('thik xa')
    
    // $todayDate= Carbon::now();
    $user = new User;
    $user->name = $request->name;
    $user->email = Hash::make($user->name);
    $user->password = 'Null';
    // $user->phone_no = $request->phone_no;
    // $user->date_np =$todayDate->toDateString();
    // $user->time_np = date("H:i:s");
    // $user->user_type = 3;
    // $user->created_type = '1';
    // var_dump($request->name,$request->class);
    $user->save();


    $record = new Record;
    $record->customer_id = $user->id;
    $record->credit_amount = $request->credit_amount;
    $record->receive_amount = '0';
    $record->rem_amount = '0';
    $record->created_by = Auth::user()->id;
    $record->description = $request->description;
    $record->date = $request->date;
    $record->type_id = '2';

    $record->save();

    return response()->json([[
        "message" => "user record created"
    ]], 201);
  }
  
}
