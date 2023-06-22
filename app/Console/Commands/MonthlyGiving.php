<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use App\Models\User;
use App\Models\Giving;
use App\Models\Transaction;
use \Exception as Exception;
use SoapClient;
use SoapHeader;
use Validator;
class MonthlyGiving extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'giving:monthly';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Respectively execute monthly giving via api.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $users = User::select('users.*','scheduling.amount AS gamount','scheduling.category','scheduling.comment','scheduling.phone_number')->join('scheduling','scheduling.userid','users.id')->where('scheduling.type','monthly')->get();
        foreach ($users as $user) {
            $statusUser = User::find($user->id);

            $transaction = Transaction::create([
                'user_id' => $user->id,
                'phone_number' => $user->contact,
                'type' => 'giving',
                'amount' => $user->gamount,
            ]);

            /*
                * Create Soap Client for PayCollection
            */
            $collectionClient = new SoapClient(public_path().'/USERAPI.wsdl', [
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
                'soapaction' => 'http://tempuri.org/IUSERAPI/PayCollectionMakePayment',
                'https' => array(
                    'curl_verify_ssl_peer'  => true,
                    'curl_verify_ssl_host'  => true
                ),
            ]);

            $headers = [
                new SoapHeader('http://www.w3.org/2005/08/addressing', 'Action', 'http://tempuri.org/IUSERAPI/PayCollectionMakePayment', false),
                new SoapHeader('http://www.w3.org/2005/08/addressing', 'To', 'https://ug.ezeemoney.biz/EZB2BCPApi/USERAPI.svc', false),
            ];

            $collectionClient->__setSoapHeaders($headers);

            $requestParams = array();

            $requestParams['CP_CODE'] = 'ZOEMINISTRIES';
            $requestParams['CP_USERID'] = 'ZoeUserAB';
            $requestParams['CP_PASSWORD'] = 'Npyicp7Na@CYK_tdaAMt';
            $requestParams['CP_TXNID'] = str_pad(rand(0, pow(10, 10)-1), 32, '0', STR_PAD_LEFT);
            $requestParams['EZ_ACCOUNT_NO'] = $user->ez_account_no;
            $requestParams['CustomerPhone'] = preg_replace("/^0|\\+256|256/", "0", $user->contact);
            $requestParams['MerchantCode'] = '86648951';
            $requestParams['Amount'] = $user->gamount;
            $requestParams['Ref1'] = $user->category;

            $response = $collectionClient->__soapCall('PayCollectionMakePayment', array('parameters' => ['request' => $requestParams]));

            $collectionResponse = $response;

            if($response->PayCollectionMakePaymentResult->EZ_RESP_CODE != 0)
            {
                $transaction->status = "failed";
                $transaction->save();

                // return response()->json([
                //     "message" => "Give Failed! ".$response->PayCollectionMakePaymentResult->EZ_RESP_MSG,
                //     "CP_TXNID" => $response->PayCollectionMakePaymentResult->CP_TXNID,
                // ], 400);
            } else {

                $transaction->status = "success";
                $transaction->save();

                $giving = Giving::create([
                    'user_id' => $user->id,
                    'type' => 'monthly',
                    'amount' => $user->gamount,
                    'comment' => $user->comment,
                    'category' => $user->category,
                ]);

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
            $requestParams['EZ_ACCOUNT_NO'] = $user->ez_account_no;

            $response = $checkBalClient->__soapCall('CheckBal', array('parameters' => ['request' => $requestParams]));

            // if($response->CheckBalResult->EZ_RESP_CODE != 0)
            // {
            //     return response([
            //         'user' => $user->id,
            //         'token' => 'n/a',
            //         'messsage' => $response->CheckBalResult->EZ_RESP_MSG,
            //         "CP_TXNID" => $response->CheckBalResult->CP_TXNID,
            //         'category' => $request->category,
            //     ]);
            // }

            $statusUser->balance = $response->CheckBalResult->EZ_ACCOUNT_BAL;
            $statusUser->save();



            // return response()->json([
            //     "message" => "Transaction Success!",
            //     "CP_TXNID" => $collectionResponse->PayCollectionMakePaymentResult->CP_TXNID,
            // ], 200);
        }

        $this->info('Successfully executed monthly giving.');
    }
}
