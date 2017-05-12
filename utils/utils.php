<?php
function randomHash($length) {
    $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
    $pass = "";
    for ($i = 0; $i < $length; $i++) {
        $n = rand(0, strlen($alphabet)-1);
        $pass .= $alphabet[$n];
    }
    return $pass;
}


function getHeader( $headerKey )
{
    $headers = getallheaders();
    $headerValue = null;
    if ( array_key_exists($headerKey, $headers) ) {
        $headerValue = $headers[ $headerKey ];
    }
    return $headerValue;
}