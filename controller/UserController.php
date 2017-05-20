<?php

class UserController extends Controller
{
    protected $connectionRequired = true;

    public function getDashboard($redirect = true)
    {
        if($redirect) {
            $this->generateView('dashboard.php', 'Tableau de Bord', 'user/dashboard');
        }else{
            $this->generateView('user/dashboard.php', 'Tableau de Bord');
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

                break;
        }


        $this->generateView('user/editProfile.php', 'Editer mon profil');
    }

    public function editPassword()
    {
        if (!empty($_POST['newPassword'])
            && !empty($_POST['confirmNewPassword'])
            && !empty($_POST['oldPassword'])) {

               $this -> user->setNewPassword($_POST['oldPassword'], $_POST['newPassword'], $_POST['confirmNewPassword'], $encrypt = true);

               if($this -> user -> save($this -> db)) {
                   $this->args['success_message'] = "Félicitations! Votre profil a bien été édité";
               }

               else{
                   $this->args['error_message'] = 'Les informations entrées ne sont pas valides';
                   $this->args['errors'] = $this -> user -> getErrorMessage();
               }

               $_SESSION['password'] = $this -> user -> getPassword();

           }
        else{
            $this->args['error_message'] = 'Vous devez obligatoirement remplir les champs';
        }
    }

    public function editEmailAddress(){

        if (!empty($_POST['password']) && !empty($_POST['newEmail']) && !empty($_POST['confirmNewEmail'])){

            $password = $_POST['password'];
            $newEmail = $_POST['newEmail'];
            $confirmNewEmail = $_POST['confirmNewEmail'];

            if (sha1($password . $GLOBALS['salt']) !== $this -> user -> getPassword()){

                $this->args['error_message'] = 'Le mot de passe est erroné';
            }
            elseif($newEmail !== $confirmNewEmail){

                $this->args['error_message'] = 'Les deux adresses email doivent etre identiques';

            }
            else{
                $this -> user -> setMail($newEmail);

                    if($this -> user-> save($this->db)) {

                        $this->args['success_message'] = 'Félicitation votre email a bien été modifié';

                        $_SESSION['mail'] = $this -> user -> getMail();

                    }else {

                        $this -> args['error_message'] = 'Une erreur s\'est produite lors de l\'enregistrement de ces données, veuillez vérifier les informations entrées';

                        $this->args['errors'] = $this -> user -> getErrorMessage();
                    }
            }

        }
        else{
            $this->args['error_message'] = 'Veuillez remplir les champs';
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
        }else{
            $this->args['error_message'] = "Les modifications que vous essayez de réaliser ne sont pas valides.";
        }
    }

    public function disconnect()
    {
        $_SESSION['mail'] = null;
        $_SESSION['password'] = null;
        $this->generateView('home', 'Home', '');
    }

}