<?php

/**
 * Created by PhpStorm.
 * User: LOUISSTEIMBERG
 * Date: 20/05/2017
 * Time: 15:08
 */
class AdminLoggingsFormController extends DashboardController
{
    protected function addSensorType()
    {

        $sensorType = new SensorType();
        $sensorType ->createFromResults($_POST);

        if($sensorType-> save($this->db)){
            $this->args['success_message'] = "Félicitation le capteur a bien été ajouté";
        } else {
            $this->args['error_message'] = "Les données entrées ne sont pas valides";
        }
    }
}