<?php

/**
 * Created by PhpStorm.
 * User: LOUISSTEIMBERG
 * Date: 16/05/2017
 * Time: 09:26
 */
class BackOfficeController extends AdminController
{

    public function manageProducts(){

        /** @var SensorTypeRepository $sensorTypeRepository */
        $sensorTypeRepository = $GLOBALS['repositories']['sensorType'];
        /** @var EffectorTypeRepository $effectorTypeRepository */
        $effectorTypeRepository = $GLOBALS['repositories']['effectorType'];

        $sensorsTypes =  $sensorTypeRepository ->getAll();
        $this -> args['sensors_types'] = $sensorsTypes ;

        $effectorsTypes =  $effectorTypeRepository -> getAll();
        $this -> args['effectors_types'] = $effectorsTypes ;

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            if(!empty($_POST['submittedForm'])){

                switch($_POST['submittedForm']){
                    case 'REMOVE_SENSOR_TYPE':
                        $this -> removeSensor($sensorsTypes);
                        break;
                    case 'REMOVE_EFFECTOR_TYPE':
                        $this -> removeEffector($effectorsTypes);
                        break;
                    default:
                        $this -> generateView('static/404.php', '404');
                }
            }
            else{
                $this -> generateView('static/404.php', '404');

            }

        }

        $this -> generateView('backoffice/products.php', 'Gérer les Capteurs et les Effecteurs');

    }

    public function getAdminDashboard()
    {
        $this -> generateView('backoffice/dashboard.php', 'Tableau de bord Administrateur');
    }


    private function removeSensor($sensorsTypes)
    {

        if (!empty($_POST['sensorType'])) {
            /** @var SensorType $sensorType */
            $sensorType = null;

            /**@var SensorType $stp */
            foreach ($sensorsTypes as $stp) {
                if ($stp->getId() === $_POST['sensorType']) {
                    $sensorType = $stp;
                }
            }

            if ($sensorType) {
                $sensorType->setSelling(false);

                if ($sensorType->save($this->db)) {

                    $this->args['success_message'] = "Félicitation le capteur sélectionné a bien été supprimé";
                } else {
                    $this->args['error_message'] = "Les données entrées ne sont pas valides";
                    $this->args['errors'] = $sensorType->getErrorMessage();
                }
            } else {
                $this->args['error_message'] = "Les données entrées ne sont pas valides";
            }
        }else{
            $this->args['error_message'] = "Veuillez sélectionner un capteur";
        }
    }

    public function quoteValidation()
    {
        $this -> generateView('backoffice/quoteValidation.php', 'Devis à valider!' );
    }

    public function removeEffector($effectorsTypes)
    {
        if (!empty($_POST['effectorType'])) {
            /** @var EffectorType $effectorType */
            $sensorType = null;

            /**@var EffectorType $etp */
            foreach ($effectorsTypes as $etp) {
                if ($etp->getId() === $_POST['effectorType']) {
                    $effectorType = $etp;
                }
            }

            if ($effectorType) {
                $effectorType->setSelling(false);

                if ($effectorType->save($this->db)) {

                    $this->args['success_message'] = "Félicitation l'effecteur sélectionné a bien été supprimé";
                } else {
                    $this->args['error_message'] = "Les données entrées ne sont pas valides";
                    $this->args['errors'] = $effectorType->getErrorMessage();
                }
            } else {
                $this->args['error_message'] = "Les données entrées ne sont pas valides";
            }
        }else{
            $this->args['error_message'] = "Veuillez sélectionner un effecteur";
        }
    }


}