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

class BalanceCheck extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'balance:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update User Balance';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $users = User::select('users.*')->whereNotNull('ez_account_no')->get();
        foreach ($users as $user) {
            $statusUser = User::find($user->id);

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
        $requestParams['EZ_ACCOUNT_NO'] = $statusUser->ez_account_no;

        $response = $checkBalClient->__soapCall('CheckBal', array('parameters' => ['request' => $requestParams]));

        $statusUser->balance = $response->CheckBalResult->EZ_ACCOUNT_BAL;
        $statusUser->save();

        }

        $this->info('Successfully updated balance.');
    }
}
