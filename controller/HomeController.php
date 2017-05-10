<?php

/**
 * Created by PhpStorm.
 * User: LOUISSTEIMBERG
 * Date: 09/05/2017
 * Time: 09:14
 */
class HomeController extends Controller
{

    protected $connectionRequired = true;

    public function displayRooms($id)
    {
        $this -> args['home'] = $this -> getHomeFromId($id);
        $this -> generateView('myHome.php', 'My Home');

    }


    public function displayGeneral($id)
    {
        $this -> args['home'] = $this -> getHomeFromId($id);
        $this -> generateView('homeGeneral.php', 'My Home :  General View');
    }

    public function displayAdministration($id)
    {
        $this -> args['building'] = $this -> getHomeFromId($id, true);
        $this -> generateView('administrateBuilding.php', 'Administrate My Building');
    }


    public function buyNewSensor($id)
    {
        $this -> args['home'] = $this -> getHomeFromId($id);
        $this -> generateView('sensors.php', 'My Home :  Buy New Sensor');
    }

    /**
     * @param $id
     * @return Home
     */

    public function getHomeFromId($id, $onlyAdmin = false){


        /** @var Home $home */
        $home = null;

        /** @var Home $hm */
        foreach ($this -> user -> getHomes() as $hm)
        {
            if($hm -> getId() === $id
                && $hm -> isBuilding() === $onlyAdmin)
            {
                $home = $hm;
                break;
            }
        }

        if($home)
        {
            return $home;
        }

        $this -> generateView('404.php', '404');
        exit();

    }


}