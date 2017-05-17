<?php

/**
 * Created by PhpStorm.
 * User: LOUISSTEIMBERG
 * Date: 18/04/2017
 * Time: 09:10
 */
class EffectorType extends DatabaseEntity
{


    const TYPE_ARRAY = ["Volets", "Lumière", "Climatisation"];

    /**
     * @var $name string
     */
    private $name;

    /**
     * @var $type string
     */
    private $type;

    /**
     * @var $ref string
     */
    private $ref;


    /**
     * @var boolean $chart
     */
    private $chart;

    /**
     * @var float $minVal
     */
    private $minVal = 0;

    /**
     * @var float $maxVal
     */
    private $maxVal = 0;

    /**
     * @var boolean $selling
     */
    private $selling;

    /**
     * @return boolean
     */
    public function getSelling()
    {
        return $this->selling;
    }

    /**
     * @param boolean $selling
     * @return EffectorType
     */
    public function setSelling($selling)
    {
        $this->selling = $selling;
        return $this;
    }



    /**
     * @return float
     */
    public function getMinVal()
    {
        return $this->minVal;
    }

    /**
     * @param float $minVal
     * @return EffectorType
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
     * @return EffectorType
     */
    public function setMaxVal($maxVal)
    {
        $this->maxVal = $maxVal;
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
     * @param string $name
     * @return EffectorType
     */
    public function setName($name)
    {
        if(strlen($name) <= 40 ){

            $this->name = $name;
        }
        else{
            Utils::addWarning("This name is too long");
            $this -> error = true;
            $this -> errorMessage [] = "This name is too long";
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
     * @return EffectorType
     */
    public function setRef($ref)
    {
        if(strlen($ref) <= 10 ){

            $this->ref = $ref;
        }
        else{
            Utils::addWarning("The reference is incorrect");
            $this -> error = true;
            $this -> errorMessage []= "The reference is incorrect";
        }

        return $this;
    }


    /**
     * @param boolean $chart
     * @return EffectorType
     */
    public function setChart($chart)
    {
        if(is_bool($chart)){
            $this->chart = $chart;
        }
        else{
            Utils::addWarning("The parameter is incorrect");
            $this -> error = true;
            $this -> errorMessage[] =  "The parameter is incorrect";

        }

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
     * @return EffectorType
     */
    public function setType($type)
    {
        if(in_array($type, self::TYPE_ARRAY)){
            $this->type = $type;
        }
        else{
            Utils::addWarning("This isn\'t a valid Effector type");
            $this->error = true;
            $this->errorMessage []= "This isn\'t a valid Effector type";
        }
        $this->type = $type;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getChart()
    {
        return $this->chart;
    }




    public function getValid()
    {
        if($this->error){
            return false;
        }else{
            if(
                   $this->name != null
                && $this ->ref != null
                && $this -> type != null
            ){
                if($this -> chart && ($this -> minVal == null || $this -> maxVal)){
                    return false;
                }
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