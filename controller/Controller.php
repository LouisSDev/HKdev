<?php

abstract class Controller
{

    const CONNECTION_ERROR_DEFAULT_MESSAGE = "Mauvais identifiants!";
    const TIMESTAMP_ANALYSIS_ACTIVATED = false;

    protected $connectionRequired = false;

    protected $connected = false;

    protected $args = array();

    protected $api = false;

    protected $adminPage = false;

    /** @var ApiResponse $apiResponse */
    protected $apiResponse = null;


    private $mailTransport = null;

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


        if(self::TIMESTAMP_ANALYSIS_ACTIVATED) {
            Utils::analyzeTimeExecution();
        }

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

    /**
     * @return UserRepository
     */
    protected function getUserRepository(){
        return $GLOBALS['repositories']['user'];
    }

    /**
     * @return EffectorRepository
     */
    protected function getEffectorRepository(){
        return $GLOBALS['repositories']['effector'];
    }

    /**
     * @return EffectorTypeRepository
     */
    protected function getEffectorTypeRepository(){
        return $GLOBALS['repositories']['effectorType'];
    }

    /**
     * @return SensorRepository
     */
    protected function getSensorRepository(){
        return $GLOBALS['repositories']['sensor'];
    }

    /**
     * @return SensorTypeRepository
     */
    protected function getSensorTypeRepository(){
        return $GLOBALS['repositories']['sensorType'];
    }

    /**
     * @return SensorValueRepository
     */
    protected function getSensorValueRepository(){
        return $GLOBALS['repositories']['sensorValue'];
    }

    /**
     * @return RoomRepository
     */
    protected function getRoomRepository(){
        return $GLOBALS['repositories']['room'];
    }

    /**
     * @return HomeRepository
     */
    protected function getHomeRepository(){
        return $GLOBALS['repositories']['home'];
    }


    protected function enableApiMode()
    {
        $this -> api = true;
    }

    protected function getMail()
    {
        if($this -> mailTransport){
            return $this -> mailTransport;
        }
        else{
            $confMail = $GLOBALS['confMail'];
            $server = $confMail -> server;
            $port = $confMail -> port;
            $username = $confMail -> username;
            $password = $confMail -> password;
            $this -> mailTransport = Swift_SmtpTransport::newInstance($server,$port,"ssl");
            $this ->mailTransport -> setUsername($username);
            $this ->mailTransport -> setPassword($password);
            return $this->mailTransport;
        }
    }


}