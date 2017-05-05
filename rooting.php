<?php
session_start();
include_once "utils/require.php";


$path =   explode( "/", $_SERVER['REQUEST_URI']);
$globalPath = $path[2];

$GLOBALS['root_dir'] = __DIR__;

$GLOBALS['credentials'] = new UserCredentials();

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
    case "connection" :
        require_once "view/connection.php";
        break;
    case "contactpage" :
        require_once "view/contactpage.php";
        break;
    case "connect" :
        $userController = new UserController($db);
        $userController -> getDashboard();
        break;

    case "user":
        if(isset($path[3])) {
            switch ($path[3]) {
                case "edit":
                    require_once "view/editProfile.php";
                    break;
                case "editInfo" :
                    $userController = new UserController($db);
                    $userController->editInfo();
                    break;
                case "home" :
                    if(isset($path[4]))
                    {
                        if(isset($path[5])) {

                            // TODO : home/{homeId}
                            switch ($path[5])
                            {
                                case "rooms" :
                                    // TODO
                                    break;
                                case "general" :
                                    // TODO
                                    break;

                            }
                        }
                        else{
                            require_once "view/myHome.php";
                        }
                    }

                    else
                    {
                        require_once "view/404.php";
                    }

                    break;
                case "dashboard" :
                    $userController = new UserController($db);
                    $userController -> getDashboard(false);
                    break;
                case "editPass" :
                    $userController = new UserController($db);
                    $userController->modifyExistingPasswordAction();
                    break;
                case "editEmail":
                    $userController = new UserController($db);
                    $userController->editEmailAddress();
                    break;
                default :
                    require_once "view/404.php";
            }
        }

        else{
            require_once "view/myHome.php";
        }
        break;
    case "test":
        require_once "test.php";
        break;
    default :
        require_once "view/404.php";
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