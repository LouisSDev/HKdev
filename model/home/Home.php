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
        $this->name = $name;
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
            $this->errorMessage .= '<br/> This address is too long ';
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
        $this->user = $user;
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
        $this->building = $building;
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
        $this->city = $city;
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
        $this->country = $country;
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
     * @param array $homes
     * @return Home
     */
    public function setRooms($rooms)
    {
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
            if( $this->name != null
                && $this ->address != null
                && $this->user != null
                && $this-> building!= null
            ){
                return true;
            }else{
                return false;
            }
        }
    }

    public function getObjectVars(){
        return get_object_vars($this);
    }


    // TODO:: rooms!!!
    /*
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
        // TODO: Implement save() method.
    }

    public function delete($db)
    {
        $request = $db->prepare('DELETE FROM home WHERE id = :id');
        $request ->bindParam(':id', $this->id, PDO::PARAM_INT);
        $request->execute();
        $request->closeCursor();
        return $this;
        // TODO: Implement delete() method.
    }

    public function createFromResults($data)
    {
        // TODO: Implement createFromResults() method.
    }
*/

}