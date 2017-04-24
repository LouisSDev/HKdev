<?php

/**
 * Created by PhpStorm.
 * User: LOUISSTEIMBERG
 * Date: 18/04/2017
 * Time: 08:45
 */
class SensorType extends DatabaseEntity
{

    /**
     * @var $name string
     */
    private $name;

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
            $this->ref = $name;
        }
        else{
            $this->error = true;
            $this->errorMessage .='<br> the reference is too long';
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
            $this->errorMessage .='<br> the reference is too long';
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

    public function getClassName(){
        return self::class;
    }

    public function getObjectVars(){
        return get_object_vars($this);
    }


}