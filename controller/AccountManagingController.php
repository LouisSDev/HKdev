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
     * @param $id
     * @return Home
     */

    protected function getHomeFromId($id, $onlyAdmin = false){


        /** @var Home $home */
        $home = null;

        /** @var Home $hm */
        foreach ($this -> user -> getHomes() as $hm)
        {
            if($hm -> getId() === $id
                && $hm -> isBuilding() === $onlyAdmin)
            {
                $home = $hm;
                break;
            }
        }

        if($home)
        {
            return $home;
        }

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
        foreach($home -> getHomes() as $rm ){
            if($rm -> getId() === $roomId){
                $room = $rm;
                break;
            }
        }

        if($room){
            return $room;
        }

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

        $this -> generateView('static/404.php', '404');
        exit();

    }

    /**
     * @param $id
     * @param Home $home
     * @return Sensor
     */
    protected function getSensorFromId($id, Home $home)
    {
        $sensor = null;
        /** @var Sensor $sr */
        foreach($home -> getAllSensors() as $sr ){
            if($sr -> getId() === $id){
                $sensor = $sr;
                break;
            }
        }

        if($sr){
            return $sr;
        }

        $this -> generateView('static/404.php', '404');
        exit();
    }

}