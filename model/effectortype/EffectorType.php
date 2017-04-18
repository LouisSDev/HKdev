<?php

/**
 * Created by PhpStorm.
 * User: LOUISSTEIMBERG
 * Date: 18/04/2017
 * Time: 09:10
 */
class EffectorType extends DatabaseEntity
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
     * @return EffectorType
     */
    public function setRef(string $ref)
    {
        $this->ref = $ref;
        return $this;
    }


    /**
     * @param boolean $chart
     * @return EffectorType
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
            if(
                   $this->name != null
                && $this ->ref != null
            ){
                return true;
            }else{
                return false;
            }
        }
    }


}