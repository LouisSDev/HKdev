<?php


abstract class Controller
{

    protected $connectionRequired = false;

    protected $connected = false;

    /**
     * @var User $user
     */
    protected  $user = null;

    /**
     * @var PDO $db
     */
    protected $db = null;

    /**
     * Controller constructor.
     */
    public function __construct(PDO $db)
    {
        $this -> db = $db;

        /** @var UserRepository $userRepo */
        $userRepo = $GLOBALS['repositories']['user'];

        if( $userRepo -> isConnected()){
            $this -> connected = true;
            $this -> user = $userRepo -> getUser();
        }

        if(!$this -> connected && $this -> connectionRequired){
            $this -> throwConnectionError();
        }

    }

    protected function generateView($filename, $args){
        foreach($args as $key => $value){
            $GLOBALS['view'][$key] = $value;
        }

        require_once 'view/' . $filename ;
    }


    protected function throwConnectionError(){
        // To be coded
        $this -> generateView('homepage.php', [
            'connected' => false
        ]);
        exit();
    }
}