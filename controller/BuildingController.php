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


                if ($this -> user -> getPassword() === sha1($_POST['adminPassword'] . $GLOBALS['salt'])) {

                    $toBeEditedUser = $this
                        ->findHomeFromIdInBuilding($this->args['building'], $_POST['homeId'])
                        -> getUser();

                    $this -> setNewUserParams($toBeEditedUser);
                }
                else{
                    $this -> args['error_message'] = "Le mot de passe entré n'est pas correct";
                }


            }
            else {

                $this -> args['error_message'] = "Veuillez entrer tous les paramètres requis";

            }

        }

        $this -> generateView('building/administrate.php', 'Administrer mon Appartement');
    }

    public function setNewUserParams(User $user){

        $user->setFirstName($_POST['firstName']);
        $user->setLastName($_POST['lastName']);
        $user->setMail($_POST['mail']);
        $user->setPassword($_POST['password']);


        if ( $user -> save($this->db) ){

            $this->args['success_message'] = 'Félicitation vos informations ont bien été modifiés';
        }


        $this -> args['error_message'] = "Les modifications que vous essayez de réaliser ne sont pas valides.";

        $this -> args['errors'] = $user -> getErrorMessage();

    }


}