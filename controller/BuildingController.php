<?php

/**
 * Created by PhpStorm.
 * User: LOUISSTEIMBERG
 * Date: 13/05/2017
 * Time: 17:39
 */
class BuildingController extends AccountManagingController
{

    public function __construct(PDO $db)
    {
        parent::__construct($db);
        $path =   explode( '/', $_SERVER['REQUEST_URI']);
        $this -> args['building'] = $this -> findHomeFromId($path[4], true);
    }



    public function displayAdministration()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if (!empty($_POST['adminPassword'])
                && !empty($_POST['firstName'])
                && !empty($_POST['lastName'])
                && !empty($_POST['mail'])
                && !empty($_POST['password'])
                && !empty($_POST['passwordConf'])
                && !empty($_POST['homeId'])
            ) {
                if ($_SESSION['password'] == sha1($_POST['adminPassword'] . $GLOBALS['salt'])) {

                    if ($this->findHomeInBuildingFromId($this->args['building'], $_POST['homeId'])) {
                        $homeUser=$this->findHomeInBuildingFromId($this->args['building'],$_POST['homeId']);
                         $newUser= $homeUser->getUser();
                         $this->setNewUserParam($newUser,$_POST['firstName'],$_POST['lastName'],$_POST['mail'],$_POST['password']);
                }
            }
        }

            else {
                $this->generateView('static/404.php', '404');
                exit();
            }

        }
    }

    public function setNewUserParam( User $user,$firstName,$lastName,$mail,$password){
        $user->setFirstName($firstName);
        $user->setLastName($lastName);
        $user->setMail($mail);
        $user->setPassword($password);
        if ($user->save($this->db)){
            $this->args['success_message'] = 'Félicitation vos informations ont bien été modifiés';
            $this -> generateView('building/administrateBuilding.php', 'Administrate My Building');
            exit();
        }
        else{
            $this->args['error'] = "Les modifications que vous essayez de réaliser ne sont pas valides.";
            $this->generateView('user/editProfile.php', 'Edit My Profile');
        }
    }


}