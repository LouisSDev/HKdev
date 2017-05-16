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

        /**@var SensorType $sensorsTypes*/
        $sensorsTypes =  $sensorTypeRepository -> getAll();

        $this -> args['sensors_types'] = $sensorsTypes ;

        /**@var EffectorType $effectorTypes*/

        $effectorTypes =  $effectorTypeRepository -> getAll();

        $this -> args['effectors_types'] = $effectorTypes ;

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            if(!empty($_POST['sensorType'])){

                /**@var SensorType $stp*/
                foreach ($sensorsTypes as $stp){
                    if($stp->getId()===$_POST['sensorType']){
                        $sensorTypeToBeDeleted = $stp;
                        $sensorTypeToBeDeleted->setSelling(false);
                        if($sensorsTypes->save($this->db)){
                            $this->args['success_message']= "Félicitation le capteur sélectionné a bien été supprimé";
                        }
                        else{
                            $this->args['error_message']="La suppression demandée ne peut être éffectué";
                            $this->args['errors']=$sensorsTypes->getErrorMessage();


                        }

                    }
                    else{

                        $this->args['errors']=$sensorsTypes->getErrorMessage();
                    }
                }
            }
            else{
                $this -> args['error_message'] = "Veuillez choisir un type de capteur à supprimer";

            }

        }

        $this -> generateView('backoffice/products.php', 'Gérer les Capteurs et les Effecteurs');

    }




}