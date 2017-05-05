<?php

require_once"utils/require.php";
// Connection to the database
$dbConnector = new DatabaseConnection();
$db = $dbConnector -> getDatabase();

if($GLOBALS['view']['user']->getErrorMessage()){
    echo ($GLOBALS['error']);

}
else{
    echo ($GLOBALS['success_message']);
}

?>


