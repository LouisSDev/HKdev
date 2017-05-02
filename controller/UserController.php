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
        /** @var User $user */
        $user = $GLOBALS['view']['user'];


        if (!empty($_POST['newPassword'])
            && !empty($_POST['confirmNewPassword'])
            && !empty($_POST['oldPassword'])) {

               $user->setNewPassword($_POST['oldPassword'], $_POST['newPassword'], $_POST['confirmNewPassword'], $encrypt = true);
               if($user -> save($this -> db)) {
                   $this->args['succes_message'] = "Félicitations! Votre profil a bien été édité";
               }else{
                   $this->args['error'] = $user -> getErrorMessage();
               }

               $this->generateView('editProfile.php');
           }
        else{
            $this->args['error'] = "Vous devez obligatoirement remplir les champs";
            $this->generateView('editProfile.php');
        }
    }

    public function editEmailAddress(){
        $user = $GLOBALS['view']['user'];
        if (!empty($_POST['password']) && !empty($_POST['currentEmailAddress']) && !empty($_POST['confirmNewEmail'])){

            $password = $_POST['password'];
            $password_encrypt = sha1($password.$GLOBALS['salt']);
            $currentEmailAddress = $_POST['currentEmailAddress'];
            $confirmNewEmail = $_POST['confirmNewEmail'];
            $newEmailAddress = $_POST['newEmailAdress'];

            if ($password_encrypt !==$user->getPassword()){

                $this->args['error'] = "Le mot de passe saisi est incorect";
                $this->generateView('editProfile.php');
            }
            elseif ($currentEmailAddress !=$user->getEmail()){

                $this->args['error'] = "L'adresse email rentré est erronée";
                $this->generateView('editProfile.php');
            }
            elseif($newEmailAddress !== $currentEmailAddress){

                    $this->args['error'] = "Les deux adresses email doivent etre identiques";
                    $this->generateView('editProfile.php');
            }
            else{
                if(preg_match('#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#' ,$newEmailAddress ) &&
                    preg_match('#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#' , $confirmNewEmail ) ){
                    $this->args['succes_message'] = "Félicitation votre email a bien été modifié";
                    $this->generateView('editProfile.php');
                }
                else{
                    $this->args['error'] = "Les adresses saisies ne sont pas des emails";
                    $this->generateView('editProfile.php');
                    $user-> save($this->db);
                }
            }

            }
            else{
                $this->args['error'] = "Veuillez remplir les champs";
                $this->generateView('editProfile.php');
            }

        }

        public function editInfos(){

        }

}