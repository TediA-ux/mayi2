<?php

namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Directors;
use App\Models\FamilyMembers;
use \Exception as Exception;
use Illuminate\Support\Facades\Password;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Mail\SendMailreset;
// use Validator;
//use DB;
use Illuminate\Support\Facades\DB;
use App\Mail\TestEmail;
use Illuminate\Support\Facades\Mail;

use Illuminate\Support\Facades\Validator;
use Hash;
use SoapClient;
use SoapHeader;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return response()->json($users, 200);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email|unique:users,email',
            'contact'=> 'required',
            'password' => 'required|string|min:5',
            'role'=> 'required',
        ]);

        if($validator->fails()) return response()->json($validator->errors(), 400);
        try {
                $users = User::create([
                    'firstname'=>$request->firstname,
                    'lastname'=>$request->lastname,
                    'email'=>$request->email,
                    'contact'=>$request->contact,
                    'password' => bcrypt($request->password),
                    
                    'role' => $request->role,
                    //'created_by'=> optional(Auth::user())->id,
                    //'updated_by'=> optional(Auth::user())->id,
                ]);
                return response()->json([
                    'message' => "User created successfully.",
                    'firstname'=>$request->firstname,
                    'lastname'=>$request->lastname,
                    'email'=>$request->email,
                    'contact'=>$request->contact,
                    'password' => bcrypt($request->password),
                   
                    'role'=>$request->role,


                ], 200);

            } catch (Exception $e) {
                    return response()->json(['message' => $e->getMessage()], 500);
            } 

      

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        if (!empty($user)) {

            /*
                * Create Soap Client for Checking the balance of the account
            */
            $checkBalClient = new SoapClient(public_path().'/USERAPI.wsdl', [
                'trace' => 1,
                'cache_wsdl' => WSDL_CACHE_NONE,
                'exception' => 0,
                'soap_version' => SOAP_1_2,
                'local_cert' => public_path().'/yourcert.pem',
                'passphrase' => '123456',
                "stream_context" => stream_context_create(
                    array(
                        'ssl' => array( 
                            'verify_peer_name'  => false,
                            'allow_self_signed'=> true,
                            'local_cert' => public_path().'/yourcert.pem',
                            "passphrase" => '123456',
                            'ssl_method' => SOAP_SSL_METHOD_SSLv3,
                        )
                    )),
                'soapaction' => 'http://tempuri.org/IUSERAPI/CheckBal',
                'https' => array(
                    'curl_verify_ssl_peer'  => true,
                    'curl_verify_ssl_host'  => true
                ),
            ]);

            $headers = [
                new SoapHeader('http://www.w3.org/2005/08/addressing', 'Action', 'http://tempuri.org/IUSERAPI/CheckBal', false),
                new SoapHeader('http://www.w3.org/2005/08/addressing', 'To', 'https://ug.ezeemoney.biz/EZB2BCPApi/USERAPI.svc', false),
            ];

            $checkBalClient->__setSoapHeaders($headers);

            $requestParams = array();

            $requestParams['CP_CODE'] = 'ZOEMINISTRIES';
            $requestParams['CP_USERID'] = 'ZoeUserAB';
            $requestParams['CP_PASSWORD'] = 'Npyicp7Na@CYK_tdaAMt';
            $requestParams['CP_TXNID'] = str_pad(rand(0, pow(10, 10)-1), 32, '0', STR_PAD_LEFT);
            $requestParams['EZ_ACCOUNT_NO'] = $user->ez_account_no;

            $response = $checkBalClient->__soapCall('CheckBal', array('parameters' => ['request' => $requestParams]));

            if($response->CheckBalResult->EZ_RESP_CODE != 0)
            {
                return response([
                    'user' => $user,
                    'messsage' => $response->CheckBalResult->EZ_RESP_MSG
                ]);
            }

            $user->balance = $response->CheckBalResult->EZ_ACCOUNT_BAL;
            $user->save();

            return response()->json($user, 200);
        } else {
            return response()->json(["message" => "User Not Found!"], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)   
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   
        $user = User::find($id);
        if(!$user) return response()->json(["message" => "User Not Found!"], 404);

        $validator = Validator::make($request->all(),[
            'accountholdername' => 'required|max:255',
            'email' => 'required|email|unique:users,email,'.$id,
            'contact' => 'required',
            'address' => 'required',
            'nin' => 'required',
            'dob' => 'required',
            'group' => 'required',
            'section' => 'required',
            'gender' => 'required',
        ]);

        if($validator->fails()) return response()->json($validator->errors(), 200);
        try {
            $user->update([
                'accountholdername' => $request->accountholdername,
                'email' => $request->email,
                'contact' => $request->contact,
                'address' => $request->address,
                'nin' => $request->nin,
                'dob' => $request->dob,
                'group' => $request->group,
                'section' => $request->section,
                'gender' => $request->gender,
            ]);

            return response()->json([
                'message'=> 'User Edited',
                'accountholdername' => $request->accountholdername,
                'email' => $request->email,
                'contact' => $request->contact,
                'address' => $request->address,
                'nin' => $request->nin,
                'dob' => $request->dob,
                'group' => $request->group,
                'section' => $request->section,
                'gender' => $request->gender,
            ], 200);

        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        if (!empty($user)) {
            $user->delete();
            return response()->json(['success' => 'Successfully deleted user.'], 200);
        } else {
            return response()->json(["message" => "User Not Found!"], 404);
        }

    }

    public function profile()
    {
        // $roles = Auth::user()->roles()->first();
        // $user_role = $roles->name;
        $user_id = Auth::user()->id;

        /*
            * Create Soap Client for Checking the balance of the account
        */
        $checkBalClient = new SoapClient(public_path().'/USERAPI.wsdl', [
            'trace' => 1,
            'cache_wsdl' => WSDL_CACHE_NONE,
            'exception' => 0,
            'soap_version' => SOAP_1_2,
            'local_cert' => public_path().'/yourcert.pem',
            'passphrase' => '123456',
            "stream_context" => stream_context_create(
                array(
                    'ssl' => array( 
                        'verify_peer_name'  => false,
                        'allow_self_signed'=> true,
                        'local_cert' => public_path().'/yourcert.pem',
                        "passphrase" => '123456',
                        'ssl_method' => SOAP_SSL_METHOD_SSLv3,
                    )
                )),
            'soapaction' => 'http://tempuri.org/IUSERAPI/CheckBal',
            'https' => array(
                'curl_verify_ssl_peer'  => true,
                'curl_verify_ssl_host'  => true
            ),
        ]);

        $headers = [
            new SoapHeader('http://www.w3.org/2005/08/addressing', 'Action', 'http://tempuri.org/IUSERAPI/CheckBal', false),
            new SoapHeader('http://www.w3.org/2005/08/addressing', 'To', 'https://ug.ezeemoney.biz/EZB2BCPApi/USERAPI.svc', false),
        ];

        $checkBalClient->__setSoapHeaders($headers);

        $requestParams = array();

        $requestParams['CP_CODE'] = 'ZOEMINISTRIES';
        $requestParams['CP_USERID'] = 'ZoeUserAB';
        $requestParams['CP_PASSWORD'] = 'Npyicp7Na@CYK_tdaAMt';
        $requestParams['CP_TXNID'] = str_pad(rand(0, pow(10, 10)-1), 32, '0', STR_PAD_LEFT);
        $requestParams['EZ_ACCOUNT_NO'] = Auth::user()->ez_account_no;

        $response = $checkBalClient->__soapCall('CheckBal', array('parameters' => ['request' => $requestParams]));

       
        Auth::user()->balance = $response->CheckBalResult->EZ_ACCOUNT_BAL;
        Auth::user()->save();


        $user = User::find($user_id);
        //$users = User::all();
        

        //return $role;
        //return view('profile.index',compact('user_role','log_user'));
        return response()->json($user, 200);
    }

    public function otherMembers(){
        $user_id = Auth::user()->id;
        $user = User::find($user_id);

        if($user->role == 'Family'){
            $members = FamilyMembers::where("user_id", $user->id)->get();
            return response()->json($members, 200);

        }elseif($user->role == 'Company'){
            $directors = Directors::where("companyid", $user->id)->get();
            return response()->json($directors, 200);

        }
    }

    public function password(Request $request){

        $request->validate([
    
    
            'password' => ['required'],
    
            //'new_confirm_password' => ['same:new_password'],
    
    
        ]);
    
        $id = Auth::user()->id;
    
    
    
        User::find($id)->update(['password'=> bcrypt($request->password)]);
        //$user -> password = bcrypt($request->new_password);
        return response()->json(['success','Password Changed successfully.'], 200);
    
    }

    public function forgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required',
    
        ]);
    
     
            // Look up the user associated with the phone number
        $user = User::where('email', $request->email)->first();

        if($user != null){
                $data = ['message' => 'This is a test!'];

                Mail::send($user->email, $data);

                return response()->json(['message' => 'success'],200);
        } else {
            return response()->json(['message' => 'failed'],500);
        }
        

        // Return a success response to the Flutter app
        

    }  

    public function editProfile(Request $request){


        $id = Auth::user()->id;
        $user = User::find($id);
       

        if(!$user) return response()->json(["message" => "User Not Found!"], 404);

        $data = $request->validate([
            'accountholdername' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'contact' => 'required',
            'address' => 'required',
            'nin' => 'required',
            'dob' => 'required',
            'group' => 'required',
            'section' => 'required',
            'gender' => 'required',
        ]);

     
            $user->update($data);


            return response()->json(['message' => "User edited successfully.",$user], 200);

      
    }

    public function updateUser(Request $request, $id)
    {   
        $user = User::find($id);
        if(!$user) return response()->json(["message" => "User Not Found!"], 404);

        $validator = Validator::make($request->all(),[
            'accountholdername' => 'required|max:255',
            'email' => 'required|email|unique:users,email,'.$id,
            'contact' => 'required',
            'address' => 'required',
            'nin' => 'required',
            'dob' => 'required',
            'group' => 'required',
            'section' => 'required',
            'gender' => 'required',
        ]);

        if($validator->fails()) return response()->json($validator->errors(), 200);
        try {
            $user->update([
                'accountholdername' => $request->accountholdername,
                'email' => $request->email,
                'contact' => $request->contact,
                'address' => $request->address,
                'nin' => $request->nin,
                'dob' => $request->dob,
                'group' => $request->group,
                'section' => $request->section,
                'gender' => $request->gender,
            ]);

            return response()->json([
                'message'=> 'Profile Edited',
                'accountholdername' => $request->accountholdername,
                'email' => $request->email,
                'contact' => $request->contact,
                'address' => $request->address,
                'nin' => $request->nin,
                'dob' => $request->dob,
                'group' => $request->group,
                'section' => $request->section,
                'gender' => $request->gender,
            ], 200);

        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }

    }

    

}
