<?php


if($GLOBALS['repositories']['user'] -> isConnected()){
    // The user is connected, we'll probably open a special page for him


}else{

}

$home = new Home();
$home
    -> setCity('Paris')
    -> setAddress('35 rue Goulani')
    -> setCountry('France')
    -> setName('La Maison d\'Ismael');


$user = new User();
$saveUser = $user
    ->setAddress("35 rue du Bac")
    ->setCellPhoneNumber("+3366085916")
    ->setCountry("France")
    ->setFirstName("Louis")
    ->setLastName("Steimberg")
    ->setMail("clalal@hotmail.fr")
    ->setPassword("test", "", "test", true)
    ->setCity('Paris')
    ->addHome($home)
    ->save($db);
if($saveUser == null){
    echo "<h1> Oups Database error, please enter correct informations</h1>";
    echo $user->getErrorMessage();
}else{
    $saveUser = $user
        ->setMail("lalapopo@hotmail.fr")
        ->setPassword("test", "test1", "test1", true)
        ->save($db);
    if($saveUser == null){
        echo "<h1> Oups Database error, please enter correct informations</h1>";
        echo $user->getErrorMessage();
    }
}
?>
