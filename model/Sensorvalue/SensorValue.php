<?php

/**
 * Created by PhpStorm.
 * User: Adrien
 * Date: 18/04/2017
 * Time: 09:46
 */
class SensorValue extends DatabaseEntity
{
    const DEFAULT_STATE_SENSOR_VALUE = -59.99;
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
    private $value = self::DEFAULT_STATE_SENSOR_VALUE;

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
     * @return SensorValue
     */
    public function setState($state)
    {
        if (is_bool($state)){
            $this->state = $state;
        }
        else{
            $this->error = true;
            $this->errorMessage[] = 'the state is incorrect';
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
        if ($datetime instanceof DateTime){
            $this->datetime = $datetime;
        }
        else{
            Utils::addWarning('the datetime is incorrect');
            $this->error = true;
            $this->errorMessage[] = 'the datetime is incorrect';
        }

        return $this;
    }


    /**
     * @return Sensor
     */
    public function getSensor()
    {
        if(!$this -> sensor -> getRoom()) {
            /** @var Repository $repo */
            $repo = $GLOBALS['repositories']['sensor'];
            $this -> sensor = $repo->findById($this -> sensor -> getId(), false);
        }
        return $this -> sensor;
    }

    /**
     * @return SensorValue
     */
    public function setSensor($sensor)
    {
        if ($sensor instanceof Sensor){
            $this -> sensor = $sensor;
        }
        else{
            $this -> sensor =  new Sensor();
            $this -> sensor -> setId($sensor);
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
            if(
                $this -> sensor !== null
                && ($this->state !== null || $this ->value !== null)
                && $this->datetime !== null
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

    public function getOneToOneCascadingActivated(){
        return false;
    }

    public function getDataArray($sortedSensorValues)
    {
        if($this -> value == self::DEFAULT_STATE_SENSOR_VALUE){
            $numberOfFalse = 0;
            $numberOfTrue = 0;
            /** @var SensorValue $value */
            foreach ($sortedSensorValues as $value){
                if($value -> getState()){
                    $numberOfTrue ++;
                }else{
                    $numberOfFalse ++;
                }
            }

            $mediumState = false;

            if($numberOfTrue > $numberOfFalse){
                $mediumState = true;
            }

            return [
                'datetime' => $this -> datetime -> format(self::MYSQL_TIMESTAMP_FORMAT),
                'state' => $mediumState
            ];
        }

        $totalValue = 0;
        /** @var SensorValue $value */
        foreach ($sortedSensorValues as $value){
            $totalValue += $value -> getValue();
        }

        $mediumValue = $totalValue / count($sortedSensorValues);


        return [
            'datetime' => $this -> datetime -> format(self::MYSQL_TIMESTAMP_FORMAT),
            'value' => $mediumValue
        ];


    }

}