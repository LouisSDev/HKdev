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
     * @var float $price
     */
    private $price = 0;

    /**
     * @var $ref string
     */
    private $ref;

    /**
     * @var boolean $chart
     */
    private $chart = true;

    /**
     * @var boolean $selling
     */
    private $selling = true;

    /**
     * @return boolean
     */
    public function getSelling()
    {
        return $this -> selling;
    }

    /**
     * @param boolean $selling
     * @return SensorType
     */
    public function setSelling($selling)
    {
        $this->selling = $selling;
        return $this;
    }


    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @var float $minVal
     */
    private $minVal = 0;

    /**
     * @var float $maxVal
     */
    private $maxVal = 0;

    /**
     * @return float
     */
    public function getMinVal()
    {
        return $this->minVal;
    }

    /**
     * @param float $minVal
     * @return SensorType
     */
    public function setMinVal($minVal)
    {
        $this->minVal = $minVal;
        return $this;
    }

    /**
     * @return float
     */
    public function getMaxVal()
    {
        return $this->maxVal;
    }

    /**
     * @param float $maxVal
     * @return SensorType
     */
    public function setMaxVal($maxVal)
    {
        $this->maxVal = $maxVal;
        return $this;
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
            Utils::addWarning("the name is too long");
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
            Utils::addWarning("the reference is too long");
            $this->error = true;
            $this->errorMessage []="the reference is too long";
       }


        return $this;
    }

    /**
     * @return boolean
     */
    public function getChart()
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
            Utils::addWarning("This isn\'t a valid room type");
            $this->error = true;
            $this->errorMessage []= "This isn\'t a valid room type";
        }
        $this->type = $type;
    }

    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param float $price
     * @return SensorType
     */
    public function setPrice($price)
    {
        $this->price = $price;
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
                $this->name != null
               && $this ->ref != null
                && $this -> type != null
                && $this -> price != 0
            ){
                if($this -> chart && ($this -> minVal === null || $this -> maxVal === null)){
                    Utils::addWarning('Toutes les données requises n\'ont pas été entrées');
                    $this -> errorMessage[] =  'Toutes les données requises n\'ont pas été entrées';
                    return false;
                }

                return true;
            }else{
                Utils::addWarning('Toutes les données requises n\'ont pas été entrées');
                $this -> errorMessage[] =  'Toutes les données requises n\'ont pas été entrées';
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