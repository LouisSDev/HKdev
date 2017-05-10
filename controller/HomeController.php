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
        $this -> generateView('user/myHome.php', 'My Home');

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
        $home = $this -> getHomeFromId($id);
        $this -> args['home'] = $home;

            /** @var SensorTypeRepository $sensorTypeRepository */
        $sensorTypeRepository = $GLOBALS['repositories']['sensor_type'];

        // If the form was submitted
        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            // If a sensorType was selected and if it's an integer
            if(!empty($_POST['sensorType']) && is_int($_POST['sensorType'])
                && !empty($_POST['sensorId']) && is_int($_POST['sensorId'])
                && !empty($_POST['room']) && is_int($_POST['room'])
            ){
                // We search for this sensor type in the database
                /** @var SensorType $sensorType */
                $sensorType = $sensorTypeRepository -> findById($_POST['sensorType']);

                // We now search for the sensor
                /** @var SensorRepository $sensorRepository */
                $sensorRepository = $GLOBALS['repositories']['sensor'];

                /** @var Sensor $sensor */
                $sensor =  $sensorRepository -> findById($_POST['sensorId']);

                // And we finally search for the room

                $room = $this -> findRoomFromId($home, $_POST['room']);

                if($sensorType && $room ){

                    if($sensor && $sensor -> getSensorType() -> getRef() === $sensorType -> getRef()
                    && $sensor -> getRoom() == null)
                    {
                        $room -> addSensor($sensor);
                        $this -> args['message'] = 'Le capteur a été ajouté à vos capteurs avec succès';
                    }
                    else {
                        $this -> args['message'] = 'Le code du capteur entré n\'est pas valide, veuillez réessayer.';
                    }
                }
                // If we don't find it we'll throw an error message
                else{
                    $this -> args['message'] = 'Veuillez remplir correctement le formulaire';
                }

            }else{
                $this -> args['message'] = 'Veuillez remplir correctement le formulaire';
            }
        }


        $sensorsTypes =  $sensorTypeRepository -> getAll();

        $this -> args['sensors_types'] = $sensorsTypes ;
        $this -> generateView('sensors.php', 'My Home :  Buy New Sensors');
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

        $this -> generateView('static/404.php', '404');
        exit();

    }

    /**
     * @param Home $home
     * @param $room
     * @return Room
     */
    private function findRoomFromId(Home $home, $roomId)
    {
        $room = null;
        /** @var Room $rm */
        foreach($home -> getHomes() as $rm ){
            if($rm -> getId() === $roomId){
                $room = $rm;
                break;
            }
        }

        if($room){
            return $room;
        }

        $this -> generateView('static/404.php', '404');
        exit();
    }


}