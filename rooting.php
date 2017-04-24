<?php
include_once "utils/require.php";


$path =   explode( "/", $_SERVER['REQUEST_URI']);
$globalPath = $path[2];

// Connection to the database
$dbConnector = new DatabaseConnection();
$db = $dbConnector -> getDatabase();


switch($globalPath){
    case "home" :
        require_once "homepage.php";
        require_once "view/homepage.php";
        break;
    case "" :
        require_once "homepage.php";
        require_once "view/homepage.php";
        break;
    case "backoffice" :
        require_once "adminpage.php";
        break;
    case "connection" :
        require_once "view/connection.php";
        break;
    case "test" :
        require_once "test.php";
        break;
    default :
        require_once "404.php";
}
