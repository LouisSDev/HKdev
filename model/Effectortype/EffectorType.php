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
    public function setName($name)
    {
        if(strlen($name) <= 40 ){

            $this->name = $name;
        }
        else{
            $this -> error = true;
            $this -> errorMessage .= '<br/> This name is too long';
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
            $this -> error = true;
            $this -> errorMessage .= '<br/> The reference is incorrect';
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
            $this -> error = true;
            $this -> errorMessage[] =  "The parameter is incorrect";

        }

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

    public function getClassName(){
        return self::class;
    }

    public function getObjectVars(){
        return get_object_vars($this);
    }


}