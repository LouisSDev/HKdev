<?php
include_once "utils/require.php";


$path =   explode( "/", $_SERVER['REQUEST_URI']);
$globalPath = $path[2];

$GLOBALS['root_dir'] = __DIR__;

new UserCredentials();

// Connection to the database
$dbConnector = new DatabaseConnection();
$db = $dbConnector -> getDatabase();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Chart</title>
</head>

<link rel="stylesheet" href="<?php echo $GLOBALS['server_root']?>/ressources/css/chart.css">

<body>
<svg width="960" height="500"></svg>

<script src="https://d3js.org/d3.v4.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="<?php echo $GLOBALS['server_root']?>/ressources/js/example/chartExample.js"></script>
</body>
</html>
