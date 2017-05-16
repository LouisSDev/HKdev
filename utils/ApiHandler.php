<?php

class ApiHandler
{

    const DEFAULT_HEADERS = [
        'Content-type' => 'application/json; charset=utf-8'
    ];

    public static function returnResponse($response, $headers = null){


        // Now we add those headers thanks to the method we defined in the utils class of this project
        Utils::addHeaders($headers);
        Utils::addHeaders(self::DEFAULT_HEADERS);


        // Now we echo the response in json format
        echo json_encode($response, JSON_FORCE_OBJECT|JSON_UNESCAPED_UNICODE);

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