<?php

/**
 * Created by PhpStorm.
 * User: LOUISSTEIMBERG
 * Date: 20/05/2017
 * Time: 15:08
 */
class DashboardController extends AdminController
{

    public function getEffectorsStocksByType(){
        $effectorTypeRepository = $this -> getEffectorTypeRepository();
        $effectorTypes = $effectorTypeRepository -> getAll();
        $effectorsByType = array();
        /** @var EffectorRepository $effectorRepo */
        /** @var EffectorType $effectorType */
        foreach ($effectorTypes  as $effectorType){
            $effectorsByType[$effectorType -> getName()] = $effectorRepo -> getUnusedEffectorsByType($effectorType -> getId());
        }
        return $effectorsByType;
    }

    public function getSensorsStocksByType(){
        $sensorTypeRepo = $this -> getSensorRepository();
        $sensorTypes = $sensorTypeRepo -> getAll();
        $sensorsByType = array();
        /** @var SensorRepository $sensorRepo */
        /** @var SensorType $sensorType */
        foreach ($sensorTypes as $sensorType){
            $sensorsByType[$sensorType -> getName()] = $sensorTypeRepo -> getSensorsUnusedByType($sensorType -> getId());
        }
        return $sensorsByType;
    }

    public function createStocksArrays(){
        $effectorStock = $this->getEffectorsStocksByType();
        $sensorStock = $this->getSensorsStocksByType();
        $this->args['effectorStock'] = json_encode($effectorStock);
        $this->args['sensorStock'] = json_encode($sensorStock);
        $this -> generateView('backoffice/dashboard.php',"Tableau de bord Administrateur");
    }

 //modif le nom prix et ref //pareil pour les effecteurs

    private function changeNameSensors($sensorsTypes,$newSensorsTypes)
    {

        if (!empty($_POST['sensorType'])&& !empty($_POST['newSensorType'])) {
            /** @var SensorType $sensorType
                @var NewSensorType $newSensorType
             */

            $sensorType = null;
            $newSensorsTypes = null;

            /**@var SensorType $stp */
            foreach ($sensorsTypes as $stp) {
                if ($stp->getId() === $_POST['sensorType'] ) {
                    $sensorType = $stp;
                    break;
                }
            }

            if ($sensorType) {
                for($i = 1 ; $i <= $_POST['sensorNb'] ; $i++){
                    $sensor = new Sensor();
                    if ($sensor->setSensorType($sensorType)->save($this->db) ) {
                        $this->args['success_message'] = "Félicitation les capteurs ont bien été ajoutés aux stocks informatiques";
                    }
                    else {

                        $this->args['error_message'] = "Les données entrées ne sont pas valides";
                        $this->args['errors'] = $sensorType->getErrorMessage();
                    }
                }
            } else {
                $this->args['error_message'] = "Les données entrées ne sont pas valides";
            }
        }else{
            $this->args['error_message'] = "Veuillez sélectionner un capteur";
        }
    }
}