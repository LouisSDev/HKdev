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
        if(is_array($headers) && count($headers) != 0) {
            foreach ($headers as $headerName => $headerValue) {
                self::addHeader($headerName, $headerValue);
            }
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

    public static function isDate($value)
    {
        return preg_match( '#^(((\d{4})(-)(0[13578]|10|12)(-)(0[1-9]|'
            .'[12][0-9]|3[01]))|(‌​(\d{4})(-)(0[469]|11‌​)(-)(0[1-9]|[12]'
            .'[0-9‌​]|30))|((\d{4})(-)(0‌​2)(-)(0[1-9]|[12][0-‌​9]|2[0-8]))'
            .'|(([02468‌​][048]00)(-)(02)(-)(‌​29))|(([13579][26]00‌​)(-)(02)'
            .'(-)(29))|(([‌​0-9][0-9][0][48])(-)‌​(02)(-)(29))|(([0-9]‌​[0-9]'
            .'[2468][048])(-)‌​(02)(-)(29))|(([0-9]‌​[0-9][13579][26])(-)‌​'
            .'(02)(-)(29)))(\s)(([‌​0-1][0-9]|2[0-4]):([‌​0-5][0-9]):([0-5][0-‌​9]))$#', $value);
    }

}