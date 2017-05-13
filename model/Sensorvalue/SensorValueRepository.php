<?php

/**
 * Created by PhpStorm.
 * User: Adrien
 * Date: 18/04/2017
 * Time: 10:26
 */
class SensorValueRepository extends Repository
{
    const OBJECT_CLASS_NAME = 'SensorValue' ;


    public function getObjectClassName()
    {
        return self::OBJECT_CLASS_NAME;
    }
}