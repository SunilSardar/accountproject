<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Record;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class TodayReportController extends Controller
{
  
    public function onedayreport(Request $request)
    {
   $posts = Record::orderBy('id','DESC')
                  ->where('date',$request['date'])
                  ->get();
   
    return response()->json($posts);

    }
  
}
