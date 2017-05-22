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
                        $this -> addHome();
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

    public function addHome()
    {
        if(!empty($_POST['user'])){

            if(!empty($_POST['name']) && !empty($_POST['address']) && !empty($_POST['city']) && !empty($_POST['country'])){

                $home = new Home();


                if($home-> save($this->db)){
                    $this->args['success_message'] = "Félicitation la maison a bien été ajouté";
                } else {
                    $this->args['error_message'] = "Les données entrées ne sont pas valides !";
                }
            }
            else{
                $this->args['error_message'] = "Les données entrées ne sont pas valides";
            }

        }
        else{
            $this->args['error_message'] = "Les données entrées ne sont pas valides";
        }

    }

    public function deleteHome()
    {

    }

}