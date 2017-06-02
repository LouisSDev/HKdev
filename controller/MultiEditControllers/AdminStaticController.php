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

    protected function addRoom(){
        $room = new Room();
        $room ->createFromResults($_POST);

        if($room-> save($this->db)){
            $this->args['success_message'] = "Félicitation la pièce sélectionné a bien été ajoutée";
        } else {
            $this->args['error_message'] = "Les données entrées ne sont pas valides";
            $this->args['errors'] = $room->getErrorMessage();

        }
    }

    protected function modifyEffectorOnRoom($effectorTypes){

        if (!empty($_POST['room'])) {
            /** @var Room $room */
            $room = null;
            /**@var Room $rm */
            foreach ($room as $rm) {
                if ($rm->getId() === $_POST['roomId']) {
                    $room = $rm;
                    break;
                }
            }
            if ($room){
                if (!empty($_POST['effectorTypeId'])){

                    /**@var EffectorType $effectorType*/
                    $effectorType = null;

                    /**@var EffectorType $etp*/
                    foreach ($effectorTypes as $etp) {
                        if ($etp->getId() == $_POST['effectorTypeId']) {
                            $effectorType = $etp;
                        }
                    }
                    
                }
                else{
                    $this->args['error_message'] = "Veuillez sélectionner un effecteur";

                }
            }
        }


    }
}