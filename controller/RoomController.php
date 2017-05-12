<?php

/**
 * Created by PhpStorm.
 * User: LOUISSTEIMBERG
 * Date: 12/05/2017
 * Time: 10:37
 */
class RoomController extends AccountManagingController
{

    public function updateEffectorsInARoom()
    {
        $this -> enableApiMode();


        if($_SERVER['REQUEST_METHOD'] === 'POST'
            && !empty($_POST['roomId'])
            && !empty($_POST['effectorType'])
            && in_array($_POST['effectorType'], EffectorType::TYPE_ARRAY)
            && (!empty($_POST['value']) ||  !empty($_POST['state']) || !empty($_POST['auto']))
        )
        {
            $room = $this -> findRoomFromIdInUsersRooms($_POST['roomId']);

            $effectors = array();

            // For each effectors in the room
            $this -> updateEffectors($effectors);

        }
    }

    private function updateEffectors($effectors){
        /** @var Effector $eff */
        foreach ($effectors as $eff){

            if($eff -> getEffectorType() -> getType() === $_POST['effectorType']){
                $effectors[] = $eff;

                if($eff -> getEffectorType() -> getChart() && !empty($_POST['state'])){
                    ApiHandler::throwError(400, 'Vous ne pouvez pas modifier l\'état de ce type d\'effecteur');
                }

                if(!$eff -> getEffectorType() -> getChart() && !empty(empty($_POST['value']))){
                    ApiHandler::throwError(400, 'Vous ne pouvez pas modifier la valeur de ce type d\'effecteur');
                }
            }
        }

        /** @var Effector $eff */
        foreach($effectors as $eff){
            if($eff -> getEffectorType() -> getChart()){
                if(!empty($_POST['value'])){
                    $eff -> setValue($_POST['value']);
                }
                else if(!empty($_POST['auto'])){
                    $eff -> setAuto($_POST['auto']);
                }
            }

            else{
                if(!empty($_POST['state'])){
                    $eff -> setState($_POST['state']);
                }
                else if(!empty($_POST['auto'])){
                    $eff -> setAuto($_POST['auto']);
                }
            }

        }

        $this -> user -> save($this -> db);
    }


}