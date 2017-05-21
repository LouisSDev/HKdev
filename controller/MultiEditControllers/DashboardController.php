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
                $message = [];
                if (!empty($_POST['name'])) {
                    $sensorType -> setName($_POST['name']);
                    $message[] = 'Le nom du capteur a bien été modifié';
                }
                if (!empty($_POST['ref'])) {
                    $sensorType -> setRef($_POST['ref']);
                    $message[] = 'La référence du capteur a bien été modifié';
                }

                if (!empty($_POST['price'])) {
                    $sensorType -> setRef($_POST['price']);
                    $message[] = 'Le prix du capteur a bien été modifié';
                }

                if($sensorType -> save($this -> db){
                    $successMessage = [];
                    $i = 0;
                    foreach ($message as $mssg) {
                        $successMessage .= $mssg;
                        if ($i != sizeof($message) - 1) {
                            $successMessage .= '<br>';
                        }
                        $i++;
                    }
                    $this->args['success_message'] = $successMessage;
                else{
                    $this->args['error_message'] = "Les données entrée nous pas pu être enregistrées dans les stocks informatiques";
                    $this->args['errors'] = $sensorType->getErrorMessage();
                }
                }
            }
            else{
                $this->args['error_message'] = "Les données entrée ne sont pas valide";
                $this->args['errors'] = $sensorType->getErrorMessage();
            }
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
            foreach ($effectorTypes as $stp) {
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