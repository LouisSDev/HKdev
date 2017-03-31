<?php

/**
 * Created by PhpStorm.
 * User: home
 * Date: 28/03/2017
 * Time: 10:00
 */
class Room implements DatabaseEntity
{

    /**
     * @var $id int;
     */
    private $id;

    /**
     * @var $name string
     */
    private $name;

    /**
     * @var $sensors array;
     */
    private $sensors;

    /**
     * @var $home Home;
     */
    private $home;

    /**
     * @var boolean $error
     */
    private $error;

    /**
     * @var string $errorMessage
     */
    private $errorMessage;


    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return Home
     */
    public function getHome(): Home
    {
        return $this->home;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return array
     */
    public function getSensors(): array
    {
        return $this->sensors;
    }

    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * @param Home $home
     */
    public function setHome(Home $home)
    {
        $this->home = $home;
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
    public function getErrorMessage(): string
    {
        return $this->errorMessage;
    }

    /**
     * @param string $errorMessage
     */
    public function setErrorMessage(string $errorMessage)
    {
        $this->errorMessage = $errorMessage;
    }

    /**
     * @return Room
     *
     */
    public function save($db){

        if ($this->getValid()){
            if($this -> id == -1){
                $newRoom = $db -> prepare('INSERT INTO room(name, home) VALUES (:name, :home)');
                $newRoom -> bindParam('name',$this->name,PDO::PARAM_STR, strlen($this->name));
                $newRoom -> bindParam('home',$this->home);
                $newRoom -> execute();
                $newRoom -> closeCursor();
                $this -> id = $db->lastInsertId();

            }
            else{
                $updateRoom = $db->prepare('UPDATE room SET name = :name,  home = :home WHERE id = :id ' );
                $updateRoom -> bindParam(':name',$this->name,PDO::PARAM_STR,strlen($this->name));
                $updateRoom -> bindParam(':home', $this-> home -> getId(), PDO::PARAM_INT);
                $updateRoom -> bindParam(':id', $this->id, PDO::PARAM_INT);
                $updateRoom -> execute();
                $updateRoom -> closeCursor();
            }

        }

        // TODO : Cascade
        // TODO : Cascade
        // TODO : Cascade
        // TODO : Cascade
        // TODO : Cascade
        // TODO : Cascade
        // TODO : Cascade
        // TODO : Cascade
        // TODO : Cascade
        // TODO : Cascade
        // TODO : Cascade
        // TODO : Cascade

        return $this;
    }

    public function getValid()
    {
        if($this->error){
            return false;
        }else{
            if($this->id != null
                && $this->name != null
                && $this ->home != null
                && $this->sensors != null
            ){
                return true;
            }else{
                return false;
            }
        }
    }
    public function delete($db)
    {
        $request = $db->prepare('DELETE FROM room WHERE id = :id');
        $request ->bindParam(':id', $this->id, PDO::PARAM_INT);
        $request->execute();
        $request->closeCursor();
        return $this;

    }


    public function createFromResults($data)
    {
        // TODO: Implement createFromResults() method.
    }
}