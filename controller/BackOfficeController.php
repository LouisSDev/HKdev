<?php
use BernardoSecades\Json\Json;

/**
 * Created by PhpStorm.
 * User: LOUISSTEIMBERG
 * Date: 16/05/2017
 * Time: 09:26
 */
class BackOfficeController extends AdminController
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
                    case 'ADD_SENSORS':
                        $this->addSensors($sensorsTypes);
                        break;
                    case 'ADD_SENSOR_TYPE':
                        $this->addSensorType();
                        break;
                    case 'REMOVE_EFFECTOR_TYPE':
                        $this -> removeEffector($effectorTypes);
                        break;
                    case 'ADD_EFFECTOR_TYPE':
                        $this -> addEffectorType();
                        break;
                    case 'ADD_EFFECTORS':
                        $this ->addEffectors($effectorTypes);
                        break;
                    case 'CHANGE_EFFECTORS_TYPE':
                        $this ->changeEffectors($effectorTypes);
                        break;
                    case 'CHANGE_SENSORS_TYPE':
                        $this ->changeSensors($sensorsTypes);
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
        $this->createStocksArrays();
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
                        $password = Utils::randomHash(10);
                        $user->setNewPassword($password,null,$password);
                        $subject = "Informations relatives à votre compte";
                        $body = "<!DOCTYPE html><html><body><h1>Bonjour ".$user->getFirstName()."</h1><br>".
                            "Votre compte a été validé.<br>".
                            "Voici votre mot de passe : ".$password."<br><br>".
                            "Vous pouvez maintenant vous connecter avec votre email et ce mot de passe.<br>".
                            "Nous vous recommandons de changer ce mot de passe".
                            "L'équipe HomeKeeper"."</body></html>";
                        $this->sendMail($this->user->getMail(),$this->user->getFirstName(),$subject,$body);
                        $this->args['success_message'] = "Félicitations l'utilisateur a bien été validé";
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

    public function addSensors($sensorsTypes){

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

    protected function removeSensor($sensorsTypes)
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
                    //$this->args['error_message'] = "Les données entrées ne sont pas valides";
                    //$this->args['errors'] = $sensorType->getErrorMessage();
                }
            } else {
                $this->args['error_message'] = "Les données entrées ne sont pas valides";
            }
        }else{
            $this->args['error_message'] = "Veuillez sélectionner un capteur";
        }
    }
    protected function addSensorType()
    {

        $sensorType = new SensorType();
        $sensorType ->createFromResults($_POST);

        if($sensorType-> save($this->db)){
            $this->args['success_message'] = "Félicitation le capteur a bien été ajouté";
        } else {
            $this->args['error_message'] = "Les données entrées ne sont pas valides";
        }
    }
    public function changeSensors($sensorsTypes)
    {

        if (!empty($_POST['sensorType'])) {
            /** @var SensorType $sensorType
             */

            $sensorType = null;


            /**@var SensorType $stp */
            foreach ($sensorsTypes as $stp) {
                if ($stp->getId() === $_POST['sensorType']) {
                    $sensorType = $stp;
                    break;
                }
            }

            if ($sensorType) {
                $message = [];
                if (!empty($_POST['name'])) {
                    $sensorType -> setName($_POST['name']);
                    $message[] = 'Le nom du capteur a bien été modifié';
                }
                if (!empty($_POST['ref'])) {
                    $sensorType -> setRef($_POST['ref']);
                    $message[] = 'La référence du capteur a bien été modifié';
                }

                if (!empty($_POST['price'])) {
                    $sensorType -> setRef($_POST['price']);
                    $message[] = 'Le prix du capteur a bien été modifié';
                }

                if($sensorType -> save($this -> db)) {
                    $successMessage = "";
                    $i = 0;
                    foreach ($message as $mssg) {
                        $successMessage .= $mssg;
                        if ($i != sizeof($message) - 1) {
                            $successMessage .= ', ';
                        }
                        $i++;
                    }
                    $this->args['success_message'] = $successMessage;
                }else{
                    $this->args['error_message'] = "Les données entrée nous pas pu être enregistrées dans les stocks informatiques";
                    $this->args['errors'] = $sensorType->getErrorMessage();
                }
            }
            else{
                $this->args['error_message'] = "Les données entrée ne sont pas valide";
                $this->args['errors'] = $sensorType->getErrorMessage();
            }
        }
    }


    public function changeEffectors($effectorTypes)
    {

        if (!empty($_POST['effectorType'])) {
            /** @var EffectorType $effectorType
             */

            $effectorType = null;


            /**@var EffectorType $stp */
            foreach ($effectorTypes as $stp) {
                if ($stp->getId() === $_POST['effectorType']) {
                    $effectorType = $stp;
                    break;
                }
            }

            if ($effectorType) {
                $message = [];
                if (!empty($_POST['name'])) {
                    $effectorType -> setName($_POST['name']);
                    $message[] = "Le nom de l'effecteur a bien été modifié";
                }

                if (!empty($_POST['ref'])) {
                    $effectorType -> setRef($_POST['ref']);
                    $message[] = "La référence de l'effecteur a bien été modifié";
                }

                if($effectorType -> save($this -> db)) {
                    $successMessage = [];
                    $i = 0;
                    foreach ($message as $mssg) {
                        $successMessage .= $mssg;
                        if ($i != sizeof($message) - 1) {
                            $successMessage .= '<br>';
                        }
                        $i++;
                    }
                    $this->args['success_message'] = $successMessage;
                }else{
                    $this->args['error_message'] = "Les données entrée nous pas pu être enregistrées dans les stocks informatiques";
                    $this->args['errors'] = $effectorType->getErrorMessage();
                }
            }
            else{
                $this->args['error_message'] = "Les données entrée ne sont pas valide";
                $this->args['errors'] = $effectorType->getErrorMessage();
            }
        }
    }

    protected function removeEffector($effectorsTypes)
    {

        if (!empty($_POST['effectorType'])) {
            /** @var EffectorType $effectorType */
            $effectorType = null;

            /**@var EffectorType $stp */
            foreach ($effectorsTypes as $stp) {
                if ($stp->getId() === $_POST['effectorType']) {
                    $effectorType = $stp;
                    break;
                }
            }

            if ($effectorType) {

                $effectorType->setSelling(false);

                if ($effectorType->save($this->db)) {

                    $this->args['success_message'] = "Félicitation l'effecteur sélectionné a bien été supprimé";
                } else {
                    $this->args['error_message'] = "Les données entrées ne sont pas valides";
                    $this->args['errors'] = $effectorType->getErrorMessage();
                }
            } else {
                $this->args['error_message'] = "Les données entrées ne sont pas valides";
            }
        }else{
            $this->args['error_message'] = "Veuillez sélectionner un effecteur";
        }
    }

    public function getEffectorsStocksByType()
    {
        $effectorTypeRepository = $this->getEffectorTypeRepository();
        $effectorTypes = $effectorTypeRepository->getAll();
        $effectorRepo = $this ->getEffectorRepository();
        $effectorsByType = array();
        /** @var EffectorType $effectorType */
        foreach ($effectorTypes as $effectorType) {
            $effectorsByType[$effectorType->getName()] = $effectorRepo->getUnusedEffectorsByType($effectorType->getId());
        }
        return $effectorsByType;
    }

    public function getSensorsStocksByType()
    {
        $sensorTypeRepo = $this->getSensorTypeRepository();
        $sensorTypes = $sensorTypeRepo->getAll();
        $sensorRepo = $this ->getSensorRepository();
        $sensorsByType = array();
        /** @var SensorType $sensorType */
        foreach ($sensorTypes as $sensorType) {
            $sensorsByType[$sensorType->getName()] = $sensorRepo->getSensorsUnusedByType($sensorType->getId());
        }
        return $sensorsByType;
    }

    public function createStocksArrays()
    {
        $effectorStock = $this->getEffectorsStocksByType();
        $sensorStock = $this->getSensorsStocksByType();
        $this->args['effectorStock'] = Json::encode($effectorStock);
        $this->args['sensorStock'] = Json::encode($sensorStock);
    }

    protected function addEffectorType(){
        $effectorType = new EffectorType();
        $effectorType ->createFromResults($_POST);

        if($effectorType-> save($this->db)){
            $this->args['success_message'] = "Félicitation l'effecteur sélectionné a bien été ajouté";
        } else {
            $this->args['error_message'] = "Les données entrées ne sont pas valides";
            $this->args['errors'] = $effectorType->getErrorMessage();

        }

    }





    protected function addEffectors($effectorTypes){

        if (!empty($_POST['effectorTypeId']) && !empty($_POST['effectorNb'])){

            /**@var EffectorType $effectorType*/
            $effectorType = null;

            /**@var EffectorType $etp*/
            foreach ($effectorTypes as $etp) {
                if ($etp->getId() == $_POST['effectorTypeId']) {
                    $effectorType = $etp;
                }
            }

            if($effectorType){

                for($i = 1 ; $i <= $_POST['effectorNb'] ; $i++){
                    $effector = new Effector();
                    if ($effector->setEffectorType($effectorType)->save($this->db) ) {
                        $this->args['success_message'] = "Félicitation les effecteurs ont bien été ajoutés aux stocks informatiques";
                    }
                    else {
                        $this->args['error_message'] = "Les données entrées ne sont pas valides";
                        $this->args['errors'] = $effectorType->getErrorMessage();
                    }
                }
            }
            else{
                $this->args['error_message'] = "Les données entrées ne sont pas valides";
            }
        }
        else{
            $this->args['error_message'] = "Veuillez sélectionner un effecteur";

        }

    }



}