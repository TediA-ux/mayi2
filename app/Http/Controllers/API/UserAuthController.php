<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Directors;
use App\Models\FamilyMembers;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\API;
use RicorocksDigitalAgency\Soap\Facades\Soap;
//use Illuminate\Support\Facades\Validator;
use Validator;
use SoapClient;
use SoapHeader;


class UserAuthController extends Controller
{

    public function register(Request $request)
    {
        $data = $request->validate([
            'accountholdername' => 'required|max:255',
            'cardnumber' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'contact' => 'required',
            'address' => 'required',
            'nin' => 'required',
            'dob' => 'required',
            'password' => 'required',
            'card_pin' => 'required',
            'group' => 'required',
            'section' => 'required',
            'gender' => 'required',
        ]);

        $data['password'] = bcrypt($request->password);
        $data['usertype'] = 'individual';
        $data['status'] = '1';
        $data['role'] = 'Client';
        $role = Role::where('name', 'Client')->first();

        $user = User::create($data);
        $user->assignRole([$role->id]);

        $token = $user->createToken('authToken')->accessToken;

        /*
            * Create Soap Client for registering an EzeeLink account
        */
        $registerClient = new SoapClient(public_path().'/USERAPI.wsdl', [
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
            'soapaction' => 'http://tempuri.org/IUSERAPI/Register',
            'https' => array(
                'curl_verify_ssl_peer'  => true,
                'curl_verify_ssl_host'  => true
            ),
        ]);

        $headers = [
            new SoapHeader('http://www.w3.org/2005/08/addressing', 'Action', 'http://tempuri.org/IUSERAPI/Register', false),
            new SoapHeader('http://www.w3.org/2005/08/addressing', 'To', 'https://ug.ezeemoney.biz/EZB2BCPApi/USERAPI.svc', false),
        ];

        $registerClient->__setSoapHeaders($headers);

        $requestParams = array();

        $requestParams['CP_CODE'] = 'ZOEMINISTRIES';
        $requestParams['CP_USERID'] = 'ZoeUserAB';
        $requestParams['CP_PASSWORD'] = 'Npyicp7Na@CYK_tdaAMt';
        $requestParams['CP_TXNID'] = str_pad(rand(0, pow(10, 10)-1), 32, '0', STR_PAD_LEFT);
        $requestParams['USER_HP'] = preg_replace("/^0|\\+256|256/", "256", $request->contact);
        $requestParams['USER_NAME'] = $request->accountholdername;

        $response = $registerClient->__soapCall('Register', array('parameters' => ['request' => $requestParams]));

        if($response->RegisterResult->EZ_RESP_CODE != 0)
        {
            return response([
                'user' => $user,
                'token' => $token,
                'messsage' => $response->RegisterResult->EZ_RESP_MSG
            ]);
        }

        $user->ez_account_no = $response->RegisterResult->EZ_ACCOUNT_NO;
        $user->save();

        /*
                * Create Soap Client for Adding Physical Card
            */
            $AddCardClient = new SoapClient(public_path().'/USERAPI.wsdl', [
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
                'soapaction' => 'http://tempuri.org/IUSERAPI/AddCARD',
                'https' => array(
                    'curl_verify_ssl_peer'  => true,
                    'curl_verify_ssl_host'  => true
                ),
            ]);

            $headers = [
                new SoapHeader('http://www.w3.org/2005/08/addressing', 'Action', 'http://tempuri.org/IUSERAPI/AddCARD', false),
                new SoapHeader('http://www.w3.org/2005/08/addressing', 'To', 'https://ug.ezeemoney.biz/EZB2BCPApi/USERAPI.svc', false),
            ];

            $AddCardClient->__setSoapHeaders($headers);

            $requestParams = array();

            $requestParams['CP_CODE'] = 'ZOEMINISTRIES';
            $requestParams['CP_USERID'] = 'ZoeUserAB';
            $requestParams['CP_PASSWORD'] = 'Npyicp7Na@CYK_tdaAMt';
            $requestParams['CP_TXNID'] = str_pad(rand(0, pow(10, 10)-1), 32, '0', STR_PAD_LEFT);
            $requestParams['EZ_ACCOUNT_NO'] = $response->RegisterResult->EZ_ACCOUNT_NO;
            $requestParams['CARDNO'] = $request->cardnumber;
            $requestParams['CARDPIN'] = $request->card_pin;

            $response = $AddCardClient->__soapCall('AddCARD', array('parameters' => ['request' => $requestParams]));

            if($response->AddCARDResult->EZ_RESP_CODE != 0)
            {
                return response()->json([
                    "message" => $response->AddCARDResult->EZ_RESP_MSG,
                    "CP_TXNID" => $response->AddCARDResult->CP_TXNID
                ], 400);
            }

        return response([
            'user' => $user,
            'token' => $token
        ]);
    }

    public function familyregister(Request $request)
    {
        $data = $request->validate([
            'accountholdername' => 'required|max:255',
            'cardnumber' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'contact' => 'required',
            'address' => 'required',
            'nin' => 'required',
            'dob' => 'required',
            'password' => 'required',
            'card_pin' => 'required',
            'group' => 'required',
            'section' => 'required',
            'gender' => 'required',

        ]);

        $data['password'] = bcrypt($request->password);
        $data['usertype'] = 'family';
        $data['status'] = '1';
        $data['role'] = 'Family';
        $role = Role::where('name', 'Family')->first();

        $user = User::create($data);
        $user->assignRole([$role->id]);

        $token = $user->createToken('authToken')->accessToken;

        foreach($request->members as $member){
            //$x = json_decode($place);
            //var_dump($director['longitude']);
            $family = FamilyMembers::create([
                'user_id' => $user->id,
                'name' =>  $member['name'],
                'dob' =>   $member['dob'],
                'contact' =>   $member['contact'],

            ]);

        }

                /*
            * Create Soap Client for registering an EzeeLink account
        */
        $registerClient = new SoapClient(public_path().'/USERAPI.wsdl', [
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
            'soapaction' => 'http://tempuri.org/IUSERAPI/Register',
            'https' => array(
                'curl_verify_ssl_peer'  => true,
                'curl_verify_ssl_host'  => true
            ),
        ]);

        $headers = [
            new SoapHeader('http://www.w3.org/2005/08/addressing', 'Action', 'http://tempuri.org/IUSERAPI/Register', false),
            new SoapHeader('http://www.w3.org/2005/08/addressing', 'To', 'https://ug.ezeemoney.biz/EZB2BCPApi/USERAPI.svc', false),
        ];

        $registerClient->__setSoapHeaders($headers);

        $requestParams = array();

        $requestParams['CP_CODE'] = 'ZOEMINISTRIES';
        $requestParams['CP_USERID'] = 'ZoeUserAB';
        $requestParams['CP_PASSWORD'] = 'Npyicp7Na@CYK_tdaAMt';
        $requestParams['CP_TXNID'] = str_pad(rand(0, pow(10, 10)-1), 32, '0', STR_PAD_LEFT);
        $requestParams['USER_HP'] = preg_replace("/^0|\\+256|256/", "256", $request->contact);
        $requestParams['USER_NAME'] = $request->accountholdername;

        $response = $registerClient->__soapCall('Register', array('parameters' => ['request' => $requestParams]));

        if($response->RegisterResult->EZ_RESP_CODE != 0)
        {
            return response([
                'user' => $user,
                'token' => $token,
                'messsage' => $response->RegisterResult->EZ_RESP_MSG
            ]);
        }

        $user->ez_account_no = $response->RegisterResult->EZ_ACCOUNT_NO;
        $user->save();

        /*
                * Create Soap Client for Adding Physical Card
            */
            $AddCardClient = new SoapClient(public_path().'/USERAPI.wsdl', [
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
                'soapaction' => 'http://tempuri.org/IUSERAPI/AddCARD',
                'https' => array(
                    'curl_verify_ssl_peer'  => true,
                    'curl_verify_ssl_host'  => true
                ),
            ]);

            $headers = [
                new SoapHeader('http://www.w3.org/2005/08/addressing', 'Action', 'http://tempuri.org/IUSERAPI/AddCARD', false),
                new SoapHeader('http://www.w3.org/2005/08/addressing', 'To', 'https://ug.ezeemoney.biz/EZB2BCPApi/USERAPI.svc', false),
            ];

            $AddCardClient->__setSoapHeaders($headers);

            $requestParams = array();

            $requestParams['CP_CODE'] = 'ZOEMINISTRIES';
            $requestParams['CP_USERID'] = 'ZoeUserAB';
            $requestParams['CP_PASSWORD'] = 'Npyicp7Na@CYK_tdaAMt';
            $requestParams['CP_TXNID'] = str_pad(rand(0, pow(10, 10)-1), 32, '0', STR_PAD_LEFT);
            $requestParams['EZ_ACCOUNT_NO'] = $response->RegisterResult->EZ_ACCOUNT_NO;
            $requestParams['CARDNO'] = $request->cardnumber;
            $requestParams['CARDPIN'] = $request->card_pin;

            $response = $AddCardClient->__soapCall('AddCARD', array('parameters' => ['request' => $requestParams]));

            if($response->AddCARDResult->EZ_RESP_CODE != 0)
            {
                return response()->json([
                    "message" => $response->AddCARDResult->EZ_RESP_MSG,
                    "CP_TXNID" => $response->AddCARDResult->CP_TXNID
                ], 400);
            }


        return response([ 'user' => $user, 'token' => $token]);
    }

    public function Companyregister(Request $request)
    {
        $data = $request->validate([
            'accountholdername' => 'required|max:255',
            'cardnumber' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'contact' => 'required',
            'address' => 'required',
            'postal_address' => 'required',
            'password' => 'required',
            'card_pin' => 'required',
            'group' => 'required',
            'section' => 'required',
        ]);

        $data['password'] = bcrypt($request->password);
        $data['usertype'] = 'company';
        $data['status'] = '1';
        $data['role'] = 'Company';
        $role = Role::where('name', 'Company')->first();

        $user = User::create($data);
        $user->assignRole([$role->id]);

        $token = $user->createToken('authToken')->accessToken;

        foreach($request->directors as $director){
            //$x = json_decode($place);
            //var_dump($director['longitude']);
            $company_directors = Directors::create([
                'companyid' => $user->id,
                'name' =>  $director['name'],
                'nin' =>   $director['nin'],


            ]);

        }

                        /*
            * Create Soap Client for registering an EzeeLink account
        */
        $registerClient = new SoapClient(public_path().'/USERAPI.wsdl', [
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
            'soapaction' => 'http://tempuri.org/IUSERAPI/Register',
            'https' => array(
                'curl_verify_ssl_peer'  => true,
                'curl_verify_ssl_host'  => true
            ),
        ]);

        $headers = [
            new SoapHeader('http://www.w3.org/2005/08/addressing', 'Action', 'http://tempuri.org/IUSERAPI/Register', false),
            new SoapHeader('http://www.w3.org/2005/08/addressing', 'To', 'https://ug.ezeemoney.biz/EZB2BCPApi/USERAPI.svc', false),
        ];

        $registerClient->__setSoapHeaders($headers);

        $requestParams = array();

        $requestParams['CP_CODE'] = 'ZOEMINISTRIES';
        $requestParams['CP_USERID'] = 'ZoeUserAB';
        $requestParams['CP_PASSWORD'] = 'Npyicp7Na@CYK_tdaAMt';
        $requestParams['CP_TXNID'] = str_pad(rand(0, pow(10, 10)-1), 32, '0', STR_PAD_LEFT);
        $requestParams['USER_HP'] = preg_replace("/^0|\\+256|256/", "256", $request->contact);
        $requestParams['USER_NAME'] = $request->accountholdername;

        $response = $registerClient->__soapCall('Register', array('parameters' => ['request' => $requestParams]));

        if($response->RegisterResult->EZ_RESP_CODE != 0)
        {
            return response([
                'user' => $user,
                'token' => $token,
                'messsage' => $response->RegisterResult->EZ_RESP_MSG
            ]);
        }

        $user->ez_account_no = $response->RegisterResult->EZ_ACCOUNT_NO;
        $user->save();

        /*
                * Create Soap Client for Adding Physical Card
            */
            $AddCardClient = new SoapClient(public_path().'/USERAPI.wsdl', [
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
                'soapaction' => 'http://tempuri.org/IUSERAPI/AddCARD',
                'https' => array(
                    'curl_verify_ssl_peer'  => true,
                    'curl_verify_ssl_host'  => true
                ),
            ]);

            $headers = [
                new SoapHeader('http://www.w3.org/2005/08/addressing', 'Action', 'http://tempuri.org/IUSERAPI/AddCARD', false),
                new SoapHeader('http://www.w3.org/2005/08/addressing', 'To', 'https://ug.ezeemoney.biz/EZB2BCPApi/USERAPI.svc', false),
            ];

            $AddCardClient->__setSoapHeaders($headers);

            $requestParams = array();

            $requestParams['CP_CODE'] = 'ZOEMINISTRIES';
            $requestParams['CP_USERID'] = 'ZoeUserAB';
            $requestParams['CP_PASSWORD'] = 'Npyicp7Na@CYK_tdaAMt';
            $requestParams['CP_TXNID'] = str_pad(rand(0, pow(10, 10)-1), 32, '0', STR_PAD_LEFT);
            $requestParams['EZ_ACCOUNT_NO'] = $response->RegisterResult->EZ_ACCOUNT_NO;
            $requestParams['CARDNO'] = $request->cardnumber;
            $requestParams['CARDPIN'] = $request->card_pin;

            $response = $AddCardClient->__soapCall('AddCARD', array('parameters' => ['request' => $requestParams]));

            if($response->AddCARDResult->EZ_RESP_CODE != 0)
            {
                return response()->json([
                    "message" => $response->AddCARDResult->EZ_RESP_MSG,
                    "CP_TXNID" => $response->AddCARDResult->CP_TXNID
                ], 400);
            }


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
            return response(['message' => 'Incorrect Details. Please try again'],403);
        }

        $token = auth()->user()->createToken('authToken')->accessToken;

        if(empty(Auth::user()->ez_account_no))
        {
            /*
                * Create Soap Client for registering an EzeeLink account
            */
            $registerClient = new SoapClient(public_path().'/USERAPI.wsdl', [
                'trace' => 1,
                'cache_wsdl' => WSDL_CACHE_NONE,
                'exception' => 0,
                'soap_version' => SOAP_1_2,
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
                'soapaction' => 'http://tempuri.org/IUSERAPI/Register',
                'https' => array(
                    'curl_verify_ssl_peer'  => true,
                    'curl_verify_ssl_host'  => true
                ),
            ]);

            $headers = [
                new SoapHeader('http://www.w3.org/2005/08/addressing', 'Action', 'http://tempuri.org/IUSERAPI/Register', false),
                new SoapHeader('http://www.w3.org/2005/08/addressing', 'To', 'https://ug.ezeemoney.biz/EZB2BCPApi/USERAPI.svc', false),
            ];

            $registerClient->__setSoapHeaders($headers);

            $requestParams = array();

            $requestParams['CP_CODE'] = 'ZOEMINISTRIES';
            $requestParams['CP_USERID'] = 'ZoeUserAB';
            $requestParams['CP_PASSWORD'] = 'Npyicp7Na@CYK_tdaAMt';
            $requestParams['CP_TXNID'] = str_pad(rand(0, pow(10, 10)-1), 32, '0', STR_PAD_LEFT);
            $requestParams['USER_HP'] = preg_replace("/^0|\\+256|256/", "256", Auth::user()->contact);
            $requestParams['USER_NAME'] = Auth::user()->accountholdername;

            $response = $registerClient->__soapCall('Register', array('parameters' => ['request' => $requestParams]));

            if($response->RegisterResult->EZ_RESP_CODE != 0)
            {
                return response([
                    'user' => Auth::user(),
                    'token' => $token,
                    'messsage' => $response->RegisterResult->EZ_RESP_MSG
                ]);
            }

            Auth::user()->ez_account_no = $response->RegisterResult->EZ_ACCOUNT_NO;
            Auth::user()->save();
        }

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

        if($response->CheckBalResult->EZ_RESP_CODE != 0)
        {
            return response([
                'user' => Auth::user(),
                'token' => $token,
                'messsage' => $response->CheckBalResult->EZ_RESP_MSG
            ]);
        }

        Auth::user()->balance = $response->CheckBalResult->EZ_ACCOUNT_BAL;
        Auth::user()->save();

        return response([
            'user' => Auth::user(),
            'token' => $token
        ], 200);
    }

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

    public function checkEmail(Request $request)
{   
    $data = $request->validate([
        'email' => 'required',
       
    ]);
    $email = $request->email;
    $user = User::where('email', $email)->first();
    if ($user) {
        return response()->json(['exists' => true]);
    } else {
        return response()->json(['exists' => false]);
    }
}
}
