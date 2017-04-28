<?php


abstract class Controller
{

    protected $connectionRequired = false;

    protected $connected = false;

    protected $args = array();

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
            $this -> args['user'] = $this -> user;
        }

        $this ->  args['connected'] = $this -> connected;

        if(!$this -> connected && $this -> connectionRequired){
            $this -> throwConnectionError();
        }

    }

    protected function generateView($filename){
        foreach($this -> args as $key => $value){

            if(is_string($value)){
                $value = htmlspecialchars($value);
            }

            $GLOBALS['view'][$key] = $value;
        }

        require_once 'view/' . $filename ;
    }


    protected function throwConnectionError(){
        // To be coded
        $this -> generateView('connection.php');
        exit();
    }
}