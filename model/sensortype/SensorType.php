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
    public function setName(string $name)
    {
        $this->name = $name;
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
    public function setRef(string $ref)
    {
        $this->ref = $ref;
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
    public function setChart(bool $chart)
    {
        $this->chart = $chart;
        return $this;
    }

    public function getValid()
    {
        if($this->error){
            return false;
        }else{
            if($this->id != null
                && $this->name != null
                && $this ->ref != null
            ){
                return true;
            }else{
                return false;
            }
        }
    }



}