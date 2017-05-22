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




    public function changeSensors($sensorsTypes)
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

                if($sensorType -> save($this -> db)) {
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
                }else{
                    $this->args['error_message'] = "Les données entrée nous pas pu être enregistrées dans les stocks informatiques";
                    $this->args['errors'] = $sensorType->getErrorMessage();
                }
            }
            else{
                $this->args['error_message'] = "Les données entrée ne sont pas valide";
                $this->args['errors'] = $sensorType->getErrorMessage();
            }
        }
    }


    public function changeEffectors($effectorTypes)
    {

        if (!empty($_POST['effectorType'])) {
            /** @var EffectorType $effectorType
             */

            $effectorType = null;


            /**@var EffectorType $stp */
            foreach ($effectorTypes as $stp) {
                if ($stp->getId() === $_POST['effectorType']) {
                    $effectorType = $stp;
                    break;
                }
            }

            if ($effectorType) {
                $message = [];
                if (!empty($_POST['name'])) {
                    $effectorType -> setName($_POST['name']);
                    $message[] = "Le nom de l'effecteur a bien été modifié";
                }

                if (!empty($_POST['ref'])) {
                    $effectorType -> setRef($_POST['ref']);
                    $message[] = "La référence de l'effecteur a bien été modifié";
                }

                if($effectorType -> save($this -> db)) {
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
                }else{
                    $this->args['error_message'] = "Les données entrée nous pas pu être enregistrées dans les stocks informatiques";
                    $this->args['errors'] = $effectorType->getErrorMessage();
                }
            }
            else{
                $this->args['error_message'] = "Les données entrée ne sont pas valide";
                $this->args['errors'] = $effectorType->getErrorMessage();
            }
        }
    }
}