<?php

namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;

use Illuminate\Support\Facades\validator;
use Auth;
use DB;
use Mail;
use App\Mail\ForgetMail;

class ForgetController extends Controller
{
    //
    public function forgetpassword(Request $request):JsonResponse
    {
        $validator = Validator::make($request->all(), [

            'email' => 'required|email',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $email = $request->email;

        if(User::where('email', $email)->doesntExist()){
            return response()->json([
                "Message" => "Invalide Email"
               
            ], 401);
        }
        $token = rand(10, 100000);
        try {
            DB::table('password_reset_tokens')->insert([
                'email' => $email,
                'token' =>$token
            ]);

            Mail::to($email)->send(new ForgetMail($token));

            return response()->json([
                "Message" => "Reset Password Mail send on your mail"
               
            ], 200);

            
        } catch (Exception $exception) {
            return response()->json([
                "Message" => $exception->getMessage()
               
            ], 401);
        }

       

    }
}
