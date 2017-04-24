<?php


abstract class Controller
{

    private $connected = false;

    /**
     * Controller constructor.
     */
    public function __construct()
    {
        if ($this -> getConnectionRequired()){
            if($GLOBALS['repositories']['user'] -> isConnected()){
                $this -> connected = true;
                // The user is not connected -> we must print him an error!

            }
        }
    }

    private function generateView($filename, $args){
        foreach($args as $key => $value){
            $GLOBALS['view'][$key] = $value;
        }

        require_once 'view/' . $filename ;
    }

    private function throwConnectionError(){
        // To be coded
    }

    public function getConnectionRequired(){
        return false;
    }

}