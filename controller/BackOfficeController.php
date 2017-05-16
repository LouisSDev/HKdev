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

        $sensorsTypes =  $sensorTypeRepository -> getAll();

        $this -> args['sensors_types'] = $sensorsTypes ;

        $effectorTypes =  $effectorTypeRepository -> getAll();

        $this -> args['effectors_types'] = $effectorTypes ;

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            // CONTROLLER TESTS
        }


        $this -> generateView('backoffice/products.php', 'Gérer les Capteurs et les Effecteurs');

    }




}