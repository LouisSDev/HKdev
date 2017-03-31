<?php

/**
 * Created by PhpStorm.
 * User: LOUISSTEIMBERG
 * Date: 31/03/2017
 * Time: 10:04
 */
class BuildingRepository extends Repository
{
    public function getBuildingsFromUserId(integer $id){

        $buildingsQuery = $this->db->prepare('SELECT * FROM building WHERE user = :user');
        $buildingsQuery -> bindParam(':user', $id, PDO::PARAM_INT);
        $buildingsQuery -> execute();

        $buildings = array();
        while($buildingData = $buildingsQuery -> fetch(PDO::FETCH_ASSOC)){

            $building = new Building();
            $building -> createFromResults($buildingData);

            $buildings[] = $building;
        }

        return $buildings;
    }
}