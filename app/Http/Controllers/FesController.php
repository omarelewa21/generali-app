<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;
use App\Models\SessionStorage;

class FesController extends Controller
{
    public function sendFes(Request $request)
    {
       $fesId = $request->input('transaction_id') ?? '';

       if ( empty($fesId) ) {
            abort(404);
       }

       $fesData = SessionStorage::where('transaction_id',$fesId)->first()->get();

        try 
        {
            $client = new Client([
                'base_uri' => env('FES_URL'),
                'timeout' => 10.0,
                'debug'=> true
            ]);
            
            // $passData['customers']['customerDetails'] = $fesData['data']['basic_details'];
            
            $dbData = self::formatData($fesData[0]['data']);

            $newData['customersChoice'] = 1;
            $newData['customers']['customerDetails'] = array_merge($dbData['basic_details'],$dbData['identity_details']); 
            
            // Split into first name and last name
            $nameParts = explode(' ', $newData['customers']['customerDetails']['full_name']);
            // Extract first name and last name
            $firstName = $nameParts[0];
            $lastName = isset($nameParts[1]) ? $nameParts[1] : '';
            $newData['customers']['customerDetails']['firstName'] = $firstName; 
            $newData['customers']['customerDetails']['lastName'] = $lastName;

            $newData['customers']['customerDetails']['nationality'] = $newData['customers']['customerDetails']['country'];
            $newData['customers']['customerDetails']['identityType'] = $newData['customers']['customerDetails']['id_type'];
            $newData['customers']['customerDetails']['identityNo'] = $newData['customers']['customerDetails']['id_number'];
            $newData['customers']['customerDetails']['smokingStatus'] = $newData['customers']['customerDetails']['habits'];
            $newData['customers']['customerDetails']['dateOfBirth'] = $newData['customers']['customerDetails']['dob'];

            $removeKey = ['country','id_type','id_number','habits','dob'];

            foreach ($removeKey as $key) {
                unset($newData['customers']['customerDetails'][$key]);
            }
            
            
            // $newData = self::finalizeData($dbData);

            // Log::debug($newData);
            

            // Send a request to https://u1.gmlfes.com.my/fna/customerDetails/1
            $response = $client->post('/fna/customerDetails/1', [
                'headers' => [
                    'X-FES-AUTH' => env('X_FES_AUTH'),
                    'Content-Type' => 'application/json'
                ],
                'json' => $newData,
                'debug' => fopen('php://stderr','w')
            ]);

            $statusCode = $response->getStatusCode();
            $responseContent = $response->getBody()->getContents();
            $responseHeaders = $response->getHeaders();

            $fullResponse = [
                'status' => $statusCode,
                'response_content' => $responseContent,
                'response_header' => $responseHeaders
            ];
        
            return $fullResponse;

        } catch (GuzzleHttp\Exception\BadResponseException $e) {
            Log::error('Exception: ' . $e->getMessage());
            return $e->getResponse()->getBody()->getContents();
        }
    }

    public function formatData($fesData)
    {
        $unsetKey = ['pdpa','avatar'];

        foreach ($fesData as $key => $value) {

            if (in_array($key,$unsetKey)) {
                unset($fesData[$key]);
            }
        }

        return $fesData;

    }

    public function finalizeData($dbData)
    {
        $finalData['customer']['customerDetails'] = array_merge($dbData['basic_details'],$dbData['identity_details']);
    }

}
