<?php
/**
 * Created by PhpStorm.
 * User: home
 * Date: 18/04/2017
 * Time: 08:46
 */
class Sensor extends DatabaseEntity{

    /**
     * @var boolean $error;
     */

    private $error;

    /**
     * @var SensorType $sensortype;
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


    public function getValid(){
        if($this->error){
            return false;
        }
        else{
            if ($this->name != null
                && $this->room != null
                && $this->sensorType != null
            ){
                return true;
            }
            else{
                return false;
            }
        }

    }


}