<?php

class UserController extends Controller
{
    protected $connectionRequired = true;

    public function getDashboard()
    {
        $this->generateView('dashboard.php');
    }

    public function modifyExistingPasswordAction()
    {
        if (!empty($_POST['newPassword'])
            && !empty($_POST['confirmNewPassword'])
            && !empty($_POST['oldPassword'])) {

               $this -> user->setNewPassword($_POST['oldPassword'], $_POST['newPassword'], $_POST['confirmNewPassword'], $encrypt = true);
               if($this -> user -> save($this -> db)) {
                   $this->args['succes_message'] = "Félicitations! Votre profil a bien été édité";
               }else{
                   $this->args['error'] = $this -> user -> getErrorMessage();
               }

               $this->generateView('editProfile.php');
           }
        else{
            $this->args['error'] = "Vous devez obligatoirement remplir les champs";
            $this->generateView('editProfile.php');
        }
    }

    public function editEmailAddress(){

        if (!empty($_POST['password']) && !empty($_POST['currentEmailAddress']) && !empty($_POST['confirmNewEmail'])){

            $password = $_POST['password'];
            $passwordEncrypt = sha1($password . $GLOBALS['salt']);
            $currentEmail = $_POST['currentEmail'];
            $confirmNewEmail = $_POST['confirmNewEmail'];
            $newEmail = $_POST['newEmail'];

            if ($passwordEncrypt != $this -> user -> getPassword()){

                $this->args['error'] = "Le mot de passe saisi est incorect";
                $this->generateView('editProfile.php');
            }
            elseif ($currentEmail != $this -> user -> getEmail()){

                $this->args['error'] = "L'adresse email rentrée est erronée";
                $this->generateView('editProfile.php');
            }
            elseif($newEmail !== $confirmNewEmail){

                    $this->args['error'] = "Les deux adresses email doivent etre identiques";
                    $this->generateView('editProfile.php');
            }
            else{
                $this -> user -> setMail($newEmail);

                    if($this -> user-> save($this->db)) {

                        $this->args['succes_message'] = "Félicitation votre email a bien été modifié";
                        $this->generateView('editProfile.php');
                    }else {

                        $this->args['error'] = $this -> user -> getErrorMessage();
                        $this->generateView('editProfile.php');
                    }
            }

        }
        else{
            $this->args['error'] = "Veuillez remplir les champs";
            $this->generateView('editProfile.php');
        }

    }

    public function editInfo(){

    }

}