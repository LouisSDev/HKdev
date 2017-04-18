<?php
/**
 * Created by PhpStorm.
 * User: home
 * Date: 18/04/2017
 * Time: 08:46
 */
class Sensor extends DatabaseEntity{

    /**
     * @var integer $i
     */





    /**
     * @var SensorType $sensortype;
     */
    private $sensortype ;

    /**
     * @var string $name
     */
    private $name;


    /**
     * @var Room $room;
     */
    private $room;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return SensorType
     */
    public function getSensortype(): SensorType
    {
        return $this->sensortype;
    }

    /**
     * @param SensorType $sensortype
     */
    public function setSensortype(SensorType $sensortype)
    {
        $this->sensortype = $sensortype;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return Room
     */
    public function getRoom(): Room
    {
        return $this->room;
    }

    /**
     * @param Room $room
     *
     */
    public function setRoom(Room $room)
    {
        $this->room = $room;
    }


    public function getValid(){

    }


}