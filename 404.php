<?php

$dbConnector = new DatabaseConnection();
$db = $dbConnector -> getDatabase();

require_once 'view/404.php';