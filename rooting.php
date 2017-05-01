<?php
include_once "utils/require.php";


$path =   explode( "/", $_SERVER['REQUEST_URI']);
$globalPath = $path[2];

$GLOBALS['root_dir'] = __DIR__;

new UserCredentials();

// Connection to the database
$dbConnector = new DatabaseConnection();
$db = $dbConnector -> getDatabase();


switch($globalPath){
    case "home" :
        homepage($db);
        break;
    case "" :
        homepage($db);
        break;
    case "backoffice" :
        require_once "adminpage.php";
        break;
    case "connection" :
        require_once "view/connection.php";
        break;
    case "contactpage" :
        require_once "view/contactpage.php";
        break;
    case "editProfile":
        require_once "View/editProfile.php";
        break;
    case "connect" :
        $userController = new UserController($db);
        $userController -> getDashboard();
        break;
    case "updatePass" :
        $userController = new UserController($db);
        $userController->modifyExistingPasswordAction();
        break;
    case "updateEmail":
        $userController = new UserController($db);
        $userController->editEmailAddress();
        break;
    case "updateInfos":
        $userController = new UserController($db);
        $userController->editInfos();
        break;
    case "test":
        require_once "test.php";
        break;
    case "myhome" :
        require_once "view/myHome.php";
        break;
    default :
        require_once "404.php";
}


function homepage($db){
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        /** @var SecurityController $securityController */
        $securityController = new SecurityController($db);
        $securityController -> signUp();
    }else{
        require_once "view/homepage.php";
    }
}