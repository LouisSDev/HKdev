<?php


require_once "lib/requireLibs.php";
require_once "utils/utils.php";
require_once "utils/devLogs.php";
require_once "utils/DatabaseConnection.php";
require_once "utils/JsonUtils.php";
require_once "utils/UserCredentials.php";


// Models
require_once "model/DatabaseEntity.php";
require_once "model/Repository.php";

    // User
    require_once "model/User/User.php";
    require_once "model/User/UserRepository.php";

    // Home
    require_once  "model/Home/Home.php";
    require_once "model/Home/HomeRepository.php";

    // Room
    require_once  "model/Room/Room.php";
    require_once "model/Room/RoomRepository.php";

    // SensorType
    require_once  "model/Sensortype/SensorType.php";
    require_once "model/Sensortype/SensorTypeRepository.php";

    // Effector
    require_once  "model/Effector/Effector.php";
    require_once "model/Effector/EffectorRepository.php";

    // EffectorType
    require_once  "model/Effectortype/EffectorType.php";
    require_once "model/Effectortype/EffectorTypeRepository.php";

    // Sensor
    require_once  "model/Sensor/Sensor.php";
    require_once "model/Sensor/SensorRepository.php";

    // SensorValue
    require_once  "model/Sensorvalue/SensorValue.php";
    require_once "model/Sensorvalue/SensorValueRepository.php";



// Controllers
require_once "controller/Controller.php";
require_once "controller/AccountManagingController.php";

    // User
    require_once "controller/UserController.php";

    // Security
    require_once "controller/SecurityController.php";

    // Home
    require_once "controller/HomeController.php";

    // Room
    require_once "controller/RoomController.php";




// Error Logging Facilities
require_once "LoggerException.php";
class logException extends LoggerException {}


