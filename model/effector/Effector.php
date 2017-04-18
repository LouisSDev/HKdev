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
        $this->effectorType = $effectorType;
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
    public function setName(string $name)
    {
        $this->name = $name;
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
        $this->room = $room;
        return $this;
    }

    /**
     * @return boolean
     */
    public function isState(): bool
    {
        return $this->state;
    }

    /**
     * @param boolean $state
     * @return Effector
     */
    public function setState(bool $state)
    {
        $this->state = $state;
        return $this;
    }

    /**
     * @return boolean
     */
    public function isAuto(): bool
    {
        return $this->auto;
    }

    /**
     * @param boolean $auto
     * @return Effector
     */
    public function setAuto(bool $auto)
    {
        $this->auto = $auto;
        return $this;
    }




    public function getValid(){
        if($this->error){
            return false;
        }else{
            if(    $this -> name != null
                && $this -> room != null
                && $this -> effectorType != null
            ){
                return true;
            }else{
                return false;
            }
        }
    }


}