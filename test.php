<?php

require_once"utils/require.php";
// Connection to the database
$dbConnector = new DatabaseConnection();
$db = $dbConnector -> getDatabase();
 //$user = new UserRepository($db,$dbConnector);
 //$user->connect('ismael.goulani@yahoo.fr','storm19' );
if($GLOBALS['view']['user']->getErrorMessage()){
    echo ($GLOBALS['error']);

}
else{
    echo ($GLOBALS['success_message']);
}

?>


