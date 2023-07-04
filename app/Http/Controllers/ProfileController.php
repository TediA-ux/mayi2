<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $roles = Auth::user()->roles()->first();
        $user_role = $roles->name;
        $user_id = Auth::user()->id;
        $log_user = User::find($user_id);

        //return $role;
        return view('profile.index',compact('user_role','log_user'));
    }

    public function update(Request $request){

        //return $request->firstname;
        $id = $user_id = Auth::user()->id;



        $validatedData = $request->validate([
            'name' => 'required',
            'contact' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
        ], [
            'name.required' => 'First Name field is required.',
            'contact.required' => 'Phone Contact field is required.',
            'email.required' => 'Email field is required.',
            'email.email' => 'Email field must be email address.'
        ]);



        $user = User::find($id);
        $user->name = $request->name;
        $user->contact = $request->contact;
        $user->email = $request->email;
        $user->save();

        return back()->with('success', 'Profile Updated successfully.');



    }

    public function password(Request $request){

    $request->validate([


        'new_password' => ['required'],

        'new_confirm_password' => ['same:new_password'],


    ]);

    $id = $user_id = Auth::user()->id;



    User::find($id)->update(['password'=> Hash::make($request->new_confirm_password)]);
    return back()->with(['success' => 'Password Changed successfully.','tab' => 'Password']);

}



}
