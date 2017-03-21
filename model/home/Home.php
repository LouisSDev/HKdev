<?php

/**
 * Created by PhpStorm.
 * User: Desazars
 * Date: 21/03/2017
 * Time: 09:22
 */
class Home
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
     * @var string
     */
    private $building;

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
     * @return string
     */
    public function getAdress(): string
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
    public function getUser(): string
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
    public function getBuilding(): string
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

}