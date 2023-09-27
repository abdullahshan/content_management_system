<?php

namespace App\Http\Controllers\api\v1;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function registar(Request $request)
    {
        
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $password = Hash::make($request->password);
        $user->password = Hash::make($password);
        $user->type = "user";
        $user->save();

        $token = $user->createToken(config('app.name'))->plainTextToken;

        return response()->json([
            'user' => $user, 
            'token'   => $token,
        ], 201);
       
}


/*Login User*/ 
public function loginUser(Request $request)
{
    try {
        $validateUser = Validator::make($request->all(), 
        [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if($validateUser->fails()){
            return response()->json([
                'status' => false,
                'message' => 'validation error',
                'errors' => $validateUser->errors()
            ], 401);
        }

        if(!Auth::attempt($request->only(['email', 'password']))){
            return response()->json([
                'status' => false,
                'message' => 'Email & Password does not match with our record.',
            ], 401);
        }

        $user = User::where('email', $request->email)->first();

        return response()->json([
            'status' => true,
            'message' => 'User Logged In Successfully',
            'token' => $user->createToken("API TOKEN")->plainTextToken
        ], 200);

    } catch (\Throwable $th) {
        return response()->json([
            'status' => false,
            'message' => $th->getMessage()
        ], 500);
    }
}

/*loutout Api user*/ 
public function logout(){

    return auth('sanctum')->user()->currentAccessToken()->delete();
}
}
