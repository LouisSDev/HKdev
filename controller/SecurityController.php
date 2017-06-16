<?php

/**
 * Created by PhpStorm.
 * User: LOUISSTEIMBERG
 * Date: 28/04/2017
 * Time: 09:13
 */
class SecurityController extends Controller
{

    const MAX_FILE_SIZE = 300000;
    const AUTHORIZED_EXTENSIONS = array('jpg', 'jpeg', 'png', 'pdf');

    public function signUp()
    {
        // We create the user from an array : POST vars array
        $user = new User();
        $user -> createFromResults($_POST);

        // We set the password
        $user -> setPassword("");


        // If the save method is thrown, we'll forward it to the controller
        if(!$user -> getValid() || $user -> isError()){
            $this -> args ['error_message'] = 'Les informations entrées ne sont pas valides';
            $this -> args['errors'] = $user -> getErrorMessage();
            $this -> generateView('static/homepage.php', 'Home');
        }

        if($GLOBALS['repositories']['user'] -> isMailAlreadyUsed($user -> getMail())){
            $this -> args ['error_message'] = 'Cet adresse e-mail est déjà utilisée pour un autre compte HK!';
            $this -> generateView('static/homepage.php', 'Home');
        }


        if (empty($_FILES['quote']) || $_FILES['quote']['error'] != 0  || empty($_FILES['quote']['tmp_name']) ) {
            $this -> args ['error_message'] = 'Vous n\'avez pas selectionné de fichier.';
            $this -> generateView('static/homepage.php', 'Home');
        }

        //If the files is not too big
        if ($_FILES['quote']['size'] > self::MAX_FILE_SIZE) {
            $this -> args['error_message'] = 'Le fichier selectionné est trop lourd, il doit faire moins de 300ko';
            $this -> generateView('static/homepage.php', 'Home');
        }


        $fileInformation = pathinfo($_FILES['quote']['name']);
        if (!in_array($fileInformation['extension'], self::AUTHORIZED_EXTENSIONS)) {
            $this -> args ['error_message'] = 'Ce type de fichier n\'est pas accepté veuillez choisir un fichier dans un des formats suivants: ';
            foreach(self::AUTHORIZED_EXTENSIONS as $authExt){
                $this -> args['error_message'] .= $authExt . ' ';
            }
            $this -> generateView('static/homepage.php', 'Home');
        }

        $quoteFileRelativePath = 'uploads/quotes/' . uniqid() . '.' . $fileInformation['extension'];
        $quoteFilePath = $GLOBALS['root_dir'] . '/'. $quoteFileRelativePath;

        move_uploaded_file($_FILES['quote']['tmp_name'], $quoteFilePath );

        $user -> setQuoteFilePath($quoteFileRelativePath);

        $user -> save($this -> db);
        $subject = "Informations relatives à votre compte";
        $body = "<!DOCTYPE html>"."<html><body>"."<h1>Bonjour ".$user->getFirstName()."</h1><br>".
            "Votre inscription a bien été prise en compte.<br>".
            "Votre demande sera traitée par un administrateur dans les plus brefs délais.<br><br>".
            "L'équipe HomeKeeper".
            "</body>".
            "</html>";
        $this->sendMail($user->getMail(),$user->getFirstName(),$subject,$body);

        $this -> args['registration'] = true;
        $this -> args['success_message'] = 'Votre envoi de devis a bien été pris en compte';
        $this -> generateView('static/homepage.php', 'Home');

    }

}