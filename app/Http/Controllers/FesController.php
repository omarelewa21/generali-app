<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;
use App\Utils\DataMapper;

class FesController extends Controller
{
    public function sendFes(Request $request)
    {
        try 
        {
            $customerDetails = $request->session()->get('customer_details', []);

            $client = new Client([
                'base_uri' => env('FES_URL'),
                'timeout' => 10.0,
                'debug'=> true
            ]);

            $newData['customersChoice'] = $customerDetails['basic_details']['customer_choice'];
            $newData = DataMapper::mapCustomerDetails($customerDetails);

            $removeKey = ['country','id_type','id_number','habits','dob'];

            foreach ($removeKey as $key) {
                unset($newData['customers']['customerDetails'][$key]);
            }
 
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
            
            return view('pages/summary/overview');

        } catch (GuzzleHttp\Exception\BadResponseException $e) {
            Log::error('Exception: ' . $e->getMessage());
            return $e->getResponse()->getBody()->getContents();
        }
    }
}
