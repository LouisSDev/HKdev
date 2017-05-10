<?php

class UserController extends Controller
{
    protected $connectionRequired = true;

    public function getDashboard($redirect = true)
    {
        if($redirect) {
            $this->generateView('dashboard.php', 'Dashboard', 'user/dashboard');
        }else{
            $this->generateView('dashboard.php', 'Dashboard');
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

               $this->generateView('editProfile.php', 'Edit My Profile');
           }
        else{
            $this->args['error'] = "Vous devez obligatoirement remplir les champs";
            $this->generateView('editProfile.php', 'Edit My Profile');
        }
    }

    public function editEmailAddress(){

        if (!empty($_POST['currentEmail']) && !empty($_POST['newEmail']) && !empty($_POST['confirmNewEmail'])){

            $currentEmail = $_POST['currentEmail'];
            $newEmail = $_POST['newEmailAddress'];
            $confirmNewEmail = $_POST['confirmNewEmail'];

            if ($currentEmail !== $this -> user -> getEmail()){

                $this->args['error'] = "L'adresse email rentrée est erronée";
                $this->generateView('editProfile.php', 'Edit My Profile');
            }
            elseif($newEmail !== $confirmNewEmail){

                    $this->args['error'] = "Les deux adresses email doivent etre identiques";
                  //  $this->generateView('editProfile.php');
                $this->generateView('editProfile.php', 'Edit My Profile');
            }
            else{
                $this -> user -> setMail($newEmail);

                    if($this -> user-> save($this->db)) {

                        $this->args['success_message'] = 'Félicitation votre email a bien été modifié';
                        $this->generateView('editProfile.php', 'Edit My Profile');
                    }else {

                        $this->args['error'] = $this -> user -> getErrorMessage();
                        $this->generateView('editProfile.php', 'Edit My Profile');
                    }
            }

        }
        else{
            $this->args['error'] = "Veuillez remplir les champs";
            $this->generateView('editProfile.php', 'Edit My Profile');
        }

    }

    public function editInfo(){

    }

}