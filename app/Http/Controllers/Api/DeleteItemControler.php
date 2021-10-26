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

       $item_id = User::find($request->id);

       if ($item_id->delete()) {
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
