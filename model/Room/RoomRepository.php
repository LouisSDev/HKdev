<?php

/**
 * Created by PhpStorm.
 * User: home
 * Date: 31/03/2017
 * Time: 10:08
 */
class RoomRepository extends Repository
{

    const OBJECT_CLASS_NAME = 'Room';


    public function getObjectClassName()
    {

        return self::OBJECT_CLASS_NAME;
    }

}