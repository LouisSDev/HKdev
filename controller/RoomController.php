<?php

/**
 * Created by PhpStorm.
 * User: LOUISSTEIMBERG
 * Date: 12/05/2017
 * Time: 10:37
 */
class RoomController extends AccountManagingController
{

    public function updateSensor()
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST'
            && !empty($_POST['roomId'])
            && !empty($_POST['sensorType'])
            && in_array($_POST['sensorType'], SensorType::TYPE_ARRAY)
            && (!empty($_POST['value']) ||  !empty($_POST['state']) || !empty($_POST['auto']))
        )
        {

        }
    }
}