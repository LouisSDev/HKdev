<?php

/**
 * Created by PhpStorm.
 * User: Desazars
 * Date: 21/03/2017
 * Time: 09:22
 */
class Home implements DatabaseEntity
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
     * @var Building
     */
    private $building;

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

    public function save($db)
    {
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