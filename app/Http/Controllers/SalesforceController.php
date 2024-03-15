<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Log;
use App\Services\SalesforceService;
use Brick\Math\BigInteger;

class SalesforceController extends Controller
{  
    public function redirectToSalesforce()
    {
        // return Socialite::driver('salesforce')->redirect();
        $clientId = env('CLIENT_ID','');
        $clientSecret = env('CLIENT_SECRET','');
        $loginUrl = env('LOGIN_URL','');
        $redirectUri = env('REDIRECT_URI','');
        
        // Step 1: Get Authorization Code (Manual URL or through a web server)
        $authUrl = "$loginUrl/services/oauth2/authorize?response_type=code&client_id=$clientId&redirect_uri=$redirectUri";
        // $logout = "$loginUrl/services/oauth2/revoke?token=aPrxuaVKc.2wHPBH_1PVx0Z_Xsxhw1FHZDoENLq.nzG52Y2nWZ05kfy3WPM.83KTSvLul797dA==";

        header("Location: $authUrl");

        exit;
    }

    public function handleSalesforceCallback()
    {
        
        // Step 2: Exchange Authorization Code for Access Token
        $clientId = env('CLIENT_ID','');
        $clientSecret = env('CLIENT_SECRET','');
        $redirectUri = env('REDIRECT_URI','');
        $loginUrl = env('LOGIN_URL','');
        
        if(isset($_GET['code'])){
            $code = $_GET['code']; // Retrieve the code from the redirect URI
        }
        else
        {
            return ['error' => 'invalid_request', 
                    'error_description' => 'The request is missing a required parameter.'];
        }

        Log::debug($code);
        //code should retrieve from the redirect URI 

        $postData = [
            'grant_type' => 'authorization_code',
            'client_id' => $clientId,
            'client_secret' => $clientSecret,
            'redirect_uri' => $redirectUri,
            'code' => $code
        ];

        $tokenUrl = "$loginUrl/services/oauth2/token";
        $ch = curl_init($tokenUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
        $response = curl_exec($ch);
        curl_close($ch);

        $data = json_decode($response, true);

 
        $accessToken = $data['access_token'];

        // Step 3: Make API Requests with Access Token
        $apiEndpoint = "$loginUrl/services/data/v54.0"; // Adjust the API version
        $apiUrl = "$apiEndpoint/sobjects/Account"; // Example API endpoint
        $ch = curl_init($apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ["Authorization: Bearer $accessToken"]);
        $response = curl_exec($ch);
        curl_close($ch);

        return $response;

    }
}
