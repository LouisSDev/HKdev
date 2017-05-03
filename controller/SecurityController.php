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
        global $_FILE;
        // We create the user from an array : POST vars array
        $user = new User();
        $user -> createFromResults($_POST);

        // We set the password
        $user -> setPassword(null);
        $user -> setNewPassword($_POST['password'], '', $_POST['passwordRepeat'], false);


        // If the save method is thrown, we'll forward it to the controller
        if(!$user -> getValid() || $user -> isError()){
            $this -> args ['error'] = $user -> getErrorMessage();
            $this -> generateView('homepage.php', 'home');
        }

        if($GLOBALS['repositories']['user'] -> isMailAlreadyUsed($user -> getMail())){
            $this -> args ['error'] = 'Cet adresse e-mail est déjà utilisée pour un autre compte HK!';
            $this -> generateView('homepage.php', 'home');
        }


        if (!isset($_FILES['file'])|| $_FILES['file']['error'] != 0  || empty($_FILES['file']['tmp_name']) ) { //
            $this -> args ['error'] = 'Vous n\'avez pas selectionné de fichier.';
            $this -> generateView('homepage.php', 'home');
        }

        //If the files is not too big
        if ($_FILES['file']['size'] > self::MAX_FILE_SIZE) {
            $this -> args['error'] = 'Le fichier selectionné est trop lourd, il doit faire moins de 300ko';
            $this -> generateView('homepage.php', 'home');
        }


        $fileInformation = pathinfo($_FILES['file']['name']);
        if (!in_array($fileInformation['extension'], self::AUTHORIZED_EXTENSIONS)) {
            $this -> args ['error'] = 'Ce type de fichier n\'est pas accepté veuillez choisir un fichier dans un des formats suivants: ';
            foreach(self::AUTHORIZED_EXTENSIONS as $authExt){
                $this -> args['error'] .= $authExt . ' ';
            }
            $this -> generateView('homepage.php', 'home');
        }

        $quoteFileRelativePath = '/uploads/quotes/' . uniqid() . '.' . $fileInformation['extension'];
        $quoteFilePath = $GLOBALS['root_dir'] .$quoteFileRelativePath;

        move_uploaded_file($_FILES['file']['tmp_name'], $quoteFilePath );


        $user -> setQuoteFilePath($quoteFilePath);

        $user -> save($this -> db);

        $this -> args['registration'] = true;
        $this -> generateView('homepage.php', 'home');

    }

}