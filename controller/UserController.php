<?php

class UserController extends Controller
{
    protected $connectionRequired = true;
    public function getDashboard()
    {
        $this->generateView('dashboard.php');
    }
    /**
     *
     */
    public function modifyExistingPasswordAction()
    {
        $user = $GLOBALS['view']['user'];


        if (isset($_POST['newPassword']) && $_POST['confirmNewPassword'] && $_POST['oldPassword']) {
            $newPassword = $_POST['newPassword'];
            $confirmNewPassword = $_POST['confirmNewPassword'];
            $oldPassword = $_POST['oldPassword'];
            $oldPassword_encrypt =sha1($oldPassword.$GLOBALS['salt']);
           if($oldPassword_encrypt !==$user->getPassword()){

               $this->args['error'] ="le mot de passe entré n'est pas valide";
               $this->generateView('editProfile.php');
           }
           elseif ($newPassword !==$confirmNewPassword){
               $this->args['error'] = "Les deux mot de passes doivent etre indetiques";
               $this->generateView('editProfile.php');
           }
           else {
               $user->setNewPassword($oldPassword, $newPassword, $confirmNewPassword, $encrypt = true);
               $this->args['succes_Message'] = "Félicitation! Votre profile a bien été édité";
               $this->generateView('editProfile.php');
           }

        }
        else{
            $this->args['error'] = "Vous devez obligatoirement remplir les champs";
            $this->generateView('editProfile.php');
        }
    }
}