<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\user;
use Illuminate\Foundation\Auth\User as AuthUser;
use Illuminate\Support\Facades\Hash;
use Psy\Readline\Userland;

class userController extends Controller
{
   
    /*User */ 

public function user(){


    $users = User::all();

    return view('backend.user.index',compact('users'));

}


/*user */ 
public function user_van($id){

    $data = user::find($id);

    if( $data->van == '1'){

        $data->van = "0";
    }elseif( $data->van == '0'){
        $data->van = '1';
    }

    $data->save();

    return back();

}

/*user delete */ 
public function user_delete($id){

    $data = user::find($id);
    $data->delete();
    
    return back();

}

/*user cretate */ 
public function user_update ($id){

        $data = User::find($id);
   
        return view('backend.user.update',compact('data'));

}

/*User Update*/ 
public function update_store(Request $request, $id){

        $data = User::find($id);

        $data->name = $request->name;
        $data->email = $request->email;
        if($request->password){

            $pas = Hash::make($request->password);
            $data->password = $pas;
        }

        $data->save();

        return redirect()->route('user');

}

}
