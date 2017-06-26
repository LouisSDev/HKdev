
<?php

/**
 * Created by PhpStorm.
 * User:
 * Date: 21/03/2017
 * Time: 09:22
 */
class Home extends DatabaseEntity
{

    /**
     * @var string
     */
    private $name;

    /**
     * @var string $address
     */
    private $address;

    /**
     * @var string $city
     */
    private $city;

    /**
     * @var string $country
     */
    private $country;

    /**
     * @var User
     */
    private $user;

    /**
     * @var $building Home
     */
    private $building = null;

    /**
     * @var $homes array
     */
    private $homes = array();

    /**
     * @var $rooms
     */
    private $rooms = array();

    /**
     * @var bool $hasHomes
     */
    private $hasHomes = false;



    public function isBuilding(){
        if($this  !== $this -> building
            && $this -> building !== null )
        {
            return false;
        }

        return true;
    }


    /**
     * @return boolean
     */
    public function getHasHomes()
    {
        return $this->hasHomes;
    }

    /**
     * @param boolean $hasHomes
     * @return Home
     */
    public function setHasHomes($hasHomes)
    {
        $this->hasHomes = $hasHomes;
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
     * @return Home
     */
    public function setName($name)
    {
        if(strlen($name)<=40){
            $this->name = $name;
        }
        else{
            Utils::addWarning("This name is too long");
            $this->error = true;
            $this->errorMessage []="This name is too long";
        }

        return $this;
    }

    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param string $address
     * @return Home
     */
    public function setAddress($address)
    {
        if(strlen($address)<=80){
            $this->address = $address;
        }
        else{
            Utils::addWarning("This address is too long");
            $this->error = true;
            $this->errorMessage[]=  "This address is too long ";
        }


        return $this;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param User $user
     * @return Home
     */
    public function setUser($user)
    {
        if($user instanceof User){
            $this->user = $user;
        }
        else{
            Utils::addWarning("The parameter is not a User");
            $this->error = true;
            $this->errorMessage[]="The parameter is not a User";
        }

        return $this;
    }

    /**
     * @return Home
     */
    public function getBuilding()
    {
        if($this -> building && !$this -> building -> getName()) {
            /** @var Repository $repo */
            $repo = $GLOBALS['repositories']['home'];
            $this->building = $repo->findById($this->building->getId(), false);
        }
        return $this->building;
    }

    /**
     * @return Home
     */
    public function setBuilding($building)
    {
        if ($building instanceof Home){
            $this->building = $building;
        }
        else{
          $this -> building =  new Home();
          $this -> building -> setId($building);
        }

        return $this;
    }




    /**
     * @return string
     */
    public function getCity()
    {

        return $this->city;
    }

    /**
     * @param string $city
     * @return Home
     */
    public function setCity($city)
    {
        if(strlen($city)<=40){
            $this->city = $city;
        }
        else{
            Utils::addWarning("This city name is too long");
            $this->error = true;
            $this->errorMessage []="This city name is too long";
        }

        return $this;

    }

    /**
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param string $country
     * @return Home
     */
    public function setCountry($country)
    {
        if(strlen($country)<=30){
            $this->country = $country;
        }
        else{
            Utils::addWarning("This Country name is too long");
            $this->error = true;
            $this->errorMessage[]=  "This Country name is too long";
        }

        return $this;
    }




    /**
     * @return array
     */
    public function getHomes()
    {
        if(!$this -> homes) {
            /** @var Repository $repo */
            $repo = $GLOBALS['repositories']['home'];
            $this->homes = $repo->getObjectsFromId($this, 'building' , 'home');
        }

        return $this->homes;
    }

    /**
     * @param array $homes
     * @return Home
     */
    public function setHomes($homes)
    {
        if($homes != null) {
            /** @var Home $home */
            foreach ($homes as $home) {
                $home->setBuilding($this);
            }
        }
        $this -> homes = $homes;
        return $this;
    }



    /**
     * Add home
     *
     * @param Home
     * @return Home
     */

    public function addHome(Home $home){
        if(!in_array($home, $this->getHomes())){
            array_push( $this->homes, $home);
            $home->setBuilding($this);
        }
        return $this;
    }

    /**
     * Remove home
     *
     * @param Home
     * @return Home
     */

    public function removeHome(Home $home){
        if(!in_array($home, $this->getHomes())) {
            unset($this->homes[array_search($home,$this->homes)]);
            $home->setBuilding(null);
        }
        return $this;
    }


    /**
     * @return array
     */
    public function getRooms()
    {
        if(!$this -> rooms) {
            /** @var Repository $repo */
            $repo = $GLOBALS['repositories']['room'];
            $this->rooms = $repo->getObjectsFromId($this, $this->getClassName(), 'room');
        }

        return $this->rooms;
    }

    /**
     * @param array $rooms
     * @return Home
     */
    public function setRooms($rooms){
        $this -> rooms = $rooms;
        return $this;
    }



    /**
     * Add room
     *
     * @param Room
     * @return Home
     */

    public function addRoom(Room $room){
        if(!in_array($room, $this->getRooms())){
            array_push( $this->rooms, $room);
            $room->setHome($this);
        }
        return $this;
    }

    /**
     * Remove room
     *
     * @param Room
     * @return Home
     */

    public function removeRoom(Room $room){
        if(!in_array($room, $this->getRooms())) {
            unset($this->rooms[array_search($room, $this->rooms)]);
            $room->setHome(null);
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
                && (
                    (
                        $this -> hasHomes
                        && $this -> address != null
                        && $this -> city != null
                        && $this -> country != null
                        && $this->user != null
                ) ||
                    (
                        !$this -> hasHomes
                        && $this -> user != null
                        && $this -> address != null
                        && $this -> city != null
                        && $this -> country != null
                    )
                )
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

    public function getAllSensors(){
        $sensors = array();
        if($this -> building != $this) {
            /** @var Room $room */
            foreach ($this -> getRooms() as $room){
                $sensors = array_merge($sensors, $room -> getSensors());
            }
        }else{
            return null;
        }
        return $sensors;
    }

    public function getAllEffectors()
    {
        $effectors = array();
        if($this -> building != $this) {
            /** @var Room $room */
            foreach ($this -> getHomes() as $room){
                array_merge($effectors, $room -> getEffectors());
            }
        }else{
            return null;
        }
        return $effectors;
    }

    /**
     * @param $type string
     * @return array
     */
    public function getRoomsPerType($type){
        $rooms = [];

        /** @var Room $room */
        foreach($this -> getRooms() as $room) {
            if($room -> getType() == $type){
                $rooms[] = $room;
            }
        }

        return $rooms;
    }

    /**
     * @param $type string
     * @return array
     */
    public function getEffectorsPerType($type){
        return $this -> getEffectorsPerTypeFromList($this -> rooms, $type);
    }

    /**
     * @param $roomType string
     * @param $type string
     * @return array
     */
    public function getEffectorsPerTypeAndPerRoomType($roomType, $type){
        return $this -> getEffectorsPerTypeFromList($this -> getRoomsPerType($roomType), $type);
    }

    /**
     * @param $list array
     * @param $type string
     * @return array
     */
    private function getEffectorsPerTypeFromList($list, $type){
        $effectors = [];

        /** @var Room $room */
        foreach($list as $room) {
            /** @var Effector $effector */
            foreach ($room -> getEffectors() as $effector){
                if($effector -> getEffectorType() ->getType() === $type){
                    $effectors[] = $effector;
                }
            }
        }
        return $effectors;
    }



    /**
     * @param $type string
     * @return array
     */
    public function getSensorsPerType($type){

        $sensors = [];

        /** @var Room $room */
        foreach($this -> getRooms() as $room) {
            /** @var Sensor $sensor*/
            foreach ($room -> getSensors() as $sensor){
                if($sensor -> getSensorType() -> getType() === $type){
                    $sensors[] = $sensor;
                }
            }
        }
        return $sensors;
    }



}