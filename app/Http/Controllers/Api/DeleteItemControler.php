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


class DeleteItemControler extends Controller
{ 
    
   //delete items from cart lists
    public function deleteItems (Request $request) {

       $user_id = User::find($request->id);
      
         //delete all the records of that user from record table while deleting that user
       $record=Record::where('customer_id',$request['id'])->delete();

       if ($user_id->delete()||$record) {
            return response()->json([[
          "message" => "records deleted"
        ]], 202);
    
        }
        else{
           return response()->json([[
          "message" => "records not found"
        ]], 404);
        }
     }
}
