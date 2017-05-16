<?php

/**
 * Created by PhpStorm.
 * User: LOUISSTEIMBERG
 * Date: 12/05/2017
 * Time: 09:52
 */

abstract class AccountManagingController extends Controller
{

    protected $connectionRequired = true;




    /**
     * @param Home $building
     * @param $homeId
     * @return Home
     */
    protected function findHomeFromIdInBuilding(Home $building, $homeId){

        $home = null;
        /**
         * @var Home $building
         */
        if ($building -> getHasHomes() === true){
            /**
             * @var Home $hm
             */
            foreach ($building -> getHomes() as $hm){

                if ($hm -> getId() === $homeId){
                    $home = $hm;
                    break;
                }

            }

        }

        if($home)
        {
            return $home;
        }

        $this -> apiResponse = new ApiResponse(404, 'L\'habitation specifiee n\'est pas disponible', true);

        $this -> generateView('static/404.php', '404');
        exit();

    }

    /**
     * @param $id
     * @return Home
     */

    protected function findHomeFromId($id, $onlyAdmin = false){


        /** @var Home $home */
        $home = null;

        /** @var Home $hm */
        foreach ($this -> user -> getHomes() as $hm)
        {
            if($hm -> getId() === $id
                && $hm -> getHasHomes() == $onlyAdmin )
            {
                $home = $hm;
                break;
            }
        }

        if($home)
        {
            return $home;
        }

        $this -> apiResponse = new ApiResponse(404, 'L\'habitation specifiee n\'est pas disponible', true);

        $this -> generateView('static/404.php', '404');
        exit();

    }

    /**
     * @param Home $home
     * @param $room
     * @return Room
     */
    protected function findRoomFromId(Home $home, $roomId)
    {
        $room = null;
        /** @var Room $rm */
        foreach($home -> getRooms() as $rm ){

            if($rm -> getId() === $roomId){
                $room = $rm;
                break;
            }
        }

        if($room){
            return $room;
        }

        $this -> apiResponse = new ApiResponse(404, 'La piece specifiee n\'est pas disponible', true);

        $this -> generateView('static/404.php', '404');
        exit();
    }

    protected function findRoomFromIdInUsersRooms($roomId){

        $room = null;
        /** @var Room $rm */
        foreach($this -> user -> getAllRooms() as $rm ){
            if($rm -> getId() === $roomId){
                $room = $rm;
                break;
            }
        }

        if($room){
            return $room;
        }

        $this -> apiResponse = new ApiResponse(404, 'La piece specifiee n\'est pas disponible', true);

        $this -> generateView('static/404.php', '404');
        exit();

    }

    /**
     * @param $id
     * @param Home $home
     * @return Sensor
     */
    protected function findSensorFromId($id, Home $home)
    {
        $sensor = null;
        /** @var Sensor $sr */
        foreach($home -> getAllSensors() as $sr ){
            if($sr -> getId() === $id){
                $sensor = $sr;
                break;
            }
        }

        if($sensor){
            return $sensor;
        }

        $this -> apiResponse = new ApiResponse(404, 'Le capteur specifiee n\'est pas disponible', true);

        $this -> generateView('static/404.php', '404');
        exit();
    }

    protected function updateEffectors($effectors){
        /** @var Effector $eff */
        foreach ($effectors as $eff){

            if($eff -> getEffectorType() -> getType() === $_POST['effectorType']){
                $effectors[] = $eff;

                if($eff -> getEffectorType() -> getChart() && !empty($_POST['state'])){
                    ApiHandler::throwError(400, 'Vous ne pouvez pas modifier l\'état de ce type d\'effecteur');
                }

                if(!$eff -> getEffectorType() -> getChart() && !empty(empty($_POST['value']))){
                    ApiHandler::throwError(400, 'Vous ne pouvez pas modifier la valeur de ce type d\'effecteur');
                }
            }
        }

        /** @var Effector $eff */
        foreach($effectors as $eff){
            if($eff -> getEffectorType() -> getChart()){
                if(!empty($_POST['value'])){
                    $eff -> setValue($_POST['value']);
                }
                else if(!empty($_POST['auto'])){
                    $eff -> setAuto($_POST['auto']);
                }
            }

            else{
                if(!empty($_POST['state'])){
                    $eff -> setState($_POST['state']);
                }
                else if(!empty($_POST['auto'])){
                    $eff -> setAuto($_POST['auto']);
                }
            }

        }

        $this -> user -> save($this -> db);

        ApiHandler::returnValidResponse(null);
    }



}