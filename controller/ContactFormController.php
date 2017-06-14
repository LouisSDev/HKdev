<?php

/**
 * Created by PhpStorm.
 * User: Desazars
 * Date: 02/06/2017
 * Time: 10:54
 */
class ContactFormController extends Controller{

    public function choiceForm()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!empty($_POST['submittedForm'])) {

                switch ($_POST['submittedForm']) {
                    case 'CONTACT':
                        $this->sendForm();
                        break;
                    default:
                        $this->generateView('static/404.php', '404');

                }
            } else {
                $this->generateView('static/404.php', '404');

            }

        }
    }

    public function contactHK(){

        $this -> args['user'] = $this -> user;
        if($_SERVER['REQUEST_METHOD'] === 'POST') {


            if(!empty($_POST['message'])) {

                $sendMail = true;

                if ($this->user) {

                    $lastName = $this->user->getLastName() . ' (id du client : ' . $this -> user -> getId() . ')';
                    $firstName = $this->user->getFirstName();
                    $email = $this->user->getMail();

                } elseif (!empty($_POST['lastName']) && !empty($_POST['firstName']) && !empty($_POST['email'])) {

                    $lastName = $_POST['lastName'];
                    $firstName = $_POST['firstName'];
                    $email = $_POST['email'];

                } else {
                    $sendMail = false;
                    $this->args['error_message'] = 'Veuillez remplir tous les champs';
                }

                if($sendMail){

                    $message = $_POST['message'];
                    $subject = "Demande d'informations";
                    $body = "<h1>Bonjour,</h1><br>" .
                        $firstName . " " . $lastName . " souhaiterait avoir des détails. Voici le mail qu'il vous a envoyé :" . "<br>" .
                        $message . "<br>" .
                        "-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-" . "<br>" .
                        "Vous pouvez lui répondre à l'adresse mail suivante : " . $email;

                    $this->sendMail($GLOBALS['confMail']->username, $firstName . " " . $lastName, $subject, $body);

                    $this->args['success_message'] = "Félicitations le mail a bien été envoyé, vous recevrez bientôt une réponse!";

                }

            }else {
                $this->args['error_message'] = 'Veuillez remplir tous les champs';
            }
        }

        $this -> generateView('static/contactPage.php', 'Contactez Nous!' );

    }

}
