<?php


require_once $GLOBALS['root_dir'] . '/lib/requireLibs.php';
require_once $GLOBALS['root_dir'] . '/utils/Utils.php';
require_once $GLOBALS['root_dir'] . '/utils/DatabaseConnection.php';
require_once $GLOBALS['root_dir'] . '/utils/JsonUtils.php';
require_once $GLOBALS['root_dir'] . '/utils/UserCredentials.php';
require_once $GLOBALS['root_dir'] . '/utils/ApiHandler.php';
require_once $GLOBALS['root_dir'] . '/utils/ApiResponse.php';

// Models
require_once $GLOBALS['root_dir'] . '/model/DatabaseEntity.php';
require_once $GLOBALS['root_dir'] . '/model/Repository.php';

    // User
    require_once $GLOBALS['root_dir'] . '/model/User/User.php';
    require_once $GLOBALS['root_dir'] . '/model/User/UserRepository.php';

    // Home
    require_once $GLOBALS['root_dir'] . '/model/Home/Home.php';
    require_once $GLOBALS['root_dir'] . '/model/Home/HomeRepository.php';

    // Room
    require_once $GLOBALS['root_dir'] . '/model/Room/Room.php';
    require_once $GLOBALS['root_dir'] . '/model/Room/RoomRepository.php';

    // SensorType
    require_once $GLOBALS['root_dir'] . '/model/Sensortype/SensorType.php';
    require_once $GLOBALS['root_dir'] . '/model/Sensortype/SensorTypeRepository.php';

    // Effector
    require_once $GLOBALS['root_dir'] . '/model/Effector/Effector.php';
    require_once $GLOBALS['root_dir'] . '/model/Effector/EffectorRepository.php';

    // EffectorType
    require_once $GLOBALS['root_dir'] . '/model/Effectortype/EffectorType.php';
    require_once $GLOBALS['root_dir'] . '/model/Effectortype/EffectorTypeRepository.php';

    // Sensor
    require_once $GLOBALS['root_dir'] . '/model/Sensor/Sensor.php';
    require_once $GLOBALS['root_dir'] . '/model/Sensor/SensorRepository.php';

    // SensorValue
    require_once $GLOBALS['root_dir'] . '/model/Sensorvalue/SensorValue.php';
    require_once $GLOBALS['root_dir'] . '/model/Sensorvalue/SensorValueRepository.php';



// Controllers
require_once $GLOBALS['root_dir'] . '/controller/Controller.php';
require_once $GLOBALS['root_dir'] . '/controller/AccountManagingController.php';
require_once $GLOBALS['root_dir'] . '/controller/AdminController.php';

    // User
    require_once $GLOBALS['root_dir'] . '/controller/UserController.php';

    // Security
    require_once $GLOBALS['root_dir'] . '/controller/SecurityController.php';

    // Home
    require_once $GLOBALS['root_dir'] . '/controller/HomeController.php';

    // Room
    require_once $GLOBALS['root_dir'] . '/controller/RoomController.php';

    // Static
    require_once $GLOBALS['root_dir'] . '/controller/StaticController.php';

    // Building
    require_once $GLOBALS['root_dir'] . '/controller/BuildingController.php';

    // Sensor
    require_once $GLOBALS['root_dir'] . '/controller/SensorController.php';


    // MultiEditingControllers
    require_once $GLOBALS['root_dir'] . '/controller/MultiEditControllers/AdminLoggingsFormController.php';
    require_once $GLOBALS['root_dir'] . '/controller/MultiEditControllers/DashboardController.php';
    require_once $GLOBALS['root_dir'] . '/controller/MultiEditControllers/AdminStaticController.php';

    //BackOffice
    require_once $GLOBALS['root_dir'] . '/controller/BackOfficeController.php';


// Error Logging Facilities
require_once __DIR__ . '/LoggerException.php';
// We'll now initiate logging abilities
class LogException extends LoggerException {}
Utils::initiateLogging();

