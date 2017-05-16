<?php

/**
 * Created by PhpStorm.
 * User: LOUISSTEIMBERG
 * Date: 18/04/2017
 * Time: 08:45
 */

class SensorTypeRepository extends Repository
{

    const OBJECT_CLASS_NAME = 'SensorType';



    public function getObjectClassName()
    {
        return self::OBJECT_CLASS_NAME;
    }

    public function getSensorTypePerType($type)
    {
        $getSensorType = $this -> db -> prepare(
            'SELECT * FROM ' . self::OBJECT_CLASS_NAME
            . ' WHERE type = :type LIMIT 1');
        $getSensorType -> bindParam(':type' , $type, PDO::PARAM_STR, strlen($type));
        $getSensorType -> execute();

        return $this->getResultantObjects($getSensorType, false);
    }
}
