<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Record;
use Illuminate\Support\Facades\Hash;

class RecordController extends Controller
{
    public function getcustomers(Request $request)
    {

      $posts = User::orderBy('id','DESC')
                  ->where('id','!=','1')
                  ->where('type_id','!=','3');
    
      //for pagination
      $take = 15;
      $page = intval(request('page',0));
      $start = $page * $take;

      // for search filter
    $search = request("search",'');
    if(trim($search)!=""){
      $posts->where('name','LIKE',"%$search%");
    }

   $posts = $posts->skip($start)->take($take)//for pagination
                  ->get();
    
   // $rem_amt=100;

    return response()->json($posts);

    }
     public function getdealers(Request $request)
    {
      $posts = User::orderBy('id','DESC')
                  ->where('id','!=','1')
                  ->where('type_id','!=','2');

       //for pagination
      $take = 15;
      $page = intval(request('page',0));
      $start = $page * $take;

        // for search filter
    $search = request("search",'');
    if(trim($search)!=""){
      $posts->where('name','LIKE',"%$search%");
    }

   $posts = $posts->skip($start)->take($take)//for pagination
                  ->get();

    return response()->json($posts);

    }

     public function get_records(Request $request)
    {
      $posts = Record::orderBy('id','DESC')
              ->where('customer_id',$request['customer_id']);
   
      $take = 15;
      $page = intval(request('page',0));
      $start = $page * $take;

      $posts = $posts->skip($start)->take($take)//for pagination
                  ->get();

<<<<<<< HEAD
    //for pagination
      // $take = 15;
      // $page = intval(request('page',0));
      // $start = $page * $take;
      
      // $posts = $posts->skip($start)->take($take)//for pagination
      //             ->get();              
=======
//backend ma calculate garera android ma pathauna
      $cal_value='0';
      $transc_amt='0';
      $total_amt='0';

      $data = Record::orderBy('id','DESC')
                ->where('customer_id',$request['customer_id'])->get();
>>>>>>> 4bd0c1d0bf1b40935bffe6fbfc69698255cc86d2
   
        foreach ($data as $key => $value) {
                  $transc_amt+=$value->transaction_amount;
                  $total_amt+=$value->total_amount;
                  $cal_value=$total_amt-$transc_amt;


                  if ($total_amt>$transc_amt) {
                    $receive=$cal_value;
                    $pay='0';
                  }
                  else {
                    $pay=$cal_value;
                    $receive='0';
                  }   
                // return response()->json($cal_value);
            }
    
            $response = [
            'posts' => $posts,
            'receive' => $receive,
            'pay' => $pay,
            ];
        return response()->json($response);
          


    }
}
