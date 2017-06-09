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
     *
     * @return $this
     */
    public function setType($type)
    {
        if(in_array($type, self::TYPE_ARRAY)){
            $this->type = $type;
        }
        else{
            Utils::addWarning("This isn\'t a valid room type");
            $this->error = true;
            $this->errorMessage []= "This isn\'t a valid room type";
        }
        $this->type = $type;
        return $this;
    }



    /**
     * @return array
     */
    public function getSensors()
    {
        if(!$this -> sensors) {
            /** @var Repository $repo */
            $repo = $GLOBALS['repositories']['sensor'];
            $this->sensors = $repo->getObjectsFromId($this, $this->getClassName(), 'sensor');
        }
        return $this->sensors;
    }

    /**
     * @param array $sensors
     * @return Room
     */
    public function setSensors($sensors)
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
            Utils::addWarning("The parameter is not a Home");
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
            Utils::addWarning("This name is too long");
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
        if(!$this -> effectors) {
            /** @var Repository $repo */
            $repo = $GLOBALS['repositories']['effector'];
            $this->effectors = $repo->getObjectsFromId($this, $this->getClassName(), 'effector');
        }
        return $this->effectors;
    }

    /**
     * @param array $effectors
     * @return Room
     */
    public function setEffectors($effectors)
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
        if(! in_array($sensor,$this->getSensors())){
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
        if(! in_array($sensor,$this->getSensors())){
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
        if(! in_array($effector,$this->getEffectors())){
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
        if(! in_array($effector,$this->getEffectors())){
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
     * @param $type string
     * @return array
     */
    public function getEffectorsPerType($type){

        $effectors = [];

        /** @var Effector $eff */
        foreach ($this -> getEffectors() as $eff){
            if($eff -> getEffectorType() -> getType() === $type){
                $effectors[] = $eff;
            }
        }


        return $effectors;
    }

    public function getAllEffectorsTypeInRoom(){

        $usedTypes = [];
        $effectorTypes = null;

        /** @var Effector $effector */
        foreach ($this -> getEffectors() as $effector){
            if(!in_array($effector -> getEffectorType() -> getType(), $usedTypes)){
                $usedTypes[] = $effector -> getEffectorType() -> getType();
                $effectorTypes[] = $effector -> getEffectorType();
            }
        }

        return $effectorTypes;
    }


}