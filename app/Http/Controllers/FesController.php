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
       $fesId = $request->input('transaction_id');
       $fesData = SessionStorage::where('transaction_id',$fesId)->first();

        try 
        {
            $client = new Client([
                'base_uri' => env('FES_URL'),
                'timeout' => 10.0,
                'debug'=> true
            ]);
            
            $passData['customers'] = $fesData['data']['basic_details'];

            // Send a request to https://u1.gmlfes.com.my/fna/customerDetails/1
            $response = $client->post('/fna/customerDetails/1', [
                'headers' => [
                    'X-FES-AUTH' => env('X_FES_AUTH'),
                    'Content-Type' => 'application/json'
                ],
                'json' => $passData,
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

}
