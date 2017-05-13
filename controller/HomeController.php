<?php


class HomeController extends AccountManagingController
{

    public function __construct(PDO $db, $checkHomeId = true)
    {
        parent::__construct($db);
        if($checkHomeId) {
            $path = explode('/', $_SERVER['REQUEST_URI']);
            $this->args['home'] = $this->findHomeFromId($path[4]);
        }
    }


    public function displayGeneral()
    {
        $this -> generateView('home/main.php', 'My Home');
    }


    public function buyNewSensor()
    {
        $home = $this -> args['home'];

            /** @var SensorTypeRepository $sensorTypeRepository */
        $sensorTypeRepository = $GLOBALS['repositories']['sensorType'];

        // If the form was submitted
        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            // If a sensorType was selected and if it's an integer
            if(!empty($_POST['sensorType'])
                && !empty($_POST['sensorId'])
                && !empty($_POST['room'])
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

                    if($sensor && $sensor -> getSensorType() -> getId() === $sensorType -> getId()
                    && !$sensor -> getRoom())
                    {
                        if($sensor -> setRoom($room) -> save($this -> db)){
                            $this -> args['message'] = 'Le capteur a été ajouté à vos capteurs avec succès';
                        }
                        else{
                            $this -> args['message'] = 'Oups une erreur est survenue dans la base de données, nous essayons de la régler au plus vite';
                        }
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
        $this -> generateView('sensors.php', 'Mes Capteurs');
    }



    public function deleteSensor()
    {
        $home = $this -> args['home'];
        if(!empty($_POST['sensorId'])) {
            $sensor = $this->findSensorFromId($_POST['sensorId'], $home);
            $sensor->delete($this->db);
            $this -> generateView('sensors.php', 'Mes Capteurs', 'user/home/' . $home -> getId() . '/sensors');
        }else{
            $this -> generateView('static/404.php', '404');
            exit();
        }
    }

    public function updateEffectorsInAHome()
    {
        $this -> enableApiMode();


        if($_SERVER['REQUEST_METHOD'] === 'POST'
            && !empty($_POST['homeId'])
            && !empty($_POST['effectorType'])
            && in_array($_POST['effectorType'], EffectorType::TYPE_ARRAY)
            && (!empty($_POST['value']) ||  !empty($_POST['state']) || !empty($_POST['auto']))
        )
        {
            $home = $this -> findHomeFromId($_POST['homeId']);

            $effectors = array();

            // For each effectors in the room
            $this -> updateEffectors($home -> getAllEffectors());

        }
    }


}