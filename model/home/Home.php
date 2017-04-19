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
     * @var string
     */
    private $address;

    /**
     * @var User
     */
    private $user;

    /**
     * @var $building Building
     */
    private $building;

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
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param string $adress
     */
    public function setAddress(string $address)
    {
        $this->address = $address;
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
     */
    public function setUser(string $user)
    {
        $this->user = $user;
    }

    /**
     * @return string
     */
    public function getBuilding()
    {
        return $this->building;
    }

    /**
     * @param string $building
     */
    public function setBuilding(string $building)
    {
        $this->building = $building;
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