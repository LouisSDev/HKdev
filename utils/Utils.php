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
        return preg_match("/\d{4}\-\d{2}-\d{2}/", $value);
    }


    /**
     * Replaces any parameter placeholders in a query with the value of that
     * parameter. Useful for debugging. Assumes anonymous parameters from
     * $params are are in the same order as specified in $query
     *
     * @param string $query The sql query with parameter placeholders
     * @param array $params The array of substitution parameters
     * @return string The interpolated query
     */
    public static function interpolateQuery($query, $params) {
        $keys = array();

        # build a regular expression for each parameter
        foreach ($params as $key => $value) {
            if (is_string($key)) {
                $keys[] = '/:'.$key.'/';
            } else {
                $keys[] = '/[?]/';
            }
        }

        $query = preg_replace($keys, $params, $query, 1, $count);

        #trigger_error('replaced '.$count.' keys');

        return $query;
    }

}