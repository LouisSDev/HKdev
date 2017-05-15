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
     * return SensorValue
     */
    public function setState($state)
    {
        if (is_bool($state)){
            $this->state = $state;
        }
        else{
            Utils::addWarning(' the parameter is incorrect');
            $this->error = true;
            $this->errorMessage []=' the parameter is incorrect';
        }
        return $this;
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
    public function setValue($value)
    {
        if(is_float($value)){
            $this->value = $value;
        }
        else{
            Utils::addWarning(' the parameter is incorrect');
            $this->error = true;
            $this->errorMessage []=' the parameter is incorrect';
        }

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
        if ($datetime instanceof DateTime){
            $this->datetime = $datetime;
        }
        else{
            Utils::addWarning(' the parameter is incorrect');
            $this->error = true;
            $this->errorMessage []=' the parameter is incorrect';
        }

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
    public function setSensor($sensor)
    {
        if ($sensor instanceof Sensor){
            $this->sensor = $sensor;
        }
        else{
            Utils::addWarning('the sensor is incorrect');
            /*$this->error = true;
            $this->errorMessage[] =  'the sensor is incorrect';*/
        }

        return $this;
    }

    /**
     * @return bool
     */

    public function getValid()
    {
        if($this->error){
            return false;
        }else{
            if( $this->sensor != null
                && ($this->state != null || $this ->value != null)
                && $this->datetime != null
            ){
                return true;
            }else{
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