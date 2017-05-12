<?php

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class Utils
{

    static public function initiateLogging(){

        $logName = date("H_i_s___") . self::randomHash(10);
        $GLOBALS['globalLog'] = new Logger( $logName);
        $GLOBALS['globalLog'] -> pushHandler(new StreamHandler('bin/logs/DebugLog/'.date("Y-m-d") ."/" . $logName , Logger::DEBUG));

    }

    static public function randomHash($length)
    {
        $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
        $pass = "";
        for ($i = 0; $i < $length; $i++) {
            $n = rand(0, strlen($alphabet) - 1);
            $pass .= $alphabet[$n];
        }
        return $pass;
    }

    static public function addWarning($str)
    {
        $GLOBALS['globalLog'] -> addWarning($str);
    }

    static public function addHeader($headerName, $headerValue){
        header($headerName . ': ' . $headerValue);
    }

    static public function addHeaders($headers){
        foreach($headers as $headerName => $headerValue){
            self::addHeader($headerName, $headerValue);
        }
    }



    static public function getHeader($headerKey)
    {
        $headers = getallheaders();
        $headerValue = null;
        if (array_key_exists($headerKey, $headers)) {
            $headerValue = $headers[$headerKey];
        }
        return $headerValue;
    }

}