<?php

/**
 * Created by PhpStorm.
 * User: home
 * Date: 31/03/2017
 * Time: 10:08
 */
class RoomRepository extends Repository
{

    const OBJECT_CLASS_NAME = 'model/room/Room';

    public function getObjectsFromHomeId(integer $id){

        $roomsQuery = $this->db->prepare('SELECT * FROM room WHERE home = :home');
        $roomsQuery -> bindParam(':home', $id, PDO::PARAM_INT);
        $roomsQuery -> execute();

        return $this -> getResultantObjects($roomsQuery);
    }
}