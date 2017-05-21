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
}