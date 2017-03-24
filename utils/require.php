<?php


require_once "lib/requireLibs.php";
require_once "utils/randomHash.php";
require_once "utils/devLogs.php";
require_once "utils/DatabaseConnection.php";
require_once  "utils/JsonUtils.php";

// Models
require_once "model/DatabaseEntity.php";

// User
require_once "model/user/User.php";
require_once "model/user/UserRepository.php";

// Home
require_once  "model/home/Home.php";

// Building
require_once  "model/building/Building.php";



// Error Logging Facilities
require_once "LoggerException.php";
class logException extends LoggerException {}


