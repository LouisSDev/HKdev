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
        return $this->effectorType;
    }

    /**
     * @param EffectorType $effectorType
     * @return Effector
     */
    public function setEffectorType(EffectorType $effectorType)
    {
        if(is_integer($effectorType)) {
            $this->effectorType = $effectorType;
        }
        else{}
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
            $this->error = true;
            $this->errorMessage .= '<br/> This name is too long ';
        }

        return $this;
    }

    /**
     * @return Room
     */
    public function getRoom()
    {
        return $this->room;
    }

    /**
     *
     * @param Room $room
     * @return Effector
     *
     */
    public function setRoom(Room $room)
    {
        if($room instanceof Room){
            $this->room = $room;
        }
        else{
            $this->error = true;
            $this->errorMessage .= '<br/> The parameter is not a Room ';
        }

        return $this;
    }

    /**
     * @return boolean
     */
    public function isState()
    {
        return $this->state;
    }

    /**
     * @param boolean $state
     * @return Effector
     */
    public function setState($state)
    {
        if(is_bool($state)){
            $this->state = $state;
        }
        else{
            $this->error = true;
            $this->errorMessage .='<br> The parameter is incorrect';
        }
        return $this;
    }

    /**
     * @return boolean
     */
    public function isAuto()
    {
        return $this->auto;
    }

    /**
     * @param boolean $auto
     * @return Effector
     */
    public function setAuto($auto)
    {
        if(is_bool($auto)) {
            $this->auto = $auto;
        }
        else{
            $this->error = true;
            $this->errorMessage .='<br> The parameter is incorrect';
        }
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