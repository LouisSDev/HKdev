<?php

/**
 * Created by PhpStorm.
 * User: LOUISSTEIMBERG
 * Date: 16/05/2017
 * Time: 09:26
 */
class BackOfficeController extends AdminStaticController
{

    public function manageProducts(){

        $sensorTypeRepository = $this -> getSensorTypeRepository();
        $effectorTypeRepository = $this -> getEffectorTypeRepository();

        $sensorsTypes =  $sensorTypeRepository -> getAll();
        $this -> args['sensors_types'] = $sensorsTypes ;

        $effectorTypes =  $effectorTypeRepository -> getAll();
        $this -> args['effectors_types'] = $effectorTypes ;

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            if(!empty($_POST['submittedForm'])){

                switch($_POST['submittedForm']){
                    case 'REMOVE_SENSOR_TYPE':
                        $this -> removeSensor($sensorsTypes);
                        break;
                    case 'ADD_SENSOR_TYPE':
                        $this->addSensor($sensorsTypes);
                        break;
                    case 'REMOVE_EFFECTOR_TYPE':
                        $this -> removeEffector($effectorTypes);
                        break;
                    case 'ADD_EFFECTOR_TYPE':
                        $this -> addEffectorType();
                        break;
                    default:
                        $this -> generateView('static/404.php', '404');

                }
            }
            else{
                $this -> generateView('static/404.php', '404');

            }

        }

        $this -> generateView('backoffice/products.php', 'Gérer les Capteurs et les Effecteurs');

    }

    public function getAdminDashboard()
    {
        $this -> generateView('backoffice/dashboard.php', 'Tableau de bord Administrateur');
    }

    public function quoteValidation()
    {
        $userRepo = $this -> getUserRepository();
        $quoteSubmittedUsers =  $userRepo -> getUsersWithSubmittedQuote();
        $quoteTreatedUsers =  $userRepo -> getUsersWithTreatedQuote();

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            if(!empty($_POST['validatedUserId']))
            {
                /** @var User $user */
                $user = null;

                /** @var $usr User */
                foreach($quoteTreatedUsers as $usr){
                    if($usr -> getId() === $_POST['validatedUserId']){
                        $user = $usr;
                        break;
                    }
                }

                if($user){
                    $user -> setValidated(true);
                    if($user -> save($this -> db)){
                        $this->args['success_message'] = "Félicitation l'utilisateur a bien été validé";
                    }else{
                        $this->args['error_message'] = "Il y a eu une erreur lors de la sauvegarde dans la base de données, veuillez réessayer.";
                        $this->args['errors'] = $user -> getErrorMessage();
                    }
                }else{
                    $this->args['error_message'] = "Les données entrées ne sont pas valides";
                }
            }
            else if(!empty($_POST['treatedUserId']))
            {
                /** @var User $user */
                $user = null;

                /** @var $usr User */
                foreach($quoteSubmittedUsers as $usr){
                    if($usr -> getId() === $_POST['treatedUserId']){
                        $user = $usr;
                        break;
                    }
                }

                if($user){
                    $user -> setQuoteTreated(true);
                    if($user -> save($this -> db)){
                        $this->args['success_message'] = "Félicitation la modification a bien été prise en charge";
                    }else{
                        $this->args['error_message'] = "Il y a eu une erreur lors de la sauvegarde dans la base de données, veuillez réessayer.";
                        $this->args['errors'] = $user -> getErrorMessage();
                    }
                }else{
                    $this->args['error_message'] = "Les données entrées ne sont pas valides";
                }

            }
            else if(!empty($_POST['deletedUserId']))
            {
                /** @var User $user */
                $user = null;

                /** @var $usr User */
                foreach($quoteTreatedUsers as $usr){
                    if($usr -> getId() === $_POST['deletedUserId']){
                        $user = $usr;
                        break;
                    }
                }

                if($user){
                    if($user -> delete($this -> db)){
                        $this->args['success_message'] = "Félicitation l'utilisateur a bien été supprimé";
                    }else{
                        $this->args['error_message'] = "Il y a eu une erreur lors de la suppression de l'utilisateur dans la base de données, veuillez réessayer.";
                        $this->args['errors'] = $user -> getErrorMessage();
                    }
                }else{
                    $this->args['error_message'] = "Les données entrées ne sont pas valides";
                }
            }

            else{
                $this->args['error_message'] = "Les données entrées ne sont pas valides";
            }
        }


        $this -> args['quoteSubmittedUsers'] = $quoteSubmittedUsers;
        $this -> args['quoteTreatedUsers'] = $quoteTreatedUsers;

        $this -> generateView('backoffice/quoteValidation.php', 'Gérer les devis' );
    }

    public function addSensor($sensorsTypes){

        if (!empty($_POST['sensorType']) && !empty($_POST['sensorNb'])){

            /**@var SensorType $sensorType*/
            $sensorType = null;

            /**@var SensorType $stp*/
            foreach ($sensorsTypes as $stp) {
                if ($stp->getId() === $_POST['sensorType']) {
                    $sensorType = $stp;
                }
            }

            if($sensorType){

                for($i = 1 ; $i <= $_POST['sensorNb'] ; $i++){
                    $sensor = new Sensor();
                    if ($sensor->setSensorType($sensorType)->save($this->db) ) {
                        $this->args['success_message'] = "Félicitation les capteurs ont bien été ajoutés aux stocks informatiques";
                    }
                    else {

                        $this->args['error_message'] = "Les données entrées ne sont pas valides";
                        $this->args['errors'] = $sensorType->getErrorMessage();
                    }
                }

            }
            else{
                $this->args['error_message'] = "Les données entrées ne sont pas valides";
            }
        }
        else{
            $this->args['error_message'] = "Veuillez sélectionner un capteur";

        }

    }

    private function removeSensor($sensorsTypes)
    {

        if (!empty($_POST['sensorType'])) {
            /** @var SensorType $sensorType */
            $sensorType = null;

            /**@var SensorType $stp */
            foreach ($sensorsTypes as $stp) {
                if ($stp->getId() === $_POST['sensorType']) {
                    $sensorType = $stp;
                    break;
                }
            }

            if ($sensorType) {

                $sensorType->setSelling(false);

                if ($sensorType->save($this->db)) {

                    $this->args['success_message'] = "Félicitation le capteur sélectionné a bien été supprimé";
                } else {
                    $this->args['error_message'] = "Les données entrées ne sont pas valides";
                    $this->args['errors'] = $sensorType->getErrorMessage();
                }
            } else {
                $this->args['error_message'] = "Les données entrées ne sont pas valides";
            }
        }else{
            $this->args['error_message'] = "Veuillez sélectionner un capteur";
        }
    }






}