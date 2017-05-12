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


    public function profileEditionPage()
    {
        switch($_SERVER['REQUEST_METHOD']) {
            case 'GET' :
                $this->generateView('user/editProfile.php', 'Editer mon profil');
                break;
            case 'POST' :

                if(!empty($_POST['firstName'])
                    || !empty($_POST['lastName'])) {
                    $this->editInfo();
                }

                elseif(!empty($_POST['password'])
                    || !empty($_POST['newEmail'])
                    || !empty($_POST['confirmNewEmail'])) {
                    $this -> editEmailAddress();
                }

                elseif(!empty($_POST['oldPassword'])
                    || !empty($_POST['newPassword'])
                    || !empty($_POST['confirmNewPassword'])){
                    $this -> editPassword();
                }

                else {
                    $this->generateView('user/editProfile.php', 'Editer mon profil');
                }

                break;
        }
    }

    public function editPassword()
    {
        if (!empty($_POST['newPassword'])
            && !empty($_POST['confirmNewPassword'])
            && !empty($_POST['oldPassword'])) {

               $this -> user->setNewPassword($_POST['oldPassword'], $_POST['newPassword'], $_POST['confirmNewPassword'], $encrypt = true);
               if($this -> user -> save($this -> db)) {
                   $this->args['success_message'] = "Félicitations! Votre profil a bien été édité";
               }else{
                   $this->args['error'] = $this -> user -> getErrorMessage()[0];
               }

               $_SESSION['password'] = $this -> user -> getPassword();

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

                $this->generateView('user/editProfile.php', 'Edit My Profile');
            }
            else{
                $this -> user -> setMail($newEmail);

                    if($this -> user-> save($this->db)) {

                        $this->args['success_message'] = 'Félicitation votre email a bien été modifié';

                        $_SESSION['mail'] = $this -> user -> getMail();

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
        if(!empty($_POST['firstName'])){
            $this -> user -> setFirstName($_POST['firstName']);
        }

        if(!empty($_POST['lastName'])){
            $this -> user -> setLastName($_POST['lastName']);
        }

        if($this -> user -> save($this -> db)){
            $this->args['success_message'] = 'Félicitation vos informations ont bien été modifiés';
            $this->generateView('user/editProfile.php', 'Edit My Profile');
        }else{
            $this->args['error'] = "Les modifications que vous essayez de réaliser ne sont pas valides.";
            $this->generateView('user/editProfile.php', 'Edit My Profile');
        }
    }

    public function disconnect()
    {
        $_SESSION['mail'] = null;
        $_SESSION['password'] = null;
        $this->generateView('home', 'Home', '');
    }

}