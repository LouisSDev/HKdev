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
     * @var Room $room;
     */
    private $room;

    /**
     * @var boolean $state
     */
    private $state;

    /**
     * @var float $value
     */
    private $value;

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
     * @return Room
     */
    public function getRoom(){
        return $this->room;
    }

    /**
     * @param Room $room
     * @return SensorValue
     */
    public function setRoom(Room $room){
        $this->room = $room;
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

}