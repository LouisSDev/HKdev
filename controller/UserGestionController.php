<?php

/**
 * Created by PhpStorm.
 * User: Desazars
 * Date: 22/05/2017
 * Time: 10:04
 */
class UserGestionController  extends AdminController
{
    public function manageUsers()
    {
        $this -> generateView('backoffice/manageUsers.php', 'Gérer les Utilisateurs');
    }

    public function manageHomeUsers(){

        $homeRepository = $this -> getHomeRepository();
        $roomRepository = $this -> getRoomRepository();
        $userRepository = $this -> getUserRepository();

        $home =  $homeRepository -> getAll();
        $this -> args['home'] = $home ;
        $users = $userRepository ->getAll();
        $this ->args['users'] = $users;
        $room =  $roomRepository -> getAll();
        $this -> args['room'] = $room ;

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            if(!empty($_POST['submittedForm'])){

                switch($_POST['submittedForm']){
                    case 'ADD_HOME':
                        $this -> addHome($users);
                        break;
                    case 'DELETE_HOME' :
                        $this -> deleteHome($home);
                        break;
                    default:
                        $this -> generateView('static/404.php', '404');

                }
            }
            else{
                $this -> generateView('static/404.php', '404');

            }

        }

        $this -> manageUsers();

    }

    public function addHome($users)
    {



        if(!empty($_POST['selectUser'])){

            if(!empty($_POST['name']) && !empty($_POST['address']) && !empty($_POST['city']) && !empty($_POST['country'])){

                $home = new Home();

                if($_POST['homeType'] === 'house'){
                   /**  @var User $userHome */
                    $userHome =null;
                    /** @var User $user */
                    foreach ($users as $user){
                        if($user ->getId() === $_POST['selectUser']){
                            $userHome = $user;
                        }
                    }

                    $home -> setUser($userHome);
                    $home -> setName($_POST['name']);
                    $home -> setAddress($_POST['address']);
                    $home -> setCity($_POST['city']);
                    $home -> setCountry($_POST['country']);

                    if($home -> save($this->db)){

                        $this->args['success_message'] = "Félicitation la maison a bien été ajouté";
                    }else{
                        $this->args['error_message'] = "Les données entrées ne sont pas valides !";
                    }
                }if($_POST['homeType'] === 'building'){

                    /**  @var User $userHome */
                    $userHome =null;
                    /** @var User $user */
                    foreach ($users as $user){
                        if($user ->getId() === $_POST['selectUser']){
                            $userHome = $user;
                        }
                    }

                    $home -> setHasHomes(true);
                    $home -> setUser($userHome);
                    $home -> setName($_POST['name']);
                    $home -> setAddress($_POST['address']);
                    $home -> setCity($_POST['city']);
                    $home -> setCountry($_POST['country']);

                    if($home -> save($this->db)){

                        $this->args['success_message'] = "Félicitation l'immeuble a bien été ajouté";
                    }else{
                        $this->args['error_message'] = "Les données entrées ne sont pas valides !";
                    }

                }

            }
            else{
                $this->args['error_message'] = "Les données entrées ne sont pas valides .";
            }

        }
        else{
            $this->args['error_message'] = "Les données entrées ne sont pas valides";
        }

    }

    public function deleteHome($home)
    {
        if(!empty($_POST['home']))
        {

            /** @var HomeUser $homeUser */
            $homeUser = null;

            /**@var HomeUser $stp */
            foreach ($home as $stp) {
                if ($stp->getId() === $_POST['home']) {
                    $homeUser = $stp;
                    break;
                }
            }

                //if ($homeUser->delete($this->db)) {

                  //  $this->args['success_message'] = "Félicitation le capteur sélectionné a bien été supprimé";
                //} else {
                  //  $this->args['error_message'] = "Les données entrées ne sont pas valides";
                //}
        }

    }

}