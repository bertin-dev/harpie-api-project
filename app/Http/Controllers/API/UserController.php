<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\validator;
use Auth;
use DB;

class UserController extends Controller
{
    //creating a user
    public function register(Request $request):JsonResponse

    {
        //Data validation
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $input = $request->all();

        //encrypting password before storing
        $input['password'] = bcrypt($input['password']);

        //creating the user or saving the user
        $user = User::create($input);
        $success['token'] = $user->createToken('MyApp')->accessToken;
        $success['user'] = $user;

        return $this->sendResponse($success, 'User created successfully.');


    }
  
    //connecting a user or login a user
    public function login(Request $request):JsonResponse

    {
       
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $user = Auth::user();
            $success['token'] = $user->createToken('MyApp')->accessToken;
            $success['user'] = $user;
            
            return $this->sendResponse($success, 'User login successfully.');

        }else{
            return $this->sendError('Unauthorised.',['error'=>'Invalid login details']);
        }
    }

    //
     public function profile(){
              $user = Auth::user();

              return response()->json([
                  "status" => true,
                  "message" => "Profile information",
                  "data" => $user
              ]);
     } 

     // disconnecting a user
     public function logout(){
        auth()->user()->token()->revoke();

        return response()->json([
            "status" => true,
            "message" => "User Logged out"
        ]);
     }

     public function updateUser(Request $request)
     {
           //Data validation
           $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
           
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $user = Auth::user();
        $email = $user->email;


        try {

            DB::table('users')->where('email', $email)->update([
                'name' => $request->name ?? $user->name,
                'email' => $request->email ?? $user->email
                
            ]);

            return response()->json([
                "status" => true,
                'message' => 'User account updated successfully'
            ]);  
            
        }catch (Exception $exception) {
            return response()->json([
                "Message" => $exception->getMessage()
               
            ], 401);

     }
  }

}
