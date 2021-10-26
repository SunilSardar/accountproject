<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Record;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class CreditDebitController extends Controller
{
    public function debitandcredit(Request $request)
    {
     $record = new Record;
     // dd($request);
      // dd($request->total_amount);
     
    $date= Carbon::now();
    $record->customer_id = $request->customer_id;
    $record->transaction_id = $request->transaction_id;
    $record->transaction_amount = $request->transaction_amount;
     if($request->total_amount != ""){
         $total_amount = $request->total_amount;
         // dd($request->total_amount,$request->transaction_amount);
         $remain_amount = $request->total_amount-$request->transaction_amount;
      }
      else{
         $total_amount = 0;
         $remain_amount = 0;
      }
    $record->total_amount = $total_amount;

    $record->remain_amount  = $remain_amount;
    $record->description = $request->description;
    $record->created_by = Auth::user()->id;
    $record->customer_code = strtotime(date(("Y-m-d H:i:s")));//customer_code will generate automatic with recent time wise
    // $user->phone_no = $request->phone_no;
    // $record->date =$date->toDateString();
    $record->date = $request->date;
    $record->time = date("H:i:s");
    // $user->user_type = 3;
    // $user->created_type = '1';
    // var_dump($request->name,$request->class);
    $record->save();

    return response()->json([[
        "message" => "Data Inserted"
    ]], 201);
    }

    //for debited
     public function debited(Request $request)
    {
     $debitrecord = new Record;
     // dd($request);
      // dd($request->total_amount);
     
    $date= Carbon::now();
    $debitrecord->customer_id = $request->customer_id;
    $debitrecord->transaction_id = $request->transaction_id;
    $debitrecord->transaction_amount = $request->transaction_amount;

    $total_amount = 0;
    $remain_amount = 0;
    $debitrecord->total_amount = $total_amount;
    $debitrecord->remain_amount  = $remain_amount;
    $debitrecord->description = $request->description;
    $debitrecord->created_by = Auth::user()->id;
    $debitrecord->customer_code = strtotime(date(("Y-m-d H:i:s")));//customer_code will generate automatic with recent time wise
    // $user->phone_no = $request->phone_no;
    // $record->date =$date->toDateString();
    $debitrecord->date = $request->date;
    $debitrecord->time = date("H:i:s");
    // $user->user_type = 3;
    // $user->created_type = '1';
    // var_dump($request->name,$request->class);
    $debitrecord->save();

    return response()->json([[
        "message" => "Data Inserted"
    ]], 201);
    }
}
