<?php

abstract class Controller
{

    const CONNECTION_ERROR_DEFAULT_MESSAGE = "Mauvais identifiants!";
    protected $connectionRequired = false;

    protected $connected = false;

    protected $args = array();

    protected $api = false;

    protected $adminPage = false;

    /** @var ApiResponse $apiResponse */
    protected $apiResponse = null;

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
    public function __construct(PDO $db = null)
    {
        $this -> db = $db;

        /** @var UserRepository $userRepo */
        $userRepo = $GLOBALS['repositories']['user'];

        if( $userRepo -> isConnected()
            && (!$this -> adminPage
                || ($this -> adminPage && $userRepo -> getUser() -> getAdmin()))
        ){
            $this -> connected = true;
            $this -> user = $userRepo -> getUser();
            $this -> args['user'] = $this -> user;
        }

        $this ->  args['connected'] = $this -> connected;

        if(!$this -> connected && $this -> connectionRequired){
            $this -> throwConnectionError();
        }

    }

    protected function generateView($filename, $pageTitle, $pathName = null){

        // If it's a standard controller
        if(!$this -> api) {

            $pathToViews = $GLOBALS['root_dir'] . '/view/';

            $this->args['page_title'] = $pageTitle;

            //putting args array values into $GLOBALS variable
            foreach ($this->args as $key => $value) {

                if (is_string($value)) {
                    $value = htmlspecialchars($value);
                }

                $GLOBALS['view'][$key] = $value;
            }

            if ($pathName === null) {

                require_once $pathToViews . "general/htmlHead.php";

                $pathName = $filename;
                require_once $pathToViews . $filename;
                exit();
            }

            header('Location: ' . $GLOBALS['server_root'] . '/' . $pathName);
            exit();
        }

        // Otherwise, if it's an API method:

        ApiHandler::returnResponseFromResponseObject($this -> apiResponse);
    }


    protected function throwConnectionError(){
        $this -> generateView('general/connection.php', 'Connection', 'connection/?errorMessage=' . self::CONNECTION_ERROR_DEFAULT_MESSAGE);
        exit();
    }

    protected function enableApiMode()
    {
        $this -> api = true;
    }
}