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
    private $adress;

    /**
     * @var User
     */
    private $user;

    /**
     * @var array
     */
    private $homes;

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
    public function getAdress()
    {
        return $this->adress;
    }

    /**
     * @param string $adress
     */
    public function setAdress(string $adress)
    {
        $this->adress = $adress;
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
                $newBuilding->bindParam(':adress',$this->adress,PDO::PARAM_STR,strlen($this->adress));
                $newBuilding->bindParam(':user',$this->user,PDO::PARAM_INT);
                $newBuilding->execute();
                $newBuilding->closeCursor();
                $this->id = $db->lastInsertId();

            }
            else {
                $updateBuilding = $db->prepare('UPDATE building SET name=:name,adress=:adress,user=:user WHERE id=:id');
                $updateBuilding->bindParam(':name', $this->name, PDO::PARAM_STR, strlen($this->name));
                $updateBuilding->bindParam(':adress', $this->adress, PDO::PARAM_STR, strlen($this->adress));
                $updateBuilding->bindParam(':user', $this->user, PDO::PARAM_INT);
                $updateBuilding->execute();
                $updateBuilding->closeCursor();
                $this->id = $db->lastInsertId();
            }
            //foreach ($this->homes)
        }
        // TODO: Implement save() method.
    }

    public function delete($db)
    {
        // TODO: Implement delete() method.
    }

    public function createFromResults($data)
    {
        // TODO: Implement createFromResults() method.
    }

    public function getValid()
    {
        // TODO: Implement getValid() method.
    }
}