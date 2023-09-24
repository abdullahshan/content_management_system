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

/*loutout Api user*/ 
public function logout(){

    return auth('sanctum')->user()->currentAccessToken()->delete();
}
}
