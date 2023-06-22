<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Validator;

class UserAuthController extends Controller
{
    
    public function register(Request $request)
    {
        $data = $request->validate([
            'accountholdername' => 'required|max:255',
            'accountnumber' => 'required|accountnumber|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
            
        ]);

        $data['password'] = bcrypt($request->password);
        $data['usertype'] = 'individual';
        $data['status'] = '1';

        $user = User::create($data);

        $token = $user->createToken('authToken')->accessToken;

        return response([ 'user' => $user, 'token' => $token]);
    }

    /**
      * 
      * Login api
      * @return \Illuminate\Http\Response
      */


    public function login(Request $request)
    {

        $loginData = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        if (!auth()->attempt($loginData)) {
            return response(['message' => 'Incorrect Details. Please try again']);
        } 
    
        $token = auth()->user()->createToken('authToken')->accessToken;

        return response(['user' => auth()->user(), 'token' => $token]);
  
        
    }
}
