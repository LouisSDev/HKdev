<?php

/**
 * Created by PhpStorm.
 * User: LOUISSTEIMBERG
 * Date: 20/05/2017
 * Time: 15:08
 */
class DashboardController extends AdminController
{

    public function getEffectorsStocksByType()
    {
        $effectorTypeRepository = $this->getEffectorTypeRepository();
        $effectorTypes = $effectorTypeRepository->getAll();
        $effectorsByType = array();
        /** @var EffectorRepository $effectorRepo */
        /** @var EffectorType $effectorType */
        foreach ($effectorTypes as $effectorType) {
            $effectorsByType[$effectorType->getName()] = $effectorRepo->getUnusedEffectorsByType($effectorType->getId());
        }
        return $effectorsByType;
    }

    public function getSensorsStocksByType()
    {
        $sensorTypeRepo = $this->getSensorRepository();
        $sensorTypes = $sensorTypeRepo->getAll();
        $sensorsByType = array();
        /** @var SensorRepository $sensorRepo */
        /** @var SensorType $sensorType */
        foreach ($sensorTypes as $sensorType) {
            $sensorsByType[$sensorType->getName()] = $sensorTypeRepo->getSensorsUnusedByType($sensorType->getId());
        }
        return $sensorsByType;
    }

    public function createStocksArrays()
    {
        $effectorStock = $this->getEffectorsStocksByType();
        $sensorStock = $this->getSensorsStocksByType();
        $this->args['effectorStock'] = json_encode($effectorStock);
        $this->args['sensorStock'] = json_encode($sensorStock);
        $this->generateView('backoffice/dashboard.php', "Tableau de bord Administrateur");
    }

    //modif le nom prix et ref //pareil pour les effecteurs

    private function changeSensors($sensorsTypes)
    {

        if (!empty($_POST['sensorType']) && !empty($_POST['newSensorRef']) && !empty($_POST['newSensorPrice']) && !empty($_POST['newSensorName'])) {
            /** @var SensorType $sensorType
             */

            $sensorType = null;


            /**@var SensorType $stp */
            foreach ($sensorsTypes as $stp) {
                if ($stp->getId() === $_POST['sensorType']) {
                    $sensorType = $stp;
                    break;
                }
            }

            if ($sensorType) {

                $Ref = null;
                $Price = null;
                $Name = null;

                if ($sensorType->setName($_POST['newSensorName'])) {
                    $this->args['success_message'] = "Félicitation le nom du capteur à bien été ajoutés aux stocks informatiques";
                    $Name = true;
                } else if ($sensorType->setPrice($_POST['newSensorPrice'])) {
                    $this->args['success_message'] = "Félicitation le prix du capteur à bien été ajoutés aux stocks informatiques";
                    $Price = true;
                } else if ($sensorType->setRef($_POST['newSensorRef'])) {
                    $this->args['success_message'] = "Félicitation la référence du capteur à bien été ajoutés aux stocks informatiques";
                    $Ref = true;
                } else {
                    $this->args['error_message'] = "Les données entrées ne sont pas valides";
                    $this->args['errors'] = $sensorType->getErrorMessage();
                }

                if($Name=){
                };
                else if(){

                };
                else if(){

                };
            } else {
                $this->args['error_message'] = "Les données entrées ne sont pas valides";
            }
        } else {
            $this->args['error_message'] = "Veuillez sélectionner un capteur";
        }
    }


    private function changeEffector($effectorTypes)
    {

        if (!empty($_POST['effectorType']) && !empty($_POST['newEffectorRef']) && !empty($_POST['newSensorName'])) {
            /** @var SensorType $sensorType
             */

            $sensorType = null;
            $newSensorsTypes = null;
            $newSensorsPrice = null;
            $newSensorsName = null;


            /**@var SensorType $stp */
            foreach ($sensorsTypes as $stp) {
                if ($stp->getId() === $_POST['sensorType']) {
                    $sensorType = $stp;
                    break;
                }
            }

            if ($sensorType) {
                $sensorType->setName($_POST['newSensorName']);
                $sensorType->setPrice($_POST['newSensorPrice']);
                $sensorType->setRef($_POST['newSensorRef']);
                if ($sensorType->setName($_POST['newSensorName'])->save($this->db) &&
                    $sensorType->setPrice($_POST['newSensorPrice'])->save($this->db) &&
                    $sensorType->setRef($_POST['newSensorRef'])->save($this->db)
                ) {
                    $this->args['success_message'] = "Félicitation le nom du capteur, ça référence et son prix ont bien été ajoutés aux stocks informatiques";
                } else {

                    $this->args['error_message'] = "Les données entrées ne sont pas valides";
                    $this->args['errors'] = $sensorType->getErrorMessage();
                }

            } else {
                $this->args['error_message'] = "Les données entrées ne sont pas valides";
            }
        } else {
            $this->args['error_message'] = "Veuillez sélectionner un capteur";
        }

    }
}