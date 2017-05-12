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



    public function isBuilding(){
        if($this  !== $this -> building
            && $this -> building !== null )
        {
            return false;
        }
        return true;
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
        return $this->building;
    }

    /**
     * @param Home $building
     * @return Home
     */
    public function setBuilding(Home $building)
    {
        if ($building instanceof Home){
            $this->building = $building;
        }

        else{
            $this->error = true;
            $this->errorMessage []="The parameter is not a Home";
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
        return $this->homes;
    }

    /**
     * @param array $homes
     * @return Home
     */
    public function setHomes($homes)
    {
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
        if(!in_array($home, $this->homes)){
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
        if(!in_array($home, $this->homes)) {
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
        if(!in_array($room, $this->rooms)){
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
        if(!in_array($room, $this->rooms)) {
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
                        $this -> isBuilding()
                        && $this -> address != null
                        && $this -> city != null
                        && $this -> country != null
                        && $this->user != null
                ) ||
                    (
                        !$this -> isBuilding()
                        && $this -> user != null
                    )
                )
            ){
                if(!$this -> isBuilding()){
                    $this -> address = null;
                    $this -> city = null;
                    $this -> country = null;
                }
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

    public function getAllSensors(){
        $sensors = array();
        if($this -> building != $this) {
            /** @var Room $room */
            foreach ($this -> rooms as $room){
                array_merge($sensors, $room -> getSensors());
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
            foreach ($this -> rooms as $room){
                array_merge($effectors, $room -> getEffectors());
            }
        }else{
            return null;
        }
        return $effectors;
    }


    /*
     TODO delete this shit
    public function save($db)
    {
        if($this->getValid()){
            if($this->id==-1){
                $newHome=$db->prepare('INSERT INTO homes(name, address, user,building) VALUES (:name,:address,:user,:building)');
                $newHome->bindParam(':name',$this->name,PDO::PARAM_STR,strlen($this->name));
                $newHome->bindParam(':address',$this->address,PDO::PARAM_STR,strlen($this->address));
                $newHome->bindParam(':user',$this->user,PDO::PARAM_INT);
                $newHome->bindParam(':building',$this->building);
                $newHome->execute();
                $newHome->closeCursor();
                $this->id = $db->lastInsertId();
            }
            else{
                $newHome=$db->prepare('UPDATE homes SET name=:name address=:address user=:user building=:building' );
                $newHome->bindParam(':name',$this->name,PDO::PARAM_STR,strlen($this->name));
                $newHome->bindParam(':address',$this->address,PDO::PARAM_STR,strlen($this->address));
                $newHome->bindParam(':user',$this->user,PDO::PARAM_INT);
                $newHome->bindParam(':building',$this->building);
                $newHome->execute();
                $newHome->closeCursor();
                $this->id = $db->lastInsertId();
            }
            foreach ($this->rooms as $room){
                $room->save;
            }
            return this;
        }
        else{
            return null;
        }
    }

    public function delete($db)
    {
        $request = $db->prepare('DELETE FROM home WHERE id = :id');
        $request ->bindParam(':id', $this->id, PDO::PARAM_INT);
        $request->execute();
        $request->closeCursor();
        return $this;
    }

    public function createFromResults($data)
    {
    }
*/

}