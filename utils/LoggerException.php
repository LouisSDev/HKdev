<?php

use Monolog\Logger;
use Monolog\Handler\StreamHandler;


// This class extends php Exception except it will be used to create logs of errors
abstract class LoggerException extends Exception
{
    protected $message = 'Unknown exception';     // Exception message
    private   $string;                            // Unknown
    protected $code    = 0;                       // User-defined exception code
    protected $file;                              // Source filename of exception
    protected $line;                              // Source line of exception
    private   $trace;                             // Unknown


    public function __construct($message = null, $code = 0)
    {
        if (!$message) {
            throw new $this('Unknown '. get_class($this));
        }


        // We create the log file
        $logName = date("H_i_s___") . randomHash(10);
        $log = new Logger( $logName);
        $log->pushHandler(new StreamHandler('bin/logs/Exceptions/'.date("Y-m-d") ."/" . $logName , Logger::WARNING));

        $log->addWarning('ERROR!! ');


        // For each global var
        foreach($GLOBALS as $var_name => $value) {
            // We get its name
            $debug = $var_name;

            // Then for each of it's sub values
            foreach($value as $subVar_name => $subValue) {

                // We add it's sub var name and value to the subDebug var
                $subDebug = $debug . " =>  "  . $subVar_name . " =>  " . print_r($subValue, true) ;
                // And add it to the log
                $log->addError($subDebug);
            }
            // Add it to the log for the case it hasn't got any inside values
            $log->addError($debug);

        }

        // To output on the web page the var states
        var_dump($GLOBALS);


        // Calling the parent constructor
        parent::__construct($message, $code);
    }

    public function __toString()
    {
        return get_class($this) . " '{$this->message}' in {$this->file}({$this->line})\n"
            . "{$this->getTraceAsString()}";
    }


}