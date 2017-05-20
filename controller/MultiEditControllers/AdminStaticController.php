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

}