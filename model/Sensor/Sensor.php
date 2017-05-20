<?php
/**
 * Created by PhpStorm.
 * User: home
 * Date: 18/04/2017
 * Time: 08:46
 */
class Sensor extends DatabaseEntity{


    /**
     * @var SensorType $sensorType;
     */
    private $sensorType ;

    /**
     * @var Room $room;
     */
    private $room;

    /**
     * @var array $sensorValues ;
     */
    private $sensorValues = array();

    /**
     * @return SensorType
     */
    public function getSensorType()
    {
        if(!$this -> sensorType -> getName()) {
            /** @var Repository $repo */
            $repo = $GLOBALS['repositories']['sensorType'];
            $this -> sensorType = $repo->findById($this -> sensorType -> getId(), false);
        }
        return $this -> sensorType;
    }

    /**
     * @return Sensor
     */
    public function setSensorType($sensorType)
    {
        if ($sensorType instanceof SensorType){
            $this -> sensorType = $sensorType;
        }
        else{
            $this -> sensorType =  new SensorType();
            $this -> sensorType -> setId($sensorType);
        }

        return $this;
    }



    /**
     * @return Room
     */
    public function getRoom()
    {
        if(!$this -> room -> getName()) {
            /** @var Repository $repo */
            $repo = $GLOBALS['repositories']['room'];
            $this -> room = $repo->findById($this -> room -> getId(), false);
        }
        return $this -> room;
    }

    /**
     * @return Sensor
     */
    public function setRoom($room)
    {
        if ($room instanceof Room){
            $this -> room = $room;
        }
        else{
            $this -> room = new Room();
            $this -> room -> setId($room);
        }

        return $this;
    }

    /**
     * @return array
     */
    public function getSensorValues()
    {
        if(!$this -> sensorValues) {
            /** @var Repository $repo */
            $repo = $GLOBALS['repositories']['sensorValue'];
            $this->sensorValues = $repo->getObjectsFromId($this, $this->getClassName(), 'sensorValue');
        }
        return $this->sensorValues;
    }

    /**
     * @param array $sensorValues
     * @return Sensor
     */
    public function setSensorValues($sensorValues)
    {
        $this->sensorValues = $sensorValues;

        return $this;
    }

    /**
     * @param SensorValue $value
     * @return Sensor
     */

    public function addSensorValue(SensorValue $value){
        $this->sensorValues[] = $value;
        $value->setSensor($this);

        return $this;
    }

    /**
     * @param SensorValue $value
     * @return Sensor
     */
    public function removeSensorValue(SensorValue $value){
        if(in_array($value,$this->getSensorValues())){
           unset($this->sensorValues[array_search($value,$this->sensorValues)]);
           $value->setSensor(null);
        }
        return $this;
    }

    /**
     * @return bool
     */


    public function getValid(){
        if($this->error){
            return false;
        }
        else{
            if ( $this->sensorType != null){
                return true;
            }
            else{
                return false;
            }
        }
    }

    /**
     * @return mixed
     */

    public function getClassName(){
        return self::class;
    }

    /**
     * @return array
     */

    public function getObjectVars(){
        return get_object_vars($this);
    }

}