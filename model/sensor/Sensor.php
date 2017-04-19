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
     * @var string $name
     */
    private $name;

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
    public function getSensorType(){
        return $this->sensorType;
    }

    /**
     * @param SensorType $sensorType
     * @return Sensor
     */
    public function setSensorType(SensorType $sensorType){
        $this->sensorType = $sensorType;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(){
        return $this->name;
    }

    /**
     * @param string $name
     * @return Sensor
     */
    public function setName(string $name){
        $this->name = $name;
        return $this;
    }

    /**
     * @return Room
     *
     */
    public function getRoom(){
        return $this->room;
    }

    /**
     * @param Room $room
     * @return Sensor
     */
    public function setRoom(Room $room)
    {
        $this->room = $room;
        return $this;
    }


    /**
     * @return array
     */
    public function getSensorValues()
    {
        return $this->sensorValues;
    }

    /**
     * @param array $sensorValues
     */
    public function setSensorValues(array $sensorValues)
    {
        $this->sensorValues = $sensorValues;
    }

    public function addSensorValue(SensorValue $value){
        if(!in_array($value , $this->sensorValues)){
            array_push($this->sensorValues,$value);
            $value->setRoom(null);
                return $this;
        }

    }
    public function removeSensorValue(SensorValue $value){
        if(!in_array($value,$this->sensorValues)){
           unset($this->sensorValues[array_search($value,$this->sensorValues)]);
           $value->setRoom(null);
        }

    }


    public function getValid(){
        if($this->error){
            return false;
        }
        else{
            if ($this->name != null
                && $this->room != null
                && $this->sensorType != null
                && $this->sensorValues !=null
            ){
                return true;
            }
            else{
                return false;
            }
        }
    }

}