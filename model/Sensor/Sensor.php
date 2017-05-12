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
           $this->errorMessage[]= "The parameter is not a SensorType";
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
            $this->errorMessage[]=  "This name is too long";
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
            $this -> errorMessage[]= "The parameter is not a Room";
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
        if(!in_array($value , $this->sensorValues)){
            array_push($this->sensorValues,$value);
            $value->setSensor(null);
        }
        return $this;
    }

    /**
     * @param SensorValue $value
     * @return Sensor
     */
    public function removeSensorValue(SensorValue $value){
        if(!in_array($value,$this->sensorValues)){
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
            if ($this->name != null
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