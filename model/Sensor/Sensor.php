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
       if( $sensorType instanceof SensorType){
           $this->sensorType = $sensorType;
       }
        else{
           $this->error = true;
           $this->errorMessage .= '<br/> The parameter is not a SensorType ';
        }
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
    public function setName($name){
        if(strlen($name)<=30){
            $this->name = $name;
        }
        else{
            $this->error = true;
            $this->errorMessage .= '<br/> This name is too long ';
        }

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
        if($room instanceof Room){
            $this->room = $room;
        }
        else{
            $this -> error = true;
            $this -> errorMessage .= '<br/> The parameter is not a Room';
        }

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
    public function setSensorValues($sensorValues)
    {
        $this->sensorValues = $sensorValues;
    }

    public function addSensorValue(SensorValue $value){
        if(!in_array($value , $this->sensorValues)){
            array_push($this->sensorValues,$value);
            $value->setSensor(null);
        }
        return $this;
    }
    public function removeSensorValue(SensorValue $value){
        if(!in_array($value,$this->sensorValues)){
           unset($this->sensorValues[array_search($value,$this->sensorValues)]);
           $value->setSensor(null);
        }
        return $this;
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

    public function getClassName(){
        return self::class;
    }

    public function getObjectVars(){
        return get_object_vars($this);
    }

}