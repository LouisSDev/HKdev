<?php

/**
 * Created by PhpStorm.
 * User: LOUISSTEIMBERG
 * Date: 12/05/2017
 * Time: 10:37
 */
class RoomController extends AccountManagingController
{

    public function updateEffectorsInARoom()
    {
        $this -> enableApiMode();


        if($_SERVER['REQUEST_METHOD'] === 'POST'
            && !empty($_POST['roomId'])
            && !empty($_POST['effectorType'])
            && in_array($_POST['effectorType'], EffectorType::TYPE_ARRAY)
            && (!empty($_POST['value']) ||  isset($_POST['state']) || isset($_POST['auto']))
        )
        {
            $room = $this -> findRoomFromIdInUsersRooms($_POST['roomId']);

            $effectors = array();
            // For each effectors in the room
            $this -> updateEffectors($room -> getEffectors());

        }
    }




}