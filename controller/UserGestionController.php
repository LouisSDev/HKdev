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

        $userRepository = $this -> getUserRepository();
        $homeRepository = $this -> getHomeRepository();
        $roomRepository = $this -> getRoomRepository();

        $users =  $userRepository -> getAll();
        $this -> args['users'] = $users ;

        $home =  $homeRepository -> getAll();
        $this -> args['home'] = $home ;

        $room =  $roomRepository -> getAll();
        $this -> args['room'] = $room ;

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            if(!empty($_POST['submittedForm'])){

                switch($_POST['submittedForm']){
                    case 'ADD_HOME':

                        $this -> addHome($home);
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

    public function addHome($home)
    {
        if(!empty($_POST['user'])){
            if(!empty($_POST['HomeName']) && !empty($_POST['Adress']) && !empty($_POST['Ville']) && !empty($_POST['Pays'])){

            }

        }
        else{
            $this->args['error_message'] = "Les données entrées ne sont pas valides";
        }
        $this -> generateView('backoffice/manageUsers.php', 'Gérer les Utilisateurs');

    }

    public function deleteHome($home)
    {

    }

}