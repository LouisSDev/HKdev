<?php

/**
 * Created by PhpStorm.
 * User: LOUISSTEIMBERG
 * Date: 13/05/2017
 * Time: 17:39
 */
class BuildingController extends AccountManagingController
{

    public function __construct(PDO $db)
    {
        parent::__construct($db);
        $path =   explode( '/', $_SERVER['REQUEST_URI']);
        $this -> args['building'] = $this -> findHomeFromId($path[4], true);
    }



    public function displayAdministration()
    {
        $this -> generateView('building/administrateBuilding.php', 'Administrate My Building');
    }


}