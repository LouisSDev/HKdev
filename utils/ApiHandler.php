<?php

class ApiHandler
{

    const DEFAULT_HEADERS = [
        'Content-Type' => 'application/json'
    ];

    public static function returnResponse($response, $headers = null){


        if($headers) {
            // We merge the added headers with default headers that will be sent with the HTTP response
            $headers[] =  self::DEFAULT_HEADERS;
        }

        // Now we add those headers thanks to the method we defined in the utils class of this project
        Utils::addHeaders($headers);

        // Now we echo the response in json format
        echo json_encode($response);

        // And stop the PHP execution
        exit;
    }

    public static function throwError($httpCode =  400, $errorMessage){
        // We define the response scheme
        $response = [
            'error' => true,
            'errorMessage' => $errorMessage
         ];

        // Send the right http response code
        http_response_code($httpCode);

        // And return the resulting response
        self::returnResponse($response);
    }

    public static function returnValidResponse($response, $httpCode = 200, $headers = null)
    {

        // Define the response scheme
        $response = [
            'error' => false,
            'content' => $response
        ];

        // We set the response code
        http_response_code($httpCode);


        // And return the response
        self::returnResponse($response, $headers);
    }

    public static function returnResponseFromResponseObject(ApiResponse $apiResponse)
    {
        if($apiResponse -> isError()){
            self::throwError($apiResponse -> getCode(), $apiResponse -> getContent());
        }
        else{
            self::returnValidResponse($apiResponse -> getContent(), $apiResponse -> getCode());
        }
    }
}