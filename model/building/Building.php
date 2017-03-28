<?php

/**
 * Created by PhpStorm.
 * User:
 * Date: 21/03/2017
 * Time: 09:14
 */
class Building implements DatabaseEntity
{
    /**
 * @var integer
 */
    private $id;

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
     * @var array
     */
    private $homes;

    protected $error;

    /**
     * @return array
     */
    public function getHomes()
    {
        return $this->homes;
    }

    /**
     * @param array $homes
     */
    public function setHomes(array $homes)
    {
        $this->homes = $homes;
    }

    /**
     * @return int
     */
    public function getId()
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
    public function setUser(User $user)
    {
        $this->user = $user;
    }

    /**
     * Add home
     *
     * @param Home
     * @return Building
     */

    public function addHome($home){
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
     * @return Building
     */

    public function removeHome($home){
        if(!in_array($home, $this->homes)) {
            unset($this->homes[array_search($home,$this->homes)]);
            $home->setBuilding(null);
        }
        return $this;
    }

    public function save($db)
    {
        if($this->getValid()){
            if($this->id==-1){
                $newBuilding=$db->prepare('INSERT INTO 
                building(name,adress,user)  
                VALUES(:name,:adress,:user)');
                $newBuilding->bindParam(':name',$this->name,PDO::PARAM_STR,strlen($this->name));
                $newBuilding->bindParam(':address',$this->address,PDO::PARAM_STR,strlen($this->adress));
                $newBuilding->bindParam(':user',$this->user,PDO::PARAM_INT);
                $newBuilding->execute();
                $newBuilding->closeCursor();
                $this->id = $db->lastInsertId();

            }
            else {
                $updateBuilding = $db->prepare('UPDATE building SET name=:name,adress=:adress,user=:user WHERE id=:id');
                $updateBuilding->bindParam(':name', $this->name, PDO::PARAM_STR, strlen($this->name));
                $updateBuilding->bindParam(':address', $this->address, PDO::PARAM_STR, strlen($this->adress));
                $updateBuilding->bindParam(':user', $this->user, PDO::PARAM_INT);
                $updateBuilding->execute();
                $updateBuilding->closeCursor();
                $this->id = $db->lastInsertId();
            }
            foreach ($this->homes as $home){
                $home->save;
            }
            return this;

        }
        else{
            return null;
        }
    }

    public function delete($db)
    {

        $request = $db->prepare('DELETE FROM building WHERE id = :id');
        $request ->bindParam(':id', $this->id, PDO::PARAM_INT);
        $request->execute();
        $request->closeCursor();
        return $this;

    }

    public function createFromResults($data)
    {
        return $this;

    }

    public function getValid()
    {
        if ($this->error){
            return false;
        }
        else{
            if($this->name != null
                && $this->adress!=null
            ){
                return true;
            }
        }

    }
}