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
        $effectorRepository = $this -> getEffectorRepository();
        $effectorTypesRepository = $this -> getEffectorTypeRepository();

        $homes =  $homeRepository -> getAll();
        $this -> args['homes'] = $homes ;
        $users = $userRepository ->getAll();
        $this ->args['users'] = $users;
        $rooms =  $roomRepository -> getAll();
        $this -> args['rooms'] = $rooms ;
        $effectorTypes = $effectorTypesRepository -> getAll();
        $this -> args['effector_types'] = $effectorTypes;
        $effectors = $effectorRepository -> getAllUsed();
        $this -> args['effectors'] = $effectors;

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            if(!empty($_POST['submittedForm'])){

                switch($_POST['submittedForm']){
                    case 'ADD_HOME':
                        $this -> addHome($users);
                        break;
                    case 'DELETE_HOME' :
                        $this -> removeHome($homes);
                        break;
                    case 'DELETE_USER' :
                        $this -> removeUser($users);
                        break;
                    case 'DELETE_ROOM' :
                        $this -> removeRoom($rooms);
                        break;
                    case 'ADD_ROOM'    :
                        $this -> addRoom();
                        break;
                    case 'ADD_EFFECTOR'  :
                        $this -> addEffector($effectorTypes);
                        break;
                    case 'DELETE_EFFECTOR'  :
                        $this -> removeEffector($effectorTypes);
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

                    if(!empty($_POST['buildingId']) && $_POST['buildingId'] !== -1){
                        $building = $this -> getHomeRepository() -> findById($_POST['buildingId']);
                        $home -> setBuilding($building);
                    }

                    $home -> setUser($userHome);
                    $home -> setName($_POST['name']);
                    $home -> setAddress($_POST['address']);
                    $home -> setCity($_POST['city']);
                    $home -> setCountry($_POST['country']);

                }

                else{

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


                }

                if($home -> save($this->db)){

                    $this->args['success_message'] = "Félicitation l'immeuble a bien été ajouté";
                }else{
                    $this->args['error_message'] = "Les données entrées ne sont pas valides !";
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

    public function removeHome($homes)
    {
        if(!empty($_POST['home']))
        {

            /** @var Home $homeUser */
            $homeUser = null;

            /**@var Home $hm */
            foreach ($homes as $hm) {
                if ($hm->getId() === $_POST['home']) {
                    $homeUser = $hm;
                    break;
                }
            }

                if ($homeUser) {
                    $this -> deleteHome($homeUser);
                  $this->args['success_message'] = "Félicitation la maison sélectionné a bien été supprimé";
                } else {
                  $this->args['error_message'] = "Les données entrées ne sont pas valides";
                }
        }

    }

    protected function deleteHome(Home $home){

        /**@var Room $rm */
        foreach ($home->getRooms() as $rm){
            $this -> deleteRoom($rm);
        }

        $home->delete($this->db);
    }

    protected function deleteBuilding(Home $building){

        /**@var Home $hm */
        foreach ($building->getHomes() as $hm){
            $this -> deleteHome($hm);
        }

        $building->delete($this->db);
    }

    public function removeUser($users)
    {
        if(!empty($_POST['deleteUser']))
        {

            /** @var User $deletedUser */
            $deletedUser = null;

            /**@var User $user */
            foreach ($users as $user) {
                if ($user->getId() === $_POST['deleteUser']) {
                    $deletedUser = $user;
                    break;
                }
            }

            if ($deletedUser) {

                /** @var Home $home */
                foreach ($deletedUser -> getHomes() as $home) {
                    if($home -> getHasHomes()){
                            $this -> deleteBuilding($home);
                        }
                    }
                }

            /**@var Home $hm*/
            foreach ($deletedUser->getHomes() as $hm){
                if(!$hm -> getHasHomes()){
                    $this -> deleteHome($hm);
                }
            }

            $deletedUser->delete($this->db);

            $this->args['success_message'] = "Félicitation l'utilisateur sélectionné a bien été supprimé";
            } else {
                $this->args['error_message'] = "Les données entrées ne sont pas valides";
            }
        }

    private function addEffector($effectorTypes)
    {

        if( !empty($_POST['name']) &&  !empty($_POST['roomId']) && !empty($_POST['effectorId']) ) {

            $room = $this
                ->findRoomFromIdInUsersRooms($_POST['roomId']);

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


            /** @var Effector $effector */
            $effector = $this
                ->getEffectorRepository()
                ->findById($_POST['effectorId']);

            if ($effectorType && $effector
                && $effectorType->getId() == $effector->getEffectorType()->getId()
                && $effector->getRoom() == null
            ) {


                $effector->setName($_POST['name'])
                    ->setRoom($room);


                if ($effector->save($this->db)) {
                    $this->args['success_message'] = 'L\'effecteur a bien été ajouté à la pièce ' . $room->getName() . ' de ' . $room->getHome()->getUser()->getFirstName();
                } else {
                    $this->args['error_message'] = "Les données entrée nous pas pu être enregistrées dans les stocks informatiques";
                    $this->args['errors'] = $effectorType->getErrorMessage();
                }
            } else {
                $this->args['error_message'] = "Les données entrée ne sont pas valides";
            }
        }else {
            $this->args['error_message'] = "Les données entrée ne sont pas valides";
        }

    }

    private function removeEffector($effectorTypes)
    {
        if(!empty($_POST['effectorId'])){
            /** @var Effector $effector */
            $effector = $this -> getEffectorRepository() -> findById($_POST['effectorId']);

            if($effector) {
                $effector->delete($this->db);
                $this->args['success_message'] = 'L\'effecteur a bien été supprimé!';
            }else{
                $this->args['error_message'] = "Les données entrée ne sont pas valides";
            }
        }else {
            $this->args['error_message'] = "Les données entrée ne sont pas valides";
        }
    }

    public function searchUsers(){

        $this -> enableApiMode();

        if(!empty($_POST['id'])){

            /** @var User $user */
            $user = $this -> getUserRepository() -> findById($_POST['id']);

            if($user){
                ApiHandler::returnValidResponse(array($user -> getObjectVars()));
            }

        }elseif(!empty($_POST['firstName']) || !empty($_POST['lastName']) || !empty($_POST['mail'])){
            $users = $this -> getUserRepository() -> searchUsers($_POST);
            ApiHandler::returnValidResponse($users);
        }


        ApiHandler::returnValidResponse(null);

    }

    protected function removeRoom($rooms)
    {
        if (!empty($_POST['roomId'])) {
            /** @var Room $room */
            $room = null;
            /**@var Room $rm */
            foreach ($rooms as $rm) {
                if ($rm->getId() === $_POST['roomId']) {
                    $room = $rm;
                    break;
                }
            }
            if ($room) {
                $this -> deleteRoom($room);
                $this->args['success_message'] = "Félicitation vous avez bien supprimé une pièce";
            } else {
                $this->args['error_message'] = "Les données entrées ne sont pas valides";
            }
        }else{
            $this->args['error_message'] = "Veuillez sélectionner une pièce à supprimer";
        }
    }

    protected function deleteRoom(Room $room){
        /**@var Effector $eff */
        foreach ($room->getEffectors() as $eff){
            $eff->delete($this->db);
        }
        /**@var Sensor $sns */
        foreach ($room->getSensors() as $sns){
            $this->getSensorValueRepository()->deleteValuesFromSensors($sns->getId());
            $sns->delete($this->db);
        }
        $room->delete($this->db);
    }

    protected function addRoom(){
        $room = new Room();
        $home = $this -> getHomeRepository() -> findById($_POST['homeId']);
        $room -> setName($_POST['name'])
            -> setType($_POST['type'])
            -> setHome($home);

        if($room-> save($this->db)){
            $this->args['success_message'] = "Félicitation la pièce sélectionné a bien été ajoutée";
        } else {
            $this->args['error_message'] = "Les données entrées ne sont pas valides";
            $this->args['errors'] = $room->getErrorMessage();

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
                    $successMessage = [];
                    $i = 0;
                    foreach ($message as $mssg) {
                        $successMessage .= $mssg;
                        if ($i != count($message) - 1) {
                            $successMessage .= '<br>';
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
}