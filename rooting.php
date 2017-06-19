<?php

session_start();

$GLOBALS['root_dir'] = __DIR__;
include_once __DIR__ . '/utils/require.php';

/*
$path =   explode( '/', $_SERVER['REQUEST_URI']);
$globalPath = $path[2];
$globalPathInd = 2;
*/

// Exploding the path of the url
$path =   explode( '/', $_SERVER['REQUEST_URI']);

// Doing the same for physical adress on the computer/server
$completePath = explode('\\', __DIR__);
// Getting to know the name of the final Folder
$finalPath = $completePath[count($completePath) - 1];

// And finding it's position in the $path exploded url
$globalPathInd = array_search($finalPath, $path) + 1;

// Getting the main path to redirect user to the right path
$globalPath = $path[$globalPathInd];


// Creating the server root to be used later on with including css, js...
$GLOBALS['server_root'] = "";
$i = 0;
foreach ($path as $pth){
    if($i < $globalPathInd) {
        $GLOBALS['server_root'] .= $pth . '/';
    }
    $i++;
}



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
        $staticController = new ContactFormController();
        $staticController -> contactHK();
        break;
    case 'connect' :
        $userController = new UserController($db);
        $userController -> getDashboard();
        break;
    case 'user':
        if(isset($path[$globalPathInd + 1])) {
            switch ($path[$globalPathInd + 1]) {
                case 'edit' :
                    $userController = new UserController($db);
                    $userController->profileEditionPage();
                    break;
                case 'home' :
                    if(isset($path[$globalPathInd + 2]))
                    {
                        if(isset($path[$globalPathInd + 3])) {

                            switch ($path[$globalPathInd + 3])
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
        if(isset($path[$globalPathInd + 1])) {
            switch($path[$globalPathInd + 1]){
                case 'sensors':
                    if(isset($path[$globalPathInd + 2])) {
                        switch ($path[$globalPathInd + 2]) {
                            case 'fakeValues':
                                $sensorController = new SensorController($db);
                                $sensorController -> addRandomValuesToSensors();
                                break;
                            case 'frame':
                                $sensorController = new SensorController($db);
                                $sensorController -> getFrames();
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
                    if(isset($path[$globalPathInd + 2])) {
                        switch($path[$globalPathInd + 2]){
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
                    if(isset($path[$globalPathInd + 2])) {
                        switch($path[$globalPathInd + 2]){
                            case 'sensors':
                                if(isset($path[$globalPathInd + 3])){
                                    switch ($path[$globalPathInd + 3]){
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
                            case 'users':
                                $userGestionController = new UserGestionController($db);
                                $userGestionController -> searchUsers();
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
        if(isset($path[$globalPathInd + 1])) {
            switch ($path[$globalPathInd + 1]) {
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

    case 'disclaimer':
        $staticController = new StaticController();
        $staticController -> disclaimer();
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
