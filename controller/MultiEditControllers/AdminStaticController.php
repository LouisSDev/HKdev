<?php

/**
 * Created by PhpStorm.
 * User: LOUISSTEIMBERG
 * Date: 20/05/2017
 * Time: 15:09
 */
class AdminStaticController extends AdminLoggingsFormController
{
    protected function addEffectorType(){
        $effectorType = new EffectorType();
        $effectorType ->createFromResults($_POST);

            if($effectorType-> save($this->db)){
                $this->args['success_message'] = "Félicitation l'effecteur sélectionné a bien été ajouté";
            } else {
                $this->args['error_message'] = "Les données entrées ne sont pas valides";
            }

    }





    protected function addEffectors($effectorsTypes){

        if (!empty($_POST['effectorType']) && !empty($_POST['effectorNb'])){

            /**@var EffectorType $effectorType*/
            $effectorType = null;

            /**@var SensorType $etp*/
            foreach ($effectorsTypes as $etp) {
                if ($etp->getId() === $_POST['effectorTypeId']) {
                    $effectorType = $etp;
                }
            }

            if($effectorType){

                for($i = 1 ; $i <= $_POST['effectorNb'] ; $i++){
                    $effector = new Effector();
                    if ($effector->setEffectorType($effectorType)->save($this->db) ) {
                        $this->args['success_message'] = "Félicitation les effecteurs ont bien été ajoutés aux stocks informatiques";
                    }
                    else {

                        $this->args['error_message'] = "Les données entrées ne sont pas valides";
                        $this->args['errors'] = $effectorType->getErrorMessage();
                    }
                }

            }
            else{
                $this->args['error_message'] = "Les données entrées ne sont pas valides";
            }
        }
        else{
            $this->args['error_message'] = "Veuillez sélectionner un effecteur";

        }

    }

}