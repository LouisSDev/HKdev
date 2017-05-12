<?php

class DatabaseConnection
{
    /**
     * @var PDO
     */
    var $db;

    public function __construct(){
        $config = JsonUtils::decodeJsonFileOrFail('config/config.json');
        $dbConfig = $config -> database;

        $dbhostname = $dbConfig->database_host;

        $dbname = $dbConfig->database_name;

        $dbhost = 'mysql:host=' . $dbhostname . ';dbname=' . $dbname . ';charset=utf8';

        $dbidentifier = $dbConfig->database_user;

        $dbpw = $dbConfig->database_password;

        try {
            $this->db = new PDO($dbhost, $dbidentifier, $dbpw ,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            $GLOBALS['salt'] = $config -> password_salt;
            $GLOBALS['server_root'] = $config -> server_root;

            $this->createRepositories();
        }
        catch (Exception $e){

            // TODO :: the get message line must be uncommented in the prod version!!
            echo $e -> getMessage();
            require_once "view/static/connectionError.php";
            exit;
        }

    }


    public function getDatabase(){
        return $this->db;
    }

    private function createRepositories(){
        $GLOBALS['repositories']['user'] = new UserRepository($this->db, $this);
        if($GLOBALS['credentials'] -> isConnectionTried() ) {
            $GLOBALS['repositories']['user'] -> connectFromGlobals();
        }
    }

    // Called only if a user is connected
    public function createOtherRepositories(){

        /** @var User $user */
        $user = $GLOBALS['repositories']['user'] -> getUser();

        $GLOBALS['repositories']['home'] = new HomeRepository($this->db, $user );
        $GLOBALS['repositories']['room'] = new RoomRepository($this->db, $user );
        $GLOBALS['repositories']['effector'] = new EffectorRepository($this->db, $user);
        $GLOBALS['repositories']['effector_type'] = new EffectorTypeRepository($this->db, $user);
        $GLOBALS['repositories']['sensor'] = new SensorRepository($this->db, $user);
        $GLOBALS['repositories']['sensor_type'] = new SensorTypeRepository($this->db, $user);
        $GLOBALS['repositories']['sensor_value'] = new SensorValueRepository($this->db, $user);
    }



}