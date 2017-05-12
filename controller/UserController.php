<?php

class UserController extends Controller
{
    protected $connectionRequired = true;

    public function getDashboard($redirect = true)
    {
        if($redirect) {
            $this->generateView('dashboard.php', 'Dashboard', 'user/dashboard');
        }else{
            $this->generateView('user/dashboard.php', 'Dashboard');
        }
    }

    public function modifyExistingPasswordAction()
    {
        if (!empty($_POST['newPassword'])
            && !empty($_POST['confirmNewPassword'])
            && !empty($_POST['oldPassword'])) {

               $this -> user->setNewPassword($_POST['oldPassword'], $_POST['newPassword'], $_POST['confirmNewPassword'], $encrypt = true);
               if($this -> user -> save($this -> db)) {
                   $this->args['success_message'] = "Félicitations! Votre profil a bien été édité";
               }else{
                   $this->args['error'] = $this -> user -> getErrorMessage();
               }

               $_SERVER['password'] = $this -> user -> getPassword();

               $this->generateView('user/editProfile.php', 'Edit My Profile');
           }
        else{
            $this->args['error'] = "Vous devez obligatoirement remplir les champs";
            $this->generateView('user/editProfile.php', 'Edit My Profile');
        }
    }

    public function editEmailAddress(){

        if (!empty($_POST['password']) && !empty($_POST['newEmail']) && !empty($_POST['confirmNewEmail'])){

            $password = $_POST['password'];
            $newEmail = $_POST['newEmail'];
            $confirmNewEmail = $_POST['confirmNewEmail'];

            if (sha1($password . $GLOBALS['salt']) !== $this -> user -> getPassword()){

                $this->args['error'] = "Le mot de passe est erroné";
                $this->generateView('user/editProfile.php', 'Edit My Profile');
            }
            elseif($newEmail !== $confirmNewEmail){

                    $this->args['error'] = "Les deux adresses email doivent etre identiques";
                  //  $this->generateView('user/editProfile.php');
                $this->generateView('user/editProfile.php', 'Edit My Profile');
            }
            else{
                $this -> user -> setMail($newEmail);

                    if($this -> user-> save($this->db)) {

                        $this->args['success_message'] = 'Félicitation votre email a bien été modifié';

                        $_SERVER['mail'] = $this -> user -> getMail();

                        $this->generateView('user/editProfile.php', 'Edit My Profile');
                    }else {

                        $this->args['error'] = $this -> user -> getErrorMessage();
                        $this->generateView('user/editProfile.php', 'Edit My Profile');
                    }
            }

        }
        else{
            $this->args['error'] = "Veuillez remplir les champs";
            $this->generateView('user/editProfile.php', 'Edit My Profile');
        }

    }

    public function editInfo(){


    }

}