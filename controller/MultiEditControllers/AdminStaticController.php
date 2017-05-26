<?php

/**
 * Created by PhpStorm.
 * User: LOUISSTEIMBERG
 * Date: 20/05/2017
 * Time: 15:09
 */
class AdminStaticController extends AdminLoggingsFormController
{
    protected function removeRoom($rooms)
    {
        if (!empty($_POST['room'])) {
            /** @var Room $room */
            $room = null;
            /**@var Room $rm */
            foreach ($rooms as $rm) {
                if ($rm->getId() === $_POST['roomId']) {
                    $room = $rm;
                    break;
                }
            }
            if ($room) {
                $this -> deleteRoom($room);
                $this->args['success_message'] = "Félicitation vous avez bien supprimé une pièce";
            } else {
                $this->args['error_message'] = "Les données entrées ne sont pas valides";
            }
        }else{
            $this->args['error_message'] = "Veuillez sélectionner une pièce à supprimer";
        }
    }

    protected function deleteRoom(Room $room){
        /**@var Effector $eff */
        foreach ($room->getEffectors() as $eff){
            $eff->delete($this->db);
        }
        /**@var Sensor $sns */
        foreach ($room->getSensors() as $sns){
            $this->getSensorValueRepository()->deleteValuesFromSensors($sns->getId());
            $sns->delete($this->db);
        }
        $room->delete($this->db);
    }

    private function sendMail(){
        
    }

}