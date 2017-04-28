<?php

/**
 * Created by PhpStorm.
 * User: LOUISSTEIMBERG
 * Date: 28/04/2017
 * Time: 09:13
 */
class SecurityController extends Controller
{

    const MAX_FILE_SIZE = 1000000;

    public function signUp()
    {
        // We create the user from an array : POST vars array
        $user = new User();
        $user -> createFromResults($_POST);

        // We set the password
        $user -> setNewPassword($_POST['password'], '', $_POST['passwordRepeat'], false);


        // If the save method is thrown, we'll forward it to the controller
        if(!$user -> save($this -> db)){
            $this -> args ['error'] = $user -> getErrorMessage();
            $this -> generateView('homepage.php');
        }


        if (isset($_FILES['file']) AND $_FILES['file']['error'] == 0) {
            // Testons si le fichier n'est pas trop gros
            if ($_FILES['file']['size'] <= self::MAX_FILE_SIZE) {

                // Testons si l'extension est autorisée
                $infosfichier = pathinfo($_FILES['file']['name']);
                $extension_upload = $infosfichier['extension'];
                $extensions_autorisees = array('jpg', 'jpeg', 'png', 'pdf');
                if (in_array($extension_upload, $extensions_autorisees)) {
                    // On peut valider le fichier et le stocker définitivement
                    move_uploaded_file($_FILES['file']['tmp_name'], 'uploads/' . basename($_FILES['file']['name']));
                    echo "L'envoi a bien été effectué !";
                }
            }
        }
    }

}