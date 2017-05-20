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
        foreach ($effectorTypes  as $effectorType -> getName() => $effectorRepo -> getUnusedEffectorsByType($effectorType -> getId())){
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
        foreach ($sensorTypes as $sensorType -> getName() => $sensorTypeRepo -> getSensorsUnusedByType($sensorType -> getId())){
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



}