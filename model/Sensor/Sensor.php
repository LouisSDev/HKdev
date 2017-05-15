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
           Utils::addWarning("The parameter is not a SensorType");
           $this->error = true;
           $this->errorMessage[]= "The parameter is not a SensorType";
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
            Utils::addWarning("The parameter is not a Room");
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