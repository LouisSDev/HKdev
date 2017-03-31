<?php

/**
 * Created by PhpStorm.
 * User: LOUISSTEIMBERG
 * Date: 31/03/2017
 * Time: 10:04
 */
class BuildingRepository extends Repository
{
    const OBJECT_CLASS_NAME = 'model/building/Building';


    public function getObjectsFromUserId(integer $id){

        $buildingsQuery = $this->db->prepare('SELECT * FROM building WHERE user = :user');
        $buildingsQuery -> bindParam(':user', $id, PDO::PARAM_INT);
        $buildingsQuery -> execute();

        return $this -> getResultantObjects($buildingsQuery);
    }
}