<?php

/**
 * Created by PhpStorm.
 * User: Adrien
 * Date: 18/04/2017
 * Time: 09:46
 */
class SensorValue extends DatabaseEntity
{
    /**
     * @var \DateTime $datetime
     */
    private $datetime;

    /**
     * @var boolean $state
     */
    private $state = false;

    /**
     * @var float $value
     */
    private $value;

    /**
     * @var Sensor $sensor
     */
    private $sensor;

    /**
     * SensorValue constructor.
     */

    public function __construct()
    {
        $this -> datetime = new \DateTime(date('m/d/Y H:i:s'));
    }

    /**
     * @return boolean
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param boolean $state
     */
    public function setState(boolean $state)
    {
        $this->state = $state;
    }


    /**
     * @return float
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param float $value
     * @return SensorValue
     */
    public function setValue(float $value)
    {
        $this->value = $value;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getDatetime()
    {
        return $this->datetime;
    }

    /**
     * @param DateTime $datetime
     * @return SensorValue
     */
    public function setDatetime(DateTime $datetime)
    {
        $this->datetime = $datetime;
        return $this;
    }

    /**
     * @return Sensor
     */
    public function getSensor()
    {
        return $this->sensor;
    }

    /**
     * @param Sensor $sensor
     * @return SensorValue
     */
    public function setSensor(Sensor $sensor)
    {
        $this->sensor = $sensor;
        return $this;
    }



    public function getValid()
    {
        if($this->error){
            return false;
        }else{
            if($this->room != null
                &&( $this->state != null || $this ->value != null)
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

}