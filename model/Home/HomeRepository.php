<?php


class HomeRepository extends Repository
{

    const OBJECT_CLASS_NAME = 'Home';



    public function getObjectClassName()
    {
        return self::OBJECT_CLASS_NAME;
    }


}