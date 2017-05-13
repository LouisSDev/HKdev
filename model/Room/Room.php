<?php

/**
 * Created by PhpStorm.
 * User: home
 * Date: 28/03/2017
 * Time: 10:00
 */
class Room extends DatabaseEntity
{
    const TYPE_ARRAY = ["Chambres", "Cuisines", "Pièces à vivre", "Salles d'eau"];


    /**
     * @var $name string
     */
    private $name;

    /**
     * @var $type string
     *
     * must be one of those : ROOM , LIVING_ROOM , KITCHEN
     */
    private $type;

    /**
     * @var $sensors array;
     */
    private $sensors = array();

    /**
     * @var $effectors array;
     */
    private $effectors = array();

    /**
     * @var $home Home;
     */
    private $home;

    /**
     * @return Home
     */
    public function getHome()
    {
        return $this->home;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        if(in_array($type, self::TYPE_ARRAY)){
            $this->type = $type;
        }
        else{
            $this->error = true;
            $this->errorMessage []= "This isn\'t a valid room type";
        }
        $this->type = $type;
    }



    /**
     * @return array
     */
    public function getSensors()
    {
        return $this->sensors;
    }

    /**
     * @param array $sensors
     * @return Room
     */
    public function setSensors(array $sensors)
    {
        $this->sensors = $sensors;
        return $this;
    }



    /**
     * @param Home $home
     * @return Room;
     */
    public function setHome(Home $home)
    {
        if($home instanceof Home){
            $this->home = $home;
        }
        else{
            $this->error = true;
            $this->errorMessage[] =  "The parameter is not a Home";
        }

        return $this;
    }

    /**
     * @param string $name
     * @return Room
     */
    public function setName($name)
    {
        if(strlen($name)<=40){
            $this->name = $name;
        }
        else{
            $this->error = true;
            $this->errorMessage []= "This name is too long";
        }

        return $this;
    }

    /**
     * @return array
     */
    public function getEffectors()
    {
        return $this->effectors;
    }

    /**
     * @param array $effectors
     * @return Room
     */
    public function setEffectors(array $effectors)
    {
        $this->effectors = $effectors;
        return $this;
    }



    /**
     * Add sensor
     * @param Sensor $sensor
     * @return $this
     */

    public function addSensor(Sensor $sensor){
        if(! in_array($sensor,$this->sensors)){
            array_push($this->sensors,$sensor);
            $sensor->setRoom($this);
        }
        return $this;
    }

    /**
     * Remove sensor
     * @param Sensor $sensor
     * @return $this
     */
    public function removeSensor(Sensor $sensor){
        if(! in_array($sensor,$this->sensors)){
            unset($this->sensors[array_search($sensor,$this->sensors)]);
            $sensor->setRoom(null);
        }
        return $this;
    }



    /**
     * Add effector
     * @param Effector $effector
     * @return $this
     */

    public function addEffector(Effector $effector){
        if(! in_array($effector,$this->effectors)){
            array_push($this->effectors,$effector);
            $effector->setRoom($this);
        }
        return $this;
    }

    /**
     * Remove effector
     * @param Effector $effector
     * @return $this
     */
    public function removeEffector(Effector $effector){
        if(! in_array($effector,$this->effectors)){
            unset($this->effectors[array_search($effector,$this->effectors)]);
            $effector->setRoom(null);
        }
        return $this;
    }



    public function getValid()
    {
        if($this->error){
            return false;
        }else{
            if( $this->name != null
                && $this ->home != null
                && $this->sensors != null
            ){
                return true;
            }else{
                return false;
            }
        }
    }

    public function getClassName(){
        return self::class;
    }

    public function getObjectVars(){
        return get_object_vars($this);
    }

    /**
     * @param $type string
     * @return array
     */
    public function getSensorsPerType($type){

        $sensors = [];

        /** @var Sensor $sensor*/
        foreach ($this -> getSensors() as $sensor){
            if($sensor -> getSensorType() -> getType() === $type){
                $sensors[] = $sensor;
            }
        }


        return $sensors;
    }

    /**
     * @return Room
     *
     *//*
    public function save($db){

        if ($this->getValid()){
            if($this -> id == -1){
                $newRoom = $db -> prepare('INSERT INTO room(name, home) VALUES (:name, :home)');
                $newRoom -> bindParam('name',$this->name,PDO::PARAM_STR, strlen($this->name));
                $newRoom -> bindParam('home',$this->home);
                $newRoom -> execute();
                $newRoom -> closeCursor();
                $this -> id = $db->lastInsertId();

            }
            else{
                $updateRoom = $db->prepare('UPDATE room SET name = :name,  home = :home WHERE id = :id ' );
                $updateRoom -> bindParam(':name',$this->name,PDO::PARAM_STR,strlen($this->name));
                $updateRoom -> bindParam(':home', $this-> home -> getId(), PDO::PARAM_INT);
                $updateRoom -> bindParam(':id', $this->id, PDO::PARAM_INT);
                $updateRoom -> execute();
                $updateRoom -> closeCursor();
            }

        }



        // TODO : Cascade
        // TODO : Cascade
        // TODO : Cascade
        // TODO : Cascade
        // TODO : Cascade
        // TODO : Cascade
        // TODO : Cascade
        // TODO : Cascade
        // TODO : Cascade
        // TODO : Cascade
        // TODO : Cascade
        // TODO : Cascade

        return $this;
    }


    public function delete($db)
    {
        $request = $db->prepare('DELETE FROM room WHERE id = :id');
        $request ->bindParam(':id', $this->id, PDO::PARAM_INT);
        $request->execute();
        $request->closeCursor();
        return $this;

    }


    public function createFromResults($data)
    {
        // TODO: Implement createFromResults() method.
    } */
}