<?php

class DatabaseConnection
{
    var $db;

    public function __construct(){
        $dbConfig = JsonUtils::decodeJsonFileOrFail('config/config.json') -> database;

        $dbhostname = $dbConfig->database_host;

        $dbname = $dbConfig->database_name;

        $dbhost = 'mysql:host=' . $dbhostname . ';dbname=' . $dbname . ';charset=utf8';

        $dbidentifier = $dbConfig->database_user;

        $dbpw = $dbConfig->database_password;

        try {
            $this->db = new PDO($dbhost, $dbidentifier, $dbpw ,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        }
        catch (Exception $e){
            require_once "view/connectionError.php";
            exit;
        }
    }

    public function getDatabase(){
        return $this->db;
    }

}