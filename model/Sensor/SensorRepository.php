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

}

