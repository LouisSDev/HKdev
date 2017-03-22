<?php

$dbConnector = new DatabaseConnection();
$db = $dbConnector -> getDatabase();

$user = new User();
$saveUser = $user
    ->setAddress("35 rue du Bac")
    ->setCellPhoneNumber("+3366085916")
    ->setCountry("France")
    ->setFirstName("Louis")
    ->setLastName("Steimberg")
    ->setMail("lalalo@hotmail.fr")
    ->save($db);
if($saveUser == null){
    echo "<h1> Oups Database error, please enter correct informations</h1>";
    echo $user->getErrorMessage();
}else{
    $saveUser = $user
        ->setAddress("28 rue Notre Dame Des Champs")
        ->setCellPhoneNumber("+3366085916")
        ->setCountry("France")
        ->setFirstName("Louis")
        ->setLastName("Steimberg")
        ->setMail("ia@hotmail.fr")
        ->save($db);
    if($saveUser == null){
        echo "<h1> Oups Database error, please enter correct informations</h1>";
        echo $user->getErrorMessage();
    }
}