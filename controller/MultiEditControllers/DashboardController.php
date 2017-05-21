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

        if (!empty($_POST['sensorType'])) {
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

                $okRef = null;
                $okPrice = null;
                $okName = null;

                if (!empty($_POST['newSensorRef'])) {
                    $sensorType->setName($_POST['newSensorName'])
                    $okName = true;
                }
                else {
                    $this->args['error_message'] = "Les données rentrées pour le nom du capteur ne sont pas valides";
                    $this->args['errors'] = $sensorType->getErrorMessage();
                }

                if (!empty($_POST['newSensorPrice'])) {
                    $sensorType->setPrice($_POST['newSensorPrice'])
                    $okPrice = true;
                }
                else {
                    $this->args['error_message'] = "Les données rentrées pour le prix du capteur ne sont pas valides";
                    $this->args['errors'] = $sensorType->getErrorMessage();
                }

                if (!empty($_POST['newSensorName'])) {
                    $sensorType->setRef($_POST['newSensorRef'])
                    $okRef = true;
                }
                else {
                    $this->args['error_message'] = "Les données rentrées pour la référence du capteur ne sont pas valides";
                    $this->args['errors'] = $sensorType->getErrorMessage();
                }


                if($okName){
                    $sensorType->save($this->db);
                    $this->args['success_message'] = "Félicitation le nom du capteur à bien été ajoutés aux stocks informatiques";
                    $okName=false;
                }
                else{
                    $this->args['error_message'] = "Echec d'ajouts du nom aux stocks informatiques ";
                }
                if($okPrice){
                    $sensorType->save($this->db);
                    $this->args['success_message'] = "Félicitation le prix du capteur à bien été ajoutés aux stocks informatiques";
                    $okPrice=false;
                }
                else{
                    $this->args['error_message'] = "Echec d'ajouts du prix aux stocks informatiques ";
                }
                if($okRef){
                    $sensorType->save($this->db);
                    $this->args['success_message'] = "Félicitation la référence du capteur à bien été ajoutés aux stocks informatiques";
                    $okRef =false;
                }
                else{
                    $this->args['error_message'] = "Echec d'ajouts de la référence aux stocks informatiques ";
                }
            } else {
                $this->args['error_message'] = "Les données entrées ne sont pas valides";
            }
        } else {
            $this->args['error_message'] = "Veuillez remplir les champs de modification !";
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