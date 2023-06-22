<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class UserAuthenticationController extends Controller
{


    public function loginUser(Request $request) {

        $credentials = $request->validate([
            'email' => 'required|email',
             'password' => 'required',
        ]);

        $email = $request->email;
        $password = $request->password;

        if (Auth::attempt(['email' => $email, 'password' => $password, 'status' => '1'])) {
            $request->session()->regenerate();

            return redirect('/dashboard');
        }else {
            return redirect()->to('/')->with('auth_error', 'Invalid Email Or Password');
        }

    }



    //Funtion to logout users
    public function logOutUser(Request $request)
    {
        try {

            $loggedInUser = User::findOrFail(Auth::user()->id);
            $loggedInUser->save();

            auth()->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return response()->json(['success' => true, 'message' => 'Successfully Logged Out A User'], 200);
        }catch(\Exception $e) {

        }
    }


    public function activateUser($id) {

        $user = User::select('id', 'status')->where('id', $id)->first();
        $user->status = 1;
        $user->save();

        return response()->json(['success' => true, 'message' => 'Successfully Activated User'], 200);

    }


    public function deActivateUser($id) {
        $user = User::select('id', 'status')->where('id', $id)->first();
        $user->status = 0;
        $user->save();

        return response()->json(['success' => true, 'message' => 'Successfully DeActivated User'], 200);

    }
}
