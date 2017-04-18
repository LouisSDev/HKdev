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
    private $state;



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


    public function getValid(){
        if($this->error){
            return false;
        }else{
            if(    $this -> name != null
                && $this ->ref != null
            ){
                return true;
            }else{
                return false;
            }
        }
    }


}