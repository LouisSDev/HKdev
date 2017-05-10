<?php
session_start();
include_once 'utils/require.php';


$path =   explode( '/', $_SERVER['REQUEST_URI']);
$globalPath = $path[2];

$GLOBALS['root_dir'] = __DIR__;

$GLOBALS['credentials'] = new UserCredentials();

// Connection to the database
$dbConnector = new DatabaseConnection();
$db = $dbConnector -> getDatabase();


switch($globalPath){
    case 'home' :
        homepage($db);
        break;
    case '' :
        homepage($db);
        break;
    case 'connection' :
        require_once __DIR__ . '/view/connection.php';
        break;
    case 'contact' :
        require_once __DIR__ . '/view/contactPage.php';
        break;
    case 'connect' :
        $userController = new UserController($db);
        $userController -> getDashboard();
        break;
    case 'user':
        if(isset($path[3])) {
            switch ($path[3]) {
                case 'edit':
                    require_once __DIR__ . '/view/editProfile.php';
                    break;
                case 'editInfo' :
                    $userController = new UserController($db);
                    $userController->editInfo();
                    break;
                case 'home' :
                    if(isset($path[4]))
                    {
                        if(isset($path[5])) {

                            switch ($path[5])
                            {
                                case 'rooms' :
                                    $homeController = new HomeController($db);
                                    $homeController->displayRooms($path[4]);
                                    break;
                                case 'general' :
                                    $homeController = new HomeController($db);
                                    $homeController->displayGeneral($path[4]);
                                    break;
                                case 'administrate' :
                                    $homeController = new HomeController($db);
                                    $homeController->displayAdministration($path[4]);
                                    break;
                                case 'sensors' :
                                    $homeController = new HomeController($db);
                                    $homeController -> buyNewSensor($path[4]);
                                    break;
                                default :
                                    require_once __DIR__ . '/view/404.php';
                            }
                        }
                        else{
                            require_once __DIR__ . '/view/404.php';
                        }
                    }
                    else
                    {
                        require_once __DIR__ . '/view/404.php';
                    }

                    break;
                case 'dashboard' :
                    $userController = new UserController($db);
                    $userController -> getDashboard(false);
                    break;
                case 'editPass' :
                    $userController = new UserController($db);
                    $userController->modifyExistingPasswordAction();
                    break;
                case 'editEmail':
                    $userController = new UserController($db);
                    $userController->editEmailAddress();
                    break;
                default :
                    require_once __DIR__ . '/view/404.php';
            }
        }

        else{
            require_once __DIR__ . '/view/myHome.php';
        }

        break;
    case 'api':
        if(isset($path[3])) {
            switch($path[3]){
                case 'edit' :
                    if(isset($path[4])) {
                        switch($path[4]){
                            case 'room' :

                                break;
                            case 'home' :

                                break;
                            default :
                                header('HTTP/1.1 404 Not Found');
                                exit();
                        }
                    }else{
                        switch($path[4]){
                            case 'room' :

                                break;
                            case 'home' :

                                break;
                            default :
                                header('HTTP/1.1 404 Not Found');
                                exit();
                        }
                        header('HTTP/1.1 404 Not Found');
                        exit();
                    }
                    break;
                case 'get' :
                    if(isset($path[4])) {

                    }else{
                        header('HTTP/1.1 404 Not Found');
                        exit();
                    }
                    break;
            }
        }else{
            header('HTTP/1.1 404 Not Found');
            exit();
        }
        break;
    case 'test':
        require_once __DIR__ . '/test.php';
        break;

    case '404' :
        require_once __DIR__ . '/view/404.php';
        break;
    default :
        require_once __DIR__ . '/view/404.php';
}

function homepage($db){
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        /** @var SecurityController $securityController */
        $securityController = new SecurityController($db);
        $securityController -> signUp();
    }else
    {
        require_once __DIR__ . '/view/homepage.php';
    }
}