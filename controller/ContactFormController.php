<?php

/**
 * Created by PhpStorm.
 * User: Desazars
 * Date: 02/06/2017
 * Time: 10:54
 */
class ContactFormController extends Controller
{

    public function sendFrom(){
        if(!empty($_POST['message']) && !empty($_POST['lastName']) && !empty($_POST['firstName']) && !empty($_POST['email'])){
            $message = $_POST['message'];
            $lastName = $_POST['lastName'];
            $firstName = $_POST['firstName'];
            $email = $_POST['email'];
            $subject = "Demande d'informations";
            $body = "<h1>Bonjour,</h1><br>".
                $firstName ." ". $lastName . "souhaiterait avoir des détails. Voici le mail qu'il vous a envoyé :"."<br>".
            $message."<br>".
            "-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-"."<br>".
            "Vous pouvez lui répondre à l'adresse mail suivante : ". $email;

            $this->sendMail($GLOBALS['confMail']->username,$firstName." ".$lastName,$subject,$body);
            $this -> generateView('static/homepage.php', 'Home');
        }else{
            echo 'Les données entrées ne sont pas valides';
        }
    }


}

?>