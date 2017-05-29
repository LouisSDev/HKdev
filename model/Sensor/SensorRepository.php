<?php

/**
 * Created by PhpStorm.
 * User: Ismael
 * Date: 18/04/2017
 * Time: 09:11
 */
class SensorRepository extends Repository {

    const OBJECT_CLASS_NAME = 'Sensor' ;


    public function getObjectClassName()
    {
        return self::OBJECT_CLASS_NAME;
    }

    public function isSensorUnused($id)
    {
        $objectsQuery = $this -> db -> prepare('SELECT * FROM ' . $this -> getObjectClassName()
            . ' WHERE room IS NOT null AND id = :id');
        $objectsQuery -> bindParam(':id', $id, PDO::PARAM_INT);
        $objectsQuery -> execute();

        if( $this -> getResultantObjects($objectsQuery, false)){
            return false;
        }

        return true;
    }

    public function getSensorsUnusedByType($type){
        $objectQuery = $this -> db -> prepare('SELECT COUNT(*) FROM ' . $this ->getObjectClassName() . ' WHERE room IS null AND sensorType = :type');
        $objectQuery -> bindParam(':type', $type, PDO::PARAM_INT);
        $result = $objectQuery -> execute();
        return $result;
    }

}

