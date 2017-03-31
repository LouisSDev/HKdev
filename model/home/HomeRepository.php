<?php


class HomeRepository extends Repository
{

    const OBJECT_CLASS_NAME = 'model/home/Home';

    public function getHomesFromUserId(integer $id){
        $homesQuery = $this->db->prepare('SELECT * FROM home WHERE user = :user');
        $homesQuery -> bindParam(':user', $id, PDO::PARAM_INT);
        $homesQuery -> execute();

        return $this->getResultantObjects($homesQuery);
    }


    public function getHomesFromBuildingId(integer $id){
        $homesQuery = $this->db->prepare('SELECT * FROM home WHERE building = :building');
        $homesQuery -> bindParam(':building', $id, PDO::PARAM_INT);
        $homesQuery -> execute();

        return $this->getResultantObjects($homesQuery);

    }


}