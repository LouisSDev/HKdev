<?php
/**
 * Created by PhpStorm.
 * User: home
 * Date: 18/04/2017
 * Time: 08:46
 */
class Effector extends DatabaseEntity{


    /**
     * @var EffectorType $effectorType;
     */
    private $effectorType;

    /**
     * @var string $name
     */
    private $name;

    /**
     * @var Room $room;
     */
    private $room;

    /**
     * @var float $value
     */
    private $value = 0;

    /**
     * @var boolean $state
     */
    private $state = false;

    /**
     * @var boolean $auto
     */
    private $auto = true;




    /**
     * @return EffectorType
     */
    public function getEffectorType()
    {
        if(!$this -> effectorType -> getName()) {
            /** @var Repository $repo */
            $repo = $GLOBALS['repositories']['effectorType'];
            $this -> effectorType = $repo->findById($this -> effectorType -> getId(), false);
        }
        return $this -> effectorType;
    }

    /**
     * @return Effector
     */
    public function setEffectorType($effectorType)
    {
        if ($effectorType instanceof EffectorType){
            $this -> effectorType = $effectorType;
        }
        else{
            $this -> effectorType =  new EffectorType();
            $this -> effectorType -> setId($effectorType);
        }

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
     * @return Effector
     */
    public function setName($name)
    {

        if(strlen($name)<=40){
            $this->name = $name;
        }
        else{
            Utils::addWarning("This name is too long ");
            $this->error = true;
            $this->errorMessage []= "This name is too long ";
        }

        return $this;
    }

    /**
     * @return Room
     */
    public function getRoom()
    {
        if(!$this -> room -> getName()) {
            /** @var Repository $repo */
            $repo = $GLOBALS['repositories']['room'];
            $this -> room = $repo->findById($this -> room -> getId(), false);
        }
        return $this -> room;
    }

    /**
     * @return Effector
     */
    public function setRoom($room)
    {
        if ($room instanceof Room){
            $this -> room = $room;
        }
        else{
            $this -> room = new Room();
            $this -> room -> setId($room);
        }

        return $this;
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
     * @return Effector
     */
    public function setState($state)
    {
        if($state){
            $this->state = true;
        }else{
            $this -> state = false;
        }
        return $this;
    }

    /**
     * @return boolean
     */
    public function getAuto()
    {
        return $this->auto;
    }

    /**
     * @param boolean $auto
     * @return Effector
     */
    public function setAuto($auto)
    {
        if($auto) {
            $this->auto = true;
        }else{
            $this -> auto = false;
        }
        return $this;
    }

    /**
     * @return float
     *
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param float $value
     * @return Effector
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }



    public function getValid(){
        if($this->error){
            return false;
        }else{
            if(    $this -> name != null
                && $this -> room != null
                && $this -> effectorType != null
            )
            {
                return true;
            }
            else{
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