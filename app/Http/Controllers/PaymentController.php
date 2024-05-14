<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class PaymentController extends Controller
{
    private $base = 'https://api.paypal.com';
    // private $base = 'https://api-m.sandbox.paypal.com';
    
    /**
     * Generate an OAuth 2.0 access token for authenticating with PayPal REST APIs.
     * @see https://developer.paypal.com/api/rest/authentication/
     */
    private function generateAccessToken()
    {
        try {
            $clientId = config('services.paypal.client_id');
            $clientSecret = config('services.paypal.client_secret');

            if (!$clientId || !$clientSecret) {
                throw new \Exception('MISSING_API_CREDENTIALS');
            }

            $auth = base64_encode("$clientId:$clientSecret");
            $client = new Client();
            $response = $client->request('POST', "{$this->base}/v1/oauth2/token", [
                'headers' => [
                    'Content-Type' => 'application/x-www-form-urlencoded',
                    'Authorization' => "Basic $auth",
                ],
                'form_params' => [
                    'grant_type' => 'client_credentials',
                ],
            ]);

            Log::info($response->getBody());
            $data = json_decode($response->getBody(), true);
            Log::info($data);
            return $data['access_token'];
        } catch (\Exception $error) {
            \Log::error('Failed to generate Access Token: ' . $error->getMessage());
        }
    }

    /**
     * Create an order to start the transaction.
     * @see https://developer.paypal.com/docs/api/orders/v2/#orders_create
     */
    public function createOrder(Request $request)
    {
        try {
            $cart = $request->input('cart');
            // dd($cart[0]['total']);
            // Use $cart to calculate the purchase unit details

            $accessToken = $this->generateAccessToken();
            $url = "{$this->base}/v2/checkout/orders";
            $payload = [
                'intent' => 'CAPTURE',
                'purchase_units' => [[
                    'amount' => [
                        'currency_code' => 'PHP',
                        'value' => $cart[0]['total'],
                    ],
                    
                ],

                
                ]
                ,
            ];
            // $payload = [
            //     'intent' => 'CAPTURE',
            //     'purchase_units' => [
            //         [
            //             'amount' => [
            //                 'currency_code' => 'PHP',
            //                 'value' => $cart[0]['total'],
            //             ],
            //             'items' => [
            //                 [
            //                     'name' => 'Example Product 1',
            //                     'description' => 'This is a sample product description.',

            //                     'category' => 'PHYSICAL',

            //                 ],

            //             ],
            //         ],
            //     ],
            // ];
            
            
            $jsonPayload = json_encode($payload);

            $client = new Client();
            $response = $client->request('POST', $url, [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Authorization' => "Bearer $accessToken",
                ],
                'body' => $jsonPayload,
            ]);

            Log::info($response->getBody());
            return $this->handleResponse($response);
        } catch (\Exception $error) {
            \Log::error('Failed to create order: ' . $error->getMessage());
            return response()->json(['error' => 'Failed to create order.'], 500);
        }
    }

        /**
     * Capture payment for the created order to complete the transaction.
     * @see https://developer.paypal.com/docs/api/orders/v2/#orders_capture
     */
    public function captureOrder($orderID)
    {
        try {
            $accessToken = $this->generateAccessToken();
            $url = "{$this->base}/v2/checkout/orders/{$orderID}/capture";

            $client = new Client();
            $response = $client->request('POST', $url, [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Authorization' => "Bearer $accessToken",
                ],
            ]);

            return $this->handleResponse($response);
        } catch (\Exception $error) {
            // \Log::error('Failed to capture order: ' . $error->getMessage());
        
            // return response()->json($error->getMessage());

            \Log::error('Failed to capture order: ' . $error->getMessage());

            // Extract JSON part from the error message
            $jsonStartPos = strpos($error->getMessage(), '{"name":');
            
            if ($jsonStartPos !== false) {
                $jsonString = substr($error->getMessage(), $jsonStartPos);
                $jsonData = json_decode($jsonString, true);

                // Check if JSON decoding was successful
                if (json_last_error() == JSON_ERROR_NONE) {
                    return response()->json(['error' => $jsonData], 422);
                }
            }

            // If JSON extraction or decoding fails, return a generic error
            return response()->json($error->getMessage());
            // return $error->getMessage()
        }
    }

    private function handleResponse($response)
    {
        try {
            $jsonResponse = json_decode($response->getBody(), true);
            // return response()->json([
            //     'jsonResponse' => $jsonResponse,
            //     'httpStatusCode' => $response->getStatusCode(),
            // ]);

            return $jsonResponse; 
        } catch (\Exception $error) {
            $errorMessage = $response->getBody();
            throw new \Exception($errorMessage);
        }
    }
}
