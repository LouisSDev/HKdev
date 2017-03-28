<?php

$dbConnector = new DatabaseConnection();
$db = $dbConnector -> getDatabase();

if($GLOBALS['repositories']['user'] -> isConnected()){
    // The user is connected, we'll probably open a special page for him


}

/*
$user = new User();
$saveUser = $user
    ->setAddress("35 rue du Bac")
    ->setCellPhoneNumber("+3366085916")
    ->setCountry("France")
    ->setFirstName("Louis")
    ->setLastName("Steimberg")
    ->setMail("lasde@hotmail.fr")
    ->setPassword("test", "", "test", true)
    ->save($db);
if($saveUser == null){
    echo "<h1> Oups Database error, please enter correct informations</h1>";
    echo $user->getErrorMessage();
}else{
    $saveUser = $user
        ->setMail("lrd@hotmail.fr")
        ->setPassword("test", "test1", "test1", true)
        ->save($db);
    if($saveUser == null){
        echo "<h1> Oups Database error, please enter correct informations</h1>";
        echo $user->getErrorMessage();
    }
}
*/

?>