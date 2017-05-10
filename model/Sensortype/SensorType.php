<?php

/**
 * Created by PhpStorm.
 * User: LOUISSTEIMBERG
 * Date: 18/04/2017
 * Time: 08:45
 */
class SensorType extends DatabaseEntity
{

    const TYPE_ARRAY = ["Capteur d'humidité", "Capteur de fumée", "Capteur de température",
         "Capteur de luminosité", "Capteur de présence"];
    /**
     * @var $name string
     */
    private $name;

    /**
     * @var $type string
     */
    private $type;


    /**
     * @var float $value
     */
    private $value;

    /**
     * @var $ref string
     */
    private $ref;

    /**
     * @var boolean $chart
     */
    private $chart = true;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return SensorType
     */
    public function setName($name)
    {
        if(strlen($name)<=40){
            $this->name = $name;
        }
        else{
            $this->error = true;
            $this->errorMessage []= "the name is too long";
        }


        return $this;
    }

    /**
     * @return string
     */
    public function getRef()
    {
        return $this->ref;
    }

    /**
     * @param string $ref
     * @return SensorType
     */
    public function setRef($ref)
    {
        if(strlen($ref)<=10){
            $this->ref = $ref;
        }
       else{
            $this->error = true;
            $this->errorMessage []="the reference is too long";
       }


        return $this;
    }

    /**
     * @return boolean
     */
    public function isChart()
    {
        return $this->chart;
    }

    /**
     * @param boolean $chart
     * @return SensorType
     */
    public function setChart($chart)
    {
        $this->chart = $chart;
        return $this;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return SensorType
     */
    public function setType($type)
    {
        if(in_array($type, self::TYPE_ARRAY)){
            $this->type = $type;
        }
        else{
            $this->error = true;
            $this->errorMessage []= "This isn\'t a valid room type";
        }
        $this->type = $type;
    }

    /**
     * @return float
     */
    public function getValue(): float
    {
        return $this->value;
    }

    /**
     * @param float $value
     * @return SensorType
     */
    public function setValue(float $value)
    {
        $this->value = $value;
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
            if( $this->name != null
                && $this ->ref != null
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
     * @return array.
     */

    public function getObjectVars(){
        return get_object_vars($this);
    }


}