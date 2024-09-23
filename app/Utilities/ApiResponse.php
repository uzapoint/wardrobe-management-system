<?php
namespace App\Utilities;

class ApiResponse
{  
    public static function sendResponse($response, $payload)
    {
        $response = [
            'success' => true,
            'response' => $response,
            'payload' => $payload,
        ];

        return response()->json($response, 200);
    }

    public static function sendError($response, $payload, $code = 404)
    {
        $response = [
            'success' => false,
            'response' => $response,
            'payload' => $payload,
        ];

        /*if(!empty($errorMessages))
        {
            $response['data'] = $errorMessages;
        }*/

        return response()->json($response, $code);
    }
}