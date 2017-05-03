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


/*
$home = new Home();
$home
    -> setCity('Paris')
    -> setAddress('35 rue Goulani')
    -> setCountry('France')
    -> setName('La Maison d\'Ismael')
    -> setBuilding($home);


$user = new User();
$saveUser = $user
    ->setAddress("35 rue du Bac")
    ->setCellPhoneNumber("+3366085916")
    ->setCountry("France")
    ->setFirstName("Louis")
    ->setAddress('35 Rue Goulani')
    ->setLastName("Steimberg")
    ->setMail("clalal@hotmail.fr")
    ->setNewPassword("test", "", "test", true)
    ->setCity('Paris')
    ->addHome($home)
    ->save($db);
if($saveUser == null){
    echo "<h1> Oups Database error, please enter correct informations</h1>";
    echo $user->getErrorMessage();
}else{
    $saveUser = $user
        ->setMail("lalapopo@hotmail.fr")
        ->setNewPassword("test", "test1", "test1", true)
        ->save($db);

    $homes = $user  -> getHomes() ;

    /** @var Home $hms */
/*    foreach($homes as $hms){
        echo $hms -> getName();
    }

    if($saveUser == null){
        echo "<h1> Oups Database error, please enter correct informations</h1>";
        echo $user->getErrorMessage();
    }
}
*/