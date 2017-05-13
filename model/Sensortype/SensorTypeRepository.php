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
}
