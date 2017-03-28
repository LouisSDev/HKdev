<?php

/**
 * Created by PhpStorm.
 * User: home
 * Date: 28/03/2017
 * Time: 10:00
 */
class Rooms implements DatabaseEntity
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
     * @var $sensors Array;
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
public function save($db){
        if ($this->getValid){
            if($this->id==-1){
                $newRoom=$db->prepare('INSERT INTO rooms(name,home,sensors) VALUES (:name,:home,:sensors)');
                $newRoom->bindParam('name',$this->name,PDO::PARAM_STR, strlen($this->name));
                $newRoom->bindParam('home',$this->home);
                $newRoom->bindParam('sensors',$this->sensors);
                $newRoom->execute();
                $newRoom->closeCursor();
                $this->id = $db->lastInsertId();

            }
            else{
                $newRoom=$db->prepare('UPDATE rooms SET name=:name home=:home sensors=:sensors ' );
                $newRoom->bindParam(':name',$this->name,PDO::PARAM_STR,strlen($this->name));
                $newRoom->bindParam(':home',$this->home);
                $newRoom->bindParam(':sensors',$this->sensors);
                $newRoom->execute();
                $newRoom->closeCursor();
                $this->id = $db->lastInsertId();
            }

        }
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
        $request = $db->prepare('DELETE FROM rooms WHERE id = :id');
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