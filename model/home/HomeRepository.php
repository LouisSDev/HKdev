<?php


class HomeRepository extends Repository
{

    public function getHomesFromUserId(integer $id){
        $homesQuery = $this->db->prepare('SELECT * FROM home WHERE user = :user');
        $homesQuery -> bindParam(':user', $id, PDO::PARAM_INT);
        $homesQuery -> execute();

        $homes = array();
        while($homeData = $homesQuery -> fetch(PDO::FETCH_ASSOC)){

            $home = new Home();
            $home -> createFromResults($homeData);

            $homes[] = $home;
        }

        return $homes;
    }
}