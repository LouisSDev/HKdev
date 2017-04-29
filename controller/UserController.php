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
        $user = new User();
        $user->createFromResults($_POST);
        if (isset($_POST['newpassword']) && $_POST['confirmnewpassword'] && $_POST['OldPassword']) {
            $newpassword = $_POST['newpassword'];
            $confirmNewPassword = $_POST['confirmnewpassword'];
            $oldpassword = sha1($GLOBALS['salt']);
            if ($oldpassword !== $user->getPassword()) {
                $this->generateView('oldpassword.php');
            } elseif ($newpassword !== $confirmNewPassword) {
                $this->generateView('newPassword.php');
            } else {
                $encryptPassword = sha1($GLOBALS['salt']);
                $user->setPassword($encryptPassword);
                $user->save($this->db);
                $this->generateView('passwordChanging_success.php');
            }

        } else {
            $this->generateView('empty_changePassword_infoError.php');
        }

    }


}