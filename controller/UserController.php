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
        /** @var User $user */
        $user = $GLOBALS['view']['user'];


        if (!empty($_POST['newPassword'])
            && !empty($_POST['confirmNewPassword'])
            && !empty($_POST['oldPassword'])) {

               $user->setNewPassword($_POST['oldPassword'], $_POST['newPassword'], $_POST['confirmNewPassword'], $encrypt = true);
               if($user -> save($this -> db)) {
                   $this->args['succes_message'] = "Félicitation! Votre profile a bien été édité";
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
}