<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Company;
use Spatie\Permission\Models\Role;
use App\Models\Department;
use Illuminate\Support\Facades\Crypt;
use DB;
use Hash;
use Spatie\Permission\Models\Permission;

class RegistrationController extends Controller
{
    public function companycode(){
        // return ('register.index');

        return redirect()->route('register');
    }
    public function CheckCode(Request $request){
       //return $request->code;
 //validate company code
        $validatedData = $request->validate([
            'code' => 'required|exists:companies,code',

        ], [
            'code.required' => 'Code is required.'

        ]);


        //return redirect('/company/codes/'.Crypt::encrypt($request->code));

        return redirect()->route('/company/codes/');


    }

    public function GetCode($id){

        //$id = Crypt::decrypt($id);
        //get company as per code entered
        $company = Company::where('code', $id)->first();
        $departments = Department::where('companyid', $company->id)->orderBy('id','DESC')->get();

        //$input['companyid'] = Company::where('companyid', $company->id);
         return response()->json(["company"=>$company, "departments"=>$departments], 200);
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
            'password' => 'required|string',
            'companyid' => 'required',
            'role' => 'required',
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
        
        

        // $role = Role::where('name', 'Client-Staff')->first();

        // $user->assignRole([$role->id]);


        return response()->json(["success" => 'Your Account has been Created and will be Approved soon'],200);

    }

    public function get_authorizer($id){

        $authorizers = DB::table('users')->select(DB::raw('CONCAT(firstname, " ", lastname) AS name'),'id')->where('role','Authorizer')->where('department_id', $id)->get();


        return json_encode($authorizers);

    }

   


}
