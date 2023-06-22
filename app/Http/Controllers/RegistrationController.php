<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Department;
use App\Models\User;
use DB;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Spatie\Permission\Models\Role;

class RegistrationController extends Controller
{
    public function companycode()
    {
        return view('register.index');
    }
    public function CheckCode(Request $request)
    {
        //return $request->code;
        //validate company code
        $validatedData = $request->validate([
            'code' => 'required|exists:companies,code',

        ], [
            'code.required' => 'Code is required.',

        ]);

        return redirect('/company/codes/' . Crypt::encrypt($request->code));

    }

    public function GetCode($id)
    {

        $id = Crypt::decrypt($id);

        //get company as per code entered
        $company = Company::where('code', $id)->first();
        $departments = Department::where('companyid', $company->id)->orderBy('id', 'DESC')->get();

        return view('register.register', compact('company', 'departments'));
    }

    public function postUser(Request $request)
    {

        $validatedData = $request->validate([

            'firstname' => 'required',
            'lastname' => 'required',
            'contact' => 'required',
            'department_id' => 'required',
            'authorizer' => 'required',
            'email' => 'required|email|unique:users,email,',
            'password' => 'required|same:confirm-password',
        ], [
            'firstname.required' => 'First Name field is required.',
            'last.required' => 'Last Name field is required.',
            'contact.required' => 'Phone Contact field is required.',
            'email.required' => 'Email field is required.',
            'email.email' => 'Email field must be email address.',
            'password.required' => 'Password field is required.',

        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        $user = User::create($input);

        $role = Role::where('name', 'Client-Staff')->first();

        $user->assignRole([$role->id]);

        return redirect('/')->with('success', 'Your Account has been Created and will be Approved soon');

    }

    public function get_authorizer($id)
    {

        $authorizers = DB::table('users')->select(DB::raw('CONCAT(firstname, " ", lastname) AS name'), 'id')->where('role', 'Authorizer')->where('department_id', $id)->pluck('name', 'id');

        return json_encode($authorizers);

    }

    public function passReset()
    {
        return view('reset');
    }

}
