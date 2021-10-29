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
    

    return response()->json($posts);

    }
}
