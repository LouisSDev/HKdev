<?php

/**
 * Created by PhpStorm.
 * User: LOUISSTEIMBERG
 * Date: 31/03/2017
 * Time: 10:04
 */
class EffectorRepository extends Repository
{
    const OBJECT_CLASS_NAME = 'Effector';

    public function getObjectClassName()
    {
        return self::OBJECT_CLASS_NAME;
    }

    public function getUnusedEffectorsByType($type){
        $objectQuery = $this -> db -> prepare('SELECT COUNT(*) AS nb FROM ' . $this ->getObjectClassName() . ' WHERE room IS null AND effectorType= :type');
        $objectQuery -> bindParam(':type', $type, PDO::PARAM_INT);
         $objectQuery -> execute();
        $columns = $objectQuery ->fetch();
        return  $columns['nb'];
    }

    public function getAllUsed()
    {
        $objectsQuery = $this -> db -> prepare('SELECT * FROM ' . $this -> getObjectClassName()
            . ' WHERE room IS NOT NULL');
        $objectsQuery -> execute();

        return $this -> getResultantObjects($objectsQuery);
    }
}