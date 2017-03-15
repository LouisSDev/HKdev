<?php
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

$logName = date("H_i_s___") . randomHash(10);
$GLOBALS['globalLog'] = new Logger( $logName);
$GLOBALS['globalLog'] -> pushHandler(new StreamHandler('bin/logs/DebugLog/'.date("Y-m-d") ."/" . $logName , Logger::DEBUG));

function addWarning($str){
    $GLOBALS['globalLog'] -> addWarning($str);
}