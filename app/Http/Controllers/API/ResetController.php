<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\validator;
use Illuminate\Support\Facades\Hash;
use Auth;
use DB;



class ResetController extends Controller
{
    public function resetpassword(Request $request)
    {
        //Data validation
        $validator = Validator::make($request->all(), [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed'

        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $email = $request->email;
        $token = $request->token;
        $password = Hash::make($request->password);

        $emailCheck = DB::table('password_reset_tokens')->where('email', $email)->first();
        $pinCheck = DB::table('password_reset_tokens')->where('token', $token)->first();

        if(!$emailCheck){
            return response([
                'message'=>'Email Not Found'
            ], 401);
        }
        if(!$pinCheck){
            return response([
                'message'=>'Pin Code Invalid'
            ], 401);
        }


        //update the user pass
        DB::table('users')->where('email', $email)->update(['password' => $password]);
        DB::table('password_reset_tokens')->where('email', $email)->delete();

        return response([
            'message'=>'Password Reset successfully'
        ], 200);
         

    }// end method
}
