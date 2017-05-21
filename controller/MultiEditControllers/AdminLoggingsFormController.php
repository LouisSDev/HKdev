<?php

/**
 * Created by PhpStorm.
 * User: LOUISSTEIMBERG
 * Date: 20/05/2017
 * Time: 15:08
 */
class AdminLoggingsFormController extends DashboardController
{
    private function removeEffector($effectorsTypes)
    {

        if (!empty($_POST['effectorType'])) {
            /** @var EffectorType $effectorType */
            $effectorType = null;

            /**@var EffectorType $stp */
            foreach ($effectorsTypes as $stp) {
                if ($stp->getId() === $_POST['effectorType']) {
                    $effectorType = $stp;
                    break;
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

    public function addEffectors($effectorsTypes){

    if (!empty($_POST['effectorType']) && !empty($_POST['effectorNb'])){

        /**@var EffectorType $effectorType*/
        $effectorType = null;

        /**@var EffectorType $stp*/
        foreach ($effectorsTypes as $stp) {
            if ($stp->getId() === $_POST['effectorType']) {
                $effectorType = $stp;
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
        $this->args['error_message'] = "Veuillez sélectionner un capteur";

    }

}
    public function addEffectorType($effectorsTypes){

        if (!empty($_POST['effectorType']) && !empty($_POST['effectorNb'])){

            /**@var EffectorType $effectorType*/
            $effectorType = null;

            /**@var EffectorType $stp*/
            foreach ($effectorsTypes as $stp) {
                if ($stp->getId() === $_POST['effectorType']) {
                    $effectorType = $stp;
                }
            }

            if($effectorType){

                for($i = 1 ; $i <= $_POST['effectorNb'] ; $i++){
                    $effectorType = new EffectorType();
                    if ($effectorType->save($this->db) ) {
                        $this->args['success_message'] = "Félicitation le nouveau type d'effecteurs a bien été ajouté à la liste informatiques";
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
            $this->args['error_message'] = "Veuillez sélectionner un capteur";

        }

    }
}