<?php

session_start();

$GLOBALS['root_dir'] = __DIR__;
include_once __DIR__ . '/utils/require.php';


$path =   explode( '/', $_SERVER['REQUEST_URI']);
$globalPath = $path[2];


$GLOBALS['credentials'] = new UserCredentials();

// Connection to the database
$dbConnector = new DatabaseConnection();
$db = $dbConnector -> getDatabase();

$GLOBALS['timestamp_after_db_connection'] = microtime(true);



switch($globalPath){
    case 'home' :
        homepage($db);
        break;
    case '' :
        homepage($db);
        break;
    case 'connection' :
        $staticController = new StaticController();
        $staticController -> connection();
        break;
    case 'contact' :
        $staticController = new StaticController();
        $staticController -> contact();
        break;
    case 'connect' :
        $userController = new UserController($db);
        $userController -> getDashboard();
        break;
    case 'user':
        if(isset($path[3])) {
            switch ($path[3]) {
                case 'edit' :
                    $userController = new UserController($db);
                    $userController->profileEditionPage();
                    break;
                case 'home' :
                    if(isset($path[4]))
                    {
                        if(isset($path[5])) {

                            switch ($path[5])
                            {
                                case 'general' :
                                    $homeController = new HomeController($db);
                                    $homeController->displayGeneral();
                                    break;
                                case 'administrate' :
                                    $buildingController = new BuildingController($db);
                                    $buildingController->displayAdministration();
                                    break;
                                case 'sensors' :
                                    $homeController = new HomeController($db);
                                    $homeController -> buyNewSensor();
                                    break;
                                case 'deleteSensor' :
                                    $homeController = new HomeController($db);
                                    $homeController -> deleteSensor();
                                    break;
                                default :
                                    $staticController = new StaticController();
                                    $staticController -> notFound();
                            }
                        }
                        else{
                            $staticController = new StaticController();
                            $staticController -> notFound();
                        }
                    }
                    else
                    {
                        $staticController = new StaticController();
                        $staticController -> notFound();
                    }

                    break;
                case 'dashboard' :
                    $userController = new UserController($db);
                    $userController -> getDashboard(false);
                    break;
                case 'disconnect' :
                    $userController = new UserController($db);
                    $userController->disconnect();
                    break;
                default :
                    $staticController = new StaticController();
                    $staticController -> notFound();
            }
        }

        else{
            $userController = new UserController($db);
            $userController -> getDashboard(false);
        }

        break;
    case 'api':
        if(isset($path[3])) {
            switch($path[3]){
                case 'sensors':
                    if(isset($path[4])) {
                        switch ($path[4]) {
                            case 'fakeValues':
                                $sensorController = new SensorController($db);
                                $sensorController -> addRandomValuesToSensors();
                                break;
                            default :
                                header('HTTP/1.1 404 Not Found');
                                exit();
                        }
                    }
                    else{
                        header('HTTP/1.1 404 Not Found');
                        exit();
                    }
                    break;

                case 'edit' :
                    if(isset($path[4])) {
                        switch($path[4]){
                            case 'room' :
                                $roomController = new RoomController($db);
                                $roomController -> updateEffectorsInARoom();
                                break;
                            case 'home' :
                                $homeController = new HomeController($db, false);
                                $homeController -> updateEffectorsInAHome();
                                break;
                            default :
                                header('HTTP/1.1 404 Not Found');
                                exit();
                        }
                    }else{
                        header('HTTP/1.1 404 Not Found');
                        exit();
                    }
                    break;

                case 'get' :
                    if(isset($path[4])) {
                        switch($path[4]){
                            case 'sensors':
                                if(isset($path[5])){
                                    switch ($path[5]){
                                        case 'values' :
                                            $sensorController = new SensorController($db);
                                            $sensorController -> getSensorValues();
                                            break;
                                        default:
                                            header('HTTP/1.1 404 Not Found');
                                            exit();
                                    }
                                }else{
                                    header('HTTP/1.1 404 Not Found');
                                    exit();
                                }
                                break;
                            default:
                                header('HTTP/1.1 404 Not Found');
                                exit();
                        }
                    }else{
                        header('HTTP/1.1 404 Not Found');
                        exit();
                    }
                    break;
                default:
                    header('HTTP/1.1 404 Not Found');
                    exit();
            }
        }else{
            header('HTTP/1.1 404 Not Found');
            exit();
        }
        break;

    case 'admin':
        if(isset($path[3])) {
            switch ($path[3]) {
                case 'user' :
                    $userGestionController = new UserGestionController($db);
                    $userGestionController -> manageHomeUsers();
                    break;
                case 'products' :
                    $backOfficeController = new BackOfficeController($db);
                    $backOfficeController -> manageProducts();
                    break;
                case 'quotes' :
                    $backOfficeController = new BackOfficeController($db);
                    $backOfficeController -> quoteValidation();
                    break;
                case 'dashboard' :
                    $backOfficeController = new BackOfficeController($db);
                    $backOfficeController -> getAdminDashboard();
                    break;
                default :
                    $staticController = new StaticController();
                    $staticController -> notFound();
            }
        }else{
            $backOfficeController = new BackOfficeController($db);
            $backOfficeController -> getAdminDashboard();
            break;
        }
        break;


    // TODO To delete!!!
    case 'lol':
        $AdminController = new AdminStaticController();
        $AdminController ->sendMail();
        require_once __DIR__ . '/view/tests/lol.php';
        break;

    case 'mentionlegal':
        require_once __DIR__ .'/view/static/mentionLegal.php';
        break;

    case '404' :
        $staticController = new StaticController();
        $staticController -> notFound();
        break;
    default :
        $staticController = new StaticController();
        $staticController -> notFound();
}



function homepage($db){

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        /** @var SecurityController $securityController */
        $securityController = new SecurityController($db);
        $securityController -> signUp();
    }else
    {
        $staticController = new StaticController();
        $staticController -> homepage();
        require_once __DIR__ . '/view/static/homepage.php';
    }
}
