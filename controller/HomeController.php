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
        $home = $this -> getHomeFromId($id);
        $building = $home -> getBuilding();

        // If this home's building is not either null or itself, it means that this home isn't a building!
        // Therefore, we'll throw a 404 error because this page only exist for buildings and not for home
        if($home  !== $building
            && $building !== null ){
            $this -> generateView('404.php', '404 : Not Found', '404');
            exit();
        }

        $this -> args['building'] = $building;
        $this -> generateView('administrateBuilding.php', 'Administrate My Building');
    }

    /**
     * @param $id
     * @return Home
     */

    public function getHomeFromId($id){


        /** @var Home $home */
        $home = null;

        /** @var Home $hm */
        foreach ($this -> user -> getHomes() as $hm)
        {
            if($hm -> getId() === $id){
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